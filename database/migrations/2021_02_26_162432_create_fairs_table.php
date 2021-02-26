<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFairsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fairs', function (Blueprint $table) {
            $table->id();
            $table->string('name_ar');
            $table->string('name_en');
            $table->string('logo_en')->nullable();
            $table->string('logo_ar')->nullable();
            $table->datetime('start_date')->nullable()->useCurrent();
            $table->datetime('end_date')->nullable()->useCurrent();
            $table->boolean('active')->nullable()->default(false);
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
        Schema::dropIfExists('fairs');
    }
}
