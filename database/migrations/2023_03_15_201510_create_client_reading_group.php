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
        Schema::create('client_reading_groups', function (Blueprint $table) {
            $table->foreignId('client_id')->constrained('clients')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreignId('reading_group_id')->constrained('reading_groups')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->primary(['client_id','reading_group_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_reading_groups');
    }
};
