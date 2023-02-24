<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMilestoneReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('milestone_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_milestone_id');
            $table->string('title');
            $table->longText('body');

            $table->string('date');

            $table->bigInteger('assigned_id')->unsigned();
            $table->foreign('assigned_id')->references('id')->on('users');

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
        Schema::dropIfExists('milestone_reports');
    }
}
