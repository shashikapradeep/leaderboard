<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('event_leader', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->unsignedInteger('event_id');
            $table->unsignedInteger('leader_id');
            $table->timestamps();

            $table->foreign('event_id')->references('id')->on('events');
            $table->foreign('leader_id')->references('id')->on('leaders');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop('event_leader', function (Blueprint $table) {
            //
        });
    }
};
