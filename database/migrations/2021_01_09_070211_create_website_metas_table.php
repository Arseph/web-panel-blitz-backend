<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebsiteMetasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('website_metas', function (Blueprint $table) {
            $table->id();
            $table->integer('website_detail_id');
            $table->string('fav_icon');
            $table->string('page_meta_title');
            $table->string('page_meta_description');
            $table->string('og_meta_image');
            $table->string('og_meta_title');
            $table->string('og_meta_description');
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
        Schema::dropIfExists('website_metas');
    }
}
