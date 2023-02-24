<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTechnicialProjectMilestoneAssignmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('technicial_project_milestone_assignments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('assigned')->unsigned();

            $table->foreignId('project_milestone_id');
            
            $table->foreign('assigned')->references('id')->on('users');
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
        Schema::dropIfExists('technicial_project_milestone_assignments');
    }
}
