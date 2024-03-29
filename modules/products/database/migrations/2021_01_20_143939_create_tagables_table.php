<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tagables', function (Blueprint $table) {
           $table->bigIncrements('id');
           $table->unsignedBigInteger('tag_id');
           $table->morphs('tagable');
           $table->timestamps();
           $table->foreign('tag_id')
           ->references('id')->on('tags')
           ->onDelete('cascade');
       });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tagables');
    }
}
