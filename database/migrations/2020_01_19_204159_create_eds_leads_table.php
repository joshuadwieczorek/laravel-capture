<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEdsLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eds_leads', function (Blueprint $table) {
            $table->bigIncrements('ID');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email_address')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('ip_address')->nullable();
            $table->string('interested_property')->nullable();
            $table->string('referrer_url')->nullable();
            $table->string('source_url')->nullable();
            $table->boolean('sent_to_hubsopt')->default(0);
            $table->string('sms_sent_to')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('eds_leads');
    }
}
