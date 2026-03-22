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
        Schema::create('course_resources', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->string('file_path'); // đường dẫn file trên storage
            $table->enum('type', ['video', 'pdf', 'code', 'image']);
            $table->integer('order')->default(0);        // thứ tự bài học
            $table->boolean('is_preview')->default(false); // cho phép xem trước
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_resources');
    }
};
