<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fair_id');
            $table->string('name_ar');
            $table->string('name_en');
            $table->string('imgfile')->nullable();
            $table->unsignedBigInteger('hits')->default(0);
            $table->timestamps();

            $table->unique(['fair_id', 'name_ar']);
            $table->unique(['fair_id', 'name_en']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
