<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebsiteDetailContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('website_detail_contacts', function (Blueprint $table) {
            $table->id();
            $table->integer('website_location_id');
            $table->string('branch_name')->nullable();
            $table->string('branch_number')->nullable();
            $table->string('branch_email')->nullable();
            $table->time('monday_open_time');
            $table->time('monday_close_time');
            $table->time('tuesday_open_time');
            $table->time('tuesday_close_time');
            $table->time('wednesday_open_time');
            $table->time('wednesday_close_time');
            $table->time('thursday_open_time');
            $table->time('thursday_close_time');
            $table->time('friday_open_time');
            $table->time('friday_close_time');
            $table->time('saturday_open_time');
            $table->time('saturday_close_time');
            $table->time('sunday_open_time');
            $table->time('sunday_close_time');
            $table->boolean('same_time_everyday')->default(false);
            $table->boolean('same_time_weekdays')->default(false);
            $table->boolean('same_time_weekends')->default(false);
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
        Schema::dropIfExists('website_detail_contacts');
    }
}
