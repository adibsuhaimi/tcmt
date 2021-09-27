<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestcasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('testcases', function (Blueprint $table) {
            $table->increments('testcaseid');
            $table->integer('reqid')->unsigned();
            $table->foreign('reqid')->references('reqid')->on('requirements')->onDelete('cascade');;
            $table->integer('id')->unsigned();
            $table->foreign('id')->references('id')->on('users')->onDelete('cascade');;

            $table->string('testcasereference');
            $table->string('testcasetitle');
            $table->string('testcaseprecondition', 1000);
            $table->string('testcasestep', 1000);
            $table->string('testcaseexpresult');
            $table->mediumText('testcasefile')->nullable();
            $table->string('testcasepriority');
            $table->string('testcaseassign');
            $table->bigInteger('testcaseexptime');
            
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
        Schema::dropIfExists('testcases');
    }
}
