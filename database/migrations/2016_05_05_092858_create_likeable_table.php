<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLikeableTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //photo table for example
        //likeable_id:photo 1
        //likeable_id:photo
        //polymorphism relationship 
        Schema::create('likeable',function(Blueprint $table) {
           
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('likeable_id');
            $table->string('likeable_type');
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
        //
        
        Schema::drop('likeable');
    }
}
