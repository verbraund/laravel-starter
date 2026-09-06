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
        Schema::create('todo_category', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('todo_id')->index();
            $table->unsignedBigInteger('category_id')->index();

            $table->foreign('todo_id')->references('id')->on('todos');
            $table->foreign('category_id')->references('id')->on('todo_categories');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('todo_category');
    }
};
