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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->decimal('price', 8, 2);
            $table->string('duration'); // ex: "2 heures"
            $table->string('day_time'); // ex: "Vendredi 19:00"
            $table->string('image')->nullable();
            $table->unsignedBigInteger('instructor_id')->nullable();
            $table->foreignId('course_category_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('course_level_id')->nullable()->constrained()->onDelete('set null');
            $table->timestamps();
            $table->foreign('instructor_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
