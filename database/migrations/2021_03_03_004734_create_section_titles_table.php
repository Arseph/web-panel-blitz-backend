<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectionTitlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('section_titles', function (Blueprint $table) {
            $table->id();
            $table->integer('website_page_section_id');
            $table->string('parameter');
            $table->text('value');
            $table->enum('datatype', ['STRING', 'BOOLEAN', 'INTEGER', 'FLOAT', 'ARRAY']);
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
        Schema::dropIfExists('section_title');
    }
}
