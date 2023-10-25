<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebsitePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('website_packages', function (Blueprint $table) {
            $table->id();
            $table->integer('website_detail_id');
            $table->string('package_name');
            $table->string('description');
            $table->string('recurrence');
            $table->string('price');
            $table->string('discount');
            $table->string('trial');
            $table->integer('sign_up_free');
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
        Schema::dropIfExists('website_packages');
    }
}
