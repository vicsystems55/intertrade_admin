<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoadAuditGenerationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('load_audit_generations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('request_code')->unique();
            $table->string('region_selection');
            $table->integer('preferred_backup_time');
            $table->string('solar_panel_size_preference');
            $table->string('inverter_type_selection');
            $table->decimal('total_max_power', 10, 2);
            $table->decimal('total_load_consumption', 10, 2);
            $table->decimal('battery_capacity_ah', 10, 2);
            $table->decimal('battery_voltage', 10, 2);
            $table->string('battery_type');
            $table->integer('battery_count');

            $table->decimal('required_solar_panel_power_w', 10, 2);
            $table->integer('number_of_panels');
            $table->decimal('recommended_inverter_size_w', 10, 2);
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
        Schema::dropIfExists('load_audit_generations');
    }
}
