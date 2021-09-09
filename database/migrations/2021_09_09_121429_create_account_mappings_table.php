<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountMappingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_mappings', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('account_heads_id')->unsigned();
            $table->string('status')->default('active');
            $table->bigInteger('account_sub_head_id')->unsigned();
       
            $table->foreign('account_heads_id')->references('id')->on('account_heads');
            $table->foreign('account_sub_head_id')->references('id')->on('account_sub_heads');
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
        Schema::dropIfExists('account_mappings');
    }
}
