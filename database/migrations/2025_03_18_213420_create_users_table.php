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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('role_id')->index();
            $table->string('name')->nullable();
            $table->string('email')->index();
            $table->string('password')->nullable();
            $table->timestamp('password_expired_at')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('tfa_secret')->nullable();
            $table->timestamp('last_login_at')->nullable();
            $table->boolean('is_active')->nullable()->default(true);
            $table->timestamps();
            $table->softDeletes();
            $table->charset = 'utf8mb4';

            $table->unique(['email', 'is_active']);
            $table->foreign('role_id')->references('id')->on('roles');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
