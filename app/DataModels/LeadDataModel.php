<?php

namespace App\DataModels;

use Illuminate\Http\Request;

class LeadDataModel
{
    public $firstName;
    public $lastName;
    public $email;
    public $phone;
    public $interestedProperty;
    public $hubspotHapikey;
    public $hubspotBaseurl;
    public $smsRecipients;
    public $ipAddress;
    public $referrerUrl;
    public $sourceUrl;


    public function fromRequest(Request $request)
    {
        $this->firstName = $request->input('fname');
        $this->lastName = $request->input('lname');
        $this->email = $request->input('email');
        $this->phone = $request->input('phone');
        $this->interestedProperty = $request->input('interested_property');
        $this->hubspotHapikey = $request->input('hubspot_hapikey');
        $this->hubspotBaseurl = $request->input('hubspot_baseurl');
        $this->smsRecipients = $request->input('sms_recipients');
        $this->ipAddress = $request->input('ip_address');
        $this->referrerUrl = $request->input('referrer_url');
        $this->sourceUrl = $request->input('source_url');
        return $this;
    }
}