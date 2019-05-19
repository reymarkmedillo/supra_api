<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCaseGroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('case_group', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('case_id');
            $table->text('refno')->nullable();
            $table->mediumtext('title')->nullable();
            $table->mediumtext('short_title')->nullable();
            $table->date('date')->nullable();
            $table->string('scra')->unique()->nullable();
            $table->text('status')->nullable();
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
        Schema::drop('case_group');
    }
}
