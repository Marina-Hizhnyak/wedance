<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Event::insert([
            [
                'title' => 'Soirée Bachata',
                'description' => 'Une soirée 100% Bachata avec DJ Live et animations.',
                'location' => 'Albert Hall, Bruxelles',
                'organizer_id' => null,
                'date' => '2025-05-25 20:00:00',
            ],
            [
                'title' => 'Stage Salsa Intermédiaire',
                'description' => 'Améliorez votre technique avec des professeurs invités.',
                'location' => 'Studio Mambo, Bruxelles',
                'organizer_id' => null,
                'date' => '2025-06-10 18:30:00',
            ],
            [
                'title' => 'Zouk Weekend',
                'description' => '2 jours intensifs de Zouk avec workshops et soirées.',
                'location' => 'WEDANCE Loft',
                'organizer_id' => null,
                'date' => '2025-07-06 10:00:00',
            ]
        ]);
    }
}
