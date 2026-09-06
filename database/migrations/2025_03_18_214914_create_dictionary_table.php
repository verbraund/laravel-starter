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
        Schema::create('dictionary', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('key',50)->unique();
            $table->string('type',10);
            $table->integer('small_value')->index()->nullable();
            $table->string('value',200)->index()->nullable();
            $table->text('long_value')->nullable();
            $table->mediumText('extra_value')->charset('binary')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dictionary');
    }
};
