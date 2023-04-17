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
        Schema::create('reading_groups', function (Blueprint $table) {
            $table->id();
            $table->string('name')->default('Reading Group');
            $table->foreignId('client_id')->constrained('clients')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreignId('book_id')->constrained('books')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->unsignedInteger('members')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reading_groups');
    }
};
