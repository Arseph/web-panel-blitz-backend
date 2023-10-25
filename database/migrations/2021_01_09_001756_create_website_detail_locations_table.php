<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebsiteDetailLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('website_detail_locations', function (Blueprint $table) {
            $table->id();
            $table->integer('website_detail_id');
            $table->string('company_name');
            $table->string('country');
            $table->string('state');
            $table->string('address');
            $table->string('number');
            $table->string('email');
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
        Schema::dropIfExists('website_detail_locations');
    }
}
