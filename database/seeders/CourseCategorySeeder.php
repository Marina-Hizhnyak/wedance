<?php

namespace Database\Seeders;

use App\Models\CourseCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CourseCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Salsa',
            'Bachata',
            'Lindy Hop',
            'Zouk',
            'Lady Styling',
        ];

        foreach ($categories as $name) {
            CourseCategory::create([
                'name' => $name,
                'slug' => Str::slug($name),
            ]);
        }
    }
}
