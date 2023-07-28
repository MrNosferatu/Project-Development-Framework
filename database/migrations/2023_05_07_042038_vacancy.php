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
        Schema::create('Vacancy', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->foreignId('company_id')->constrained('companies')->onDelete('cascade');
            $table->timestamps('created_at');
            $table->string('title');
            $table->string('description')->nullable();
            $table->string('type')->nullable();
            $table->string('qualification')->nullable();
            $table->string('location')->nullable();
            $table->integer('salary')->nullable();
            $table->string('requirement')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Vacancy');
    }
};
