<?php

namespace App\Http\Controllers\Api;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataModels\LeadDataModel;
use App\DataModels\HubspotPostDataModel;
use App\Eloquent\LeadEntity;


class LeadsController extends Controller
{
    public function create(Request $request)
    {
        $authKeyHeader = $request->header('Authorization');
        $authKeyConfig = env('EDS_API_KEY');

        if($authKeyConfig == $authKeyHeader)
        {
            $sentToHubspot = 0;
            $data = (new LeadDataModel())->fromRequest($request);
            $hubSpotUrl = "{$data->hubspotBaseurl}/contacts/v1/contact/createOrUpdate/email/{$data->email}/?hapikey={$data->hubspotHapikey}";
            $client = new Client();
            $response = $client->post($hubSpotUrl, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                ],
                'json' => (new HubspotPostDataModel())->toModel($data),
                'http_errors' => false
            ]);

            if($response->getStatusCode() == 200)
                $sentToHubspot = 1;

            LeadEntity::create([
                'first_name' => $data->firstName,
                'last_name' => $data->lastName,
                'email_address' => $data->email,
                'phone_number' => $data->phone,
                'ip_address' => $data->ipAddress,
                'interested_property' => $data->interestedProperty,
                'referrer_url' => $data->referrerUrl,
                'source_url' => $data->sourceUrl,
                'sent_to_hubsopt' => $sentToHubspot,
                'sms_sent_to' => $request->input('sms_recipients')
            ]);

            $basic  = new \Nexmo\Client\Credentials\Basic('854fd785', '6255392c01a56aca');
            $client = new \Nexmo\Client($basic);
            $smsTo = explode(',', $request->input('sms_recipients'));

            foreach($smsTo as $number)
            {
                $client->message()->send([
                    'to' => $number,
                    'from' => '15613030495',
                    'text' => "{$data->firstName} {$data->lastName}, Email: {$data->email}, Phone: {$data->phone} just submitted a lead. He/She is interested in {$data->interestedProperty}"
                ]);
            }


            return response()->json([
                'status' => 'success',
                'message' => 'lead logged'
            ], 200);
        }
        else
            return response('', 403);
    }
}
