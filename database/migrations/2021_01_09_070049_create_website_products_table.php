<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebsiteProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('website_products', function (Blueprint $table) {
            $table->id();
            $table->integer('website_detail_id');
            $table->string('product_name');
            $table->string('description');
            $table->string('stock');
            $table->string('categories');
            $table->string('sub_categories');
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
        Schema::dropIfExists('website_products');
    }
}
