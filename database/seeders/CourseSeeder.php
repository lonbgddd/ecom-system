<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    
    $admin = User::first();

        Course::create([
            'title' => 'Lập trình IoT với ESP32 từ cơ bản đến nâng cao',
            'description' => 'Khóa học giúp bạn làm chủ ESP32, kết nối WiFi, MQTT, xây dựng hệ thống Smart Home và điều khiển thiết bị từ xa.',
            'price' => 199000,
            'slug' => Str::slug('Lập trình IoT với ESP32 từ cơ bản đến nâng cao'),
            'thumbnail' => null,
            'status' => 'published',
            'created_by' => $admin->id,
        ]);

        Course::create([
            'title' => 'Arduino và cảm biến trong IoT thực tế',
            'description' => 'Học cách sử dụng Arduino với các cảm biến nhiệt độ, độ ẩm, ánh sáng và xây dựng hệ thống giám sát môi trường.',
            'price' => 0, // miễn phí
            'slug' => Str::slug('Arduino và cảm biến trong IoT thực tế'),
            'thumbnail' => null,
            'status' => 'published',
            'created_by' => $admin->id,
        ]);
    //
    }
}
