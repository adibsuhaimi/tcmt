<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestresultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('testresults', function (Blueprint $table) {
            $table->increments('testresultid');
            $table->integer('testcaseid')->unsigned();
            $table->foreign('testcaseid')->references('testcaseid')->on('testcases')->onDelete('cascade');;

            $table->string('testresultreference');
            $table->string('testresultstatus');
            $table->string('testresultcomment')->nullable();
            $table->boolean('testresultvisible');
            $table->mediumText('testresultfile')->nullable();
            $table->bigInteger('testresultduration')->nullable();
            $table->bigInteger('testresultfixdefect')->nullable();
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
        Schema::dropIfExists('testresults');
    }
}
