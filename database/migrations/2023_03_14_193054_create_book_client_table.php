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
        Schema::create('book_client', function (Blueprint $table) {
            $table->foreignId('book_id')->constrained('books')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreignId('client_id')->constrained('clients')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->primary(['book_id','client_id']);
            $table->tinyInteger('mark')->default(0);
            $table->tinyInteger('favourite')->default(0);
            $table->tinyInteger('like')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_client');
    }
};
