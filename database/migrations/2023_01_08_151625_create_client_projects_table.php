<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description');
            $table->integer('percent_completion')->nullable();

            $table->foreignId('customer_id');

            $table->string('location')->nullable();
            $table->string('country')->nullable();
            $table->string('state')->nullable();

            

            $table->string('status')->default('in progress');
            $table->integer('amount_spent')->nullable();
            $table->string('start_date');
            $table->string('completion_date')->nullable();

            
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
        Schema::dropIfExists('client_projects');
    }
}
