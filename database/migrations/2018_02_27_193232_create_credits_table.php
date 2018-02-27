<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCreditsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('credits', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('amount');
            $table->integer('organization_id')->unsigned();
            $table->integer('test_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('credits', function ($table) {
            $table->foreign('organization_id')
                ->references('id')
                ->on('organizations')
                ->onDelete('cascade');
        });

        Schema::table('credits', function ($table) {
            $table->foreign('test_id')
                ->references('id')
                ->on('tests')
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
        Schema::dropIfExists('credits');
    }
}
