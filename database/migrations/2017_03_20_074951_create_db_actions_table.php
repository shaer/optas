<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDbActionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('db_actions', function (Blueprint $table) {
            $table->increments('id');
            $table->text('query');
            $table->char('is_csv', 1)->default('F');
            $table->integer('connection_id')->unsigned();
            $table->foreign('connection_id')->references('id')->on('connections')->onDelete('cascade');
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
        Schema::dropIfExists('db_actions');
    }
}
