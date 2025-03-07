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
            $table->foreignId('technician_request_id')->constrained()->onDelete('cascade'); // Request ID
            $table->string('equipment_name');
            $table->integer('quantity');
            $table->decimal('max_power', 10, 2); // In watts
            $table->integer('day_hours_usage');
            $table->integer('night_hours_usage');
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
