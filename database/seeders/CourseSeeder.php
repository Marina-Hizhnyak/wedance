<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Course::insert([
            [
                'title' => 'Salsa Débutant',
                'description' => 'Les bases de la salsa pour bien démarrer.',
                'price' => 20.00,
                'day_time' => 'Lundi 18:00',
                'image' => 'salsa1.jpg',
                'duration' => '2 heures',
                'instructor_id' => 5,
                'course_category_id' => 1,
                'course_level_id' => 1,
            ],
            [
                'title' => 'Salsa Intermédiaire',
                'description' => 'Améliorez votre style en salsa.',
                'price' => 22.00,
                'day_time' => 'Mercredi 19:00',
                'image' => 'salsa2.jpg',
                'duration' => '2 heures',
                'instructor_id' => 6,
                'course_category_id' => 1,
                'course_level_id' => 2,
            ],
            [
                'title' => 'Bachata Débutant',
                'description' => 'Cours de bachata pour débutants.',
                'price' => 20.00,
                'day_time' => 'Mardi 18:00',
                'image' => 'bachata1.jpg',
                'duration' => '1h30',
                'instructor_id' => 7,
                'course_category_id' => 2,
                'course_level_id' => 1,
            ],
            [
                'title' => 'Bachata Avancé',
                'description' => 'Techniques avancées de bachata.',
                'price' => 25.00,
                'day_time' => 'Jeudi 20:00',
                'image' => 'bachata2.jpg',
                'duration' => '2 heures',
                'instructor_id' => 8,
                'course_category_id' => 2,
                'course_level_id' => 3,
            ],
            [
                'title' => 'Lindy Hop Débutant',
                'description' => 'Danse swing pour les débutants.',
                'price' => 18.00,
                'day_time' => 'Mercredi 17:00',
                'image' => 'lindy1.jpg',
                'duration' => '1h30',
                'instructor_id' => 9,
                'course_category_id' => 3,
                'course_level_id' => 1,
            ],
            [
                'title' => 'Zouk Intermédiaire',
                'description' => 'Travail de fluidité et musicalité.',
                'price' => 21.00,
                'day_time' => 'Lundi 19:30',
                'image' => 'zouk2.jpg',
                'duration' => '2 heures',
                'instructor_id' => 10,
                'course_category_id' => 4,
                'course_level_id' => 2,
            ],
            [
                'title' => 'Lady Styling Avancé',
                'description' => 'Travail des isolations, posture et style.',
                'price' => 23.00,
                'day_time' => 'Vendredi 20:00',
                'image' => 'lady1.jpg',
                'duration' => '2 heures',
                'instructor_id' => 11,
                'course_category_id' => 5,
                'course_level_id' => 3,
            ],
        ]);
    }
}
