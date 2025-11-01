<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('eloquent_reenactment_events', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->dateTime('start');
            $table->dateTime('end');
        });

        Schema::create('eloquent_participants', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('second_name')->nullable();
            $table->string('group_name')->nullable();
        });

        Schema::create('eloquent_participant_eloquent_reenactment_event', function (Blueprint $table) {
            $table->uuid('eloquent_reenactment_event_id');
            $table->unsignedBigInteger('eloquent_participant_id');

            $table->primary(['eloquent_reenactment_event_id', 'eloquent_participant_id']);

            $table->foreign('eloquent_reenactment_event_id')
                ->references('id')
                ->on('eloquent_reenactment_events')
                ->onDelete('cascade');

            $table->foreign('eloquent_participant_id')
                ->references('id')
                ->on('eloquent_participants')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reenactment_events');
        Schema::dropIfExists('participants');
        Schema::dropIfExists('reenactment_event_participant');
    }
};
