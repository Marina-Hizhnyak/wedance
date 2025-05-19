<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Testimonial::create([
            'user_id' => 1,
            'position' => 'Designer UX',
            'avatar' => '/images/testimonials/hannah.png',
            'content' => 'Une ambiance incroyable et des cours de bachata super bien structurés. On progresse sans même s’en rendre compte !',
            'rating' => 5,
        ]);

        Testimonial::create([
            'user_id' => 2,
            'position' => 'Développeuse front-end',
            'avatar' => '/images/testimonials/lucie.png',
            'content' => 'J’ai adoré mon expérience chez Wedance ! Les profs sont à l’écoute et l’énergie du groupe est géniale.',
            'rating' => 5,
        ]);

        Testimonial::create([
            'user_id' => 3,
            'position' => 'Chef de projet',
            'avatar' => '/images/testimonials/tania.png',
            'content' => 'Une école où l’on se sent vraiment bienvenu. Les soirées dansantes sont un vrai plus pour pratiquer.',
            'rating' => 4,
        ]);

        Testimonial::create([
            'user_id' => 4,
            'position' => 'Directeur artistique',
            'avatar' => '/images/testimonials/alex.png',
            'content' => 'Excellente pédagogie et ambiance chaleureuse. J’ai redécouvert la salsa avec plaisir.',
            'rating' => 5,
        ]);

        Testimonial::create([
            'user_id' => 5,
            'position' => 'Photographe',
            'avatar' => '/images/testimonials/maya.png',
            'content' => 'Wedance, c’est plus qu’une école de danse : c’est une vraie famille ! Merci pour ces moments inoubliables.',
            'rating' => 5,
        ]);

        Testimonial::create([
            'user_id' => 6,
            'position' => 'Coach bien-être',
            'avatar' => '/images/testimonials/diana.png',
            'content' => 'Les cours sont dynamiques et accessibles à tous. Idéal pour se détendre après le travail.',
            'rating' => 5,
        ]);
    }
}
