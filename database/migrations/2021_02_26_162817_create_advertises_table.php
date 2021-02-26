<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvertisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertises', function (Blueprint $table) {
            $table->id();
                     $table->unsignedBigInteger('fair_id')->nullable();
$table->datetime('start_date')->nullable()->useCurrent();
$table->datetime('end_date')->nullable()->useCurrent();
$table->boolean('active')->nullable()->default(true);
            $table->string('imgfile')->nullable();
            $table->string('location')->nullable();
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
        Schema::dropIfExists('advertises');
    }
}
