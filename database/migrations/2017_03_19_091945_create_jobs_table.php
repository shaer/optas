<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('namespace');
            $table->dateTime('next_run_date')->nullable();

            $table->char('job_status',1)->default("P");
            $table->dateTime('started_at')->nullable();
            $table->dateTime('ended_at')->nullable();
            
            $table->text('raw_schedule')->nullable();
            $table->string('schedule')->nullable();
            
            $table->char('is_automated',1)->default("T");
            $table->integer('created_by')->unsigned();
            $table->foreign('created_by')->references('id')->on('users');

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
        Schema::dropIfExists('jobs');
    }
}
