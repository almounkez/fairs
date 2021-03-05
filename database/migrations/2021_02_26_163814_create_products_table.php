<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('suite_id');
            $table->unsignedBigInteger('cat_id');
            $table->string('sub_id')->nullable();
            
            $table->string('name_ar');
            $table->string('name_en');


            $table->string('imgfile')->nullable();
            $table->boolean('active')->nullable()->default(true);
            $table->string('descp_ar')->nullable();
            $table->string('descp_en')->nullable();
            $table->unsignedBigInteger('hits')->default(0);
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
        Schema::dropIfExists('products');
    }
}
