<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCaseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cases', function (Blueprint $table) {
            $table->increments('id');
            $table->mediumText('title');
            $table->mediumText('short_title')->nullable();
            $table->text('scra');
            $table->string('grno');
            $table->date('date')->default(\Carbon\Carbon::now());
            $table->mediumText('topic')->nullable();
            $table->longText('syllabus');
            $table->longText('body');
            $table->text('full_txt')->nullable();
            $table->text('status');
            $table->integer('createdBy');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('cases');
    }
}
