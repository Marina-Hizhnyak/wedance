<?php

namespace Database\Seeders;

use App\Models\CourseLevel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CourseLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $levels = [
            'Débutant',
            'Intermédiaire',
            'Avancé',
        ];

        foreach ($levels as $name) {
            CourseLevel::create([
                'name' => $name,
                'slug' => Str::slug($name),
            ]);
        }
    }
}
