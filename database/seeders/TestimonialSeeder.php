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
            'name' => 'Hannah Schmitt',
            'position' => 'Lead designer',
            'avatar' => '/images/testimonials/hannah.jpg',
            'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cursus nibh mauris, nec turpis orci lectus maecenas.',
        ]);

        Testimonial::create([
            'name' => 'Lucie Bernard',
            'position' => 'Développeuse front-end',
            'avatar' => '/images/testimonials/lucie.jpg',
            'content' => 'Suspendisse sed magna eget nibh in turpis. Consequat duis diam lacus arcu.',
        ]);

        Testimonial::create([
            'name' => 'Tania Martin',
            'position' => 'Chef de projet',
            'avatar' => '/images/testimonials/tania.jpg',
            'content' => 'Faucibus venenatis felis id augue sit cursus pellentesque enim. Integer sodales velit at nulla malesuada.',
        ]);

        Testimonial::create([
            'name' => 'Alex Dupont',
            'position' => 'Directeur artistique',
            'avatar' => '/images/testimonials/alex.jpg',
            'content' => 'Un super projet mené avec une équipe très professionnelle. Je recommande vivement !',
        ]);

        Testimonial::create([
            'name' => 'Maya Louvet',
            'position' => 'Photographe',
            'avatar' => '/images/testimonials/maya.jpg',
            'content' => 'J’ai adoré collaborer avec Wedance. L’ambiance, les gens, tout est top !',
        ]);
    }
}
