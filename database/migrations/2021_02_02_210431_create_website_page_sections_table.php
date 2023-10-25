<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebsitePageSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('website_page_sections', function (Blueprint $table) {
            $table->id();
            $table->integer('website_page_id');
            $table->integer('order');
            $table->integer('section_id');
            $table->string('section_type');
            $table->string('component_type');
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
        Schema::dropIfExists('website_page_sections');
    }
}
