<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoadEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('load_entries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('load_audit_generation_id')->constrained()->onDelete('cascade'); // Request ID
            $table->string('equipment_name');
            $table->integer('quantity');
            $table->decimal('power', 10, 2); // In watts
            $table->integer('hours_day');
            $table->integer('hours_night');
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
        Schema::dropIfExists('load_entries');
    }
}
