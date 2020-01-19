<?php
/**
 * Created by PhpStorm.
 * User: joshu
 * Date: 1/19/2020
 * Time: 16:42
 */

namespace App\DataModels;


class HubspotPostDataModel
{
    private $_data;


    public function toModel(LeadDataModel $model)
    {
        $this->_data = [];
        $this->_data['properties'] = [
            [
                'property' => 'firstname',
                'value' => $model->firstName
            ],
            [
                'property' => 'lastname',
                'value' => $model->lastName
            ],
            [
                'property' => 'phone',
                'value' => $model->phone
            ],
            [
                'property' => 'interested_property',
                'value' => $model->interestedProperty
            ],
            [
                'property' => 'ip_address',
                'value' => $model->ipAddress
            ]
        ];

        return $this->_data;
    }
}