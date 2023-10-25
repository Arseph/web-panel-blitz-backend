<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectionCarouselSlidesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('section_carousel_slides', function (Blueprint $table) {
            $table->id();
            $table->integer('section_carousel_id');
            $table->integer('media_id')->nullable();
            $table->text('text');
            $table->string('backgroundColor');
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
        Schema::dropIfExists('section_carousel_slides');
    }
}
