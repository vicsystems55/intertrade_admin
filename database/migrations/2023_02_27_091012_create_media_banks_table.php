<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediaBanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('media_banks', function (Blueprint $table) {
            $table->id();
            $table->string('url');
            $table->string('download_url')->nullable();
            $table->string('location')->nullable();
            $table->foreignId('project_id')->nullable();

            $table->string('name');
            $table->string('description');
            $table->string('status');
            $table->string('type');
            $table->integer('size');
            $table->bigInteger('uploaded_by')->unsigned();
            $table->foreign('uploaded_by')->references('id')->on('users');
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
        Schema::dropIfExists('media_banks');
    }
}
