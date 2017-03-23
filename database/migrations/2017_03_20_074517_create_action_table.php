<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('action_type_id')->unsigned();
            $table->integer('job_id')->unsigned();
            $table->integer('triggerable_id')->unsigned();
            $table->text('triggerable_type')->nullable();
            $table->foreign('action_type_id')->references('id')->on('action_types')->onDelete('cascade');;
            $table->foreign('job_id')->references('id')->on('jobs')->onDelete('cascade');;
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
        Schema::dropIfExists('actions');
    }
}
