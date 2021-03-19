<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMailListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mail_lists', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('source_id');
            $table->string('source_type');
            $table->string('full_name');
            $table->string('country');
            $table->string('city');
            $table->string('email')->nullable();
            $table->string('mobile')->nullable();
            $table->timestamps();
            $table->unique(['email','source_id','source_type']);
            $table->unique(['mobile','country','city','source_id','source_type']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mail_lists');
    }
}
