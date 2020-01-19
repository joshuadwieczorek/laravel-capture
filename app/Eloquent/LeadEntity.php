<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class LeadEntity extends Model
{
    protected $table = 'eds_leads';

    protected $fillable = [
        'first_name', 'last_name', 'email_address', 'phone_number', 'ip_address',
        'interested_property', 'referrer_url', 'source_url', 'sent_to_hubsopt',
        'sms_sent_to'
    ];
}
