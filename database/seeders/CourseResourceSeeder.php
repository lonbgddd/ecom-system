<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\CourseResource;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseResourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    
        // lấy 2 khóa học đã tạo
        $courses = Course::all();

        foreach ($courses as $course) {

            // ===== COURSE 1: ESP32 =====
            if (str_contains($course->title, 'ESP32')) {

                CourseResource::insert([
                    [
                        'course_id' => $course->id,
                        'title' => 'Giới thiệu ESP32',
                        'file_path' => 'https://commondatastorage.googleapis.com/gtv-videos-bucket/sample/Sintel.mp4',
                        'type' => 'video',
                        'order' => 1,
                        'is_preview' => true,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                    [
                        'course_id' => $course->id,
                        'title' => 'Kết nối WiFi với ESP32',
                        'file_path' => 'https://commondatastorage.googleapis.com/gtv-videos-bucket/sample/Sintel.mp4',
                        'type' => 'video',
                        'order' => 2,
                        'is_preview' => false,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                    [
                        'course_id' => $course->id,
                        'title' => 'Giao thức MQTT',
                        'file_path' => 'https://commondatastorage.googleapis.com/gtv-videos-bucket/sample/Sintel.mp4',
                        'type' => 'video',
                        'order' => 3,
                        'is_preview' => false,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                ]);
            }

            // ===== COURSE 2: Arduino =====
            if (str_contains($course->title, 'Arduino')) {

                CourseResource::insert([
                    [
                        'course_id' => $course->id,
                        'title' => 'Giới thiệu Arduino',
                        'file_path' => 'https://commondatastorage.googleapis.com/gtv-videos-bucket/sample/Sintel.mp4',
                        'type' => 'video',
                        'order' => 1,
                        'is_preview' => true,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                    [
                        'course_id' => $course->id,
                        'title' => 'Cảm biến nhiệt độ DHT11',
                        'file_path' => 'https://commondatastorage.googleapis.com/gtv-videos-bucket/sample/Sintel.mp4',
                        'type' => 'video',
                        'order' => 2,
                        'is_preview' => true,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                    [
                        'course_id' => $course->id,
                        'title' => 'Tài liệu cảm biến',
                        'file_path' => 'https://commondatastorage.googleapis.com/gtv-videos-bucket/sample/Sintel.mp4',
                        'type' => 'video',
                        'order' => 3,
                        'is_preview' => false,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                ]);
            }
        }
    }
}
