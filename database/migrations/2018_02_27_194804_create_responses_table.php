<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResponsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('responses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('question_number');
            $table->string('question');
            $table->integer('answer');
            $table->integer('test_application_id')->unsigned();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('responses', function ($table) {
            $table->foreign('test_application_id')
                ->references('id')
                ->on('test_applications')
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
        Schema::dropIfExists('responses');
    }
}
