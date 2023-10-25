<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectionOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('section_options', function (Blueprint $table) {
            $table->id();
            $table->integer('website_page_section_id');
            $table->string('parameter');
            $table->text('value');
            $table->enum('datatype', ['STRING', 'BOOLEAN', 'INTEGER', 'FLOAT']);
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
        Schema::dropIfExists('section_options');
    }
}
