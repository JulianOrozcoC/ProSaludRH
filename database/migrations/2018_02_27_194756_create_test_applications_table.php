<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test_applications', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('expiry')->nullable();
            $table->dateTime('completed_on')->nullable();
            $table->integer('user_id')->unsigned();
            $table->integer('test_id')->unsigned();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('test_applications', function ($table) {
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });

        Schema::table('test_applications', function ($table) {
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
        Schema::dropIfExists('test_applications');
    }
}
