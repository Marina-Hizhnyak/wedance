<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

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
                'slug' => Str::slug('Soirée Bachata'),
                'description' => 'Plongez dans l’univers envoûtant de la Bachata lors de cette soirée exceptionnelle ! Profitez d’un DJ Live qui vous fera vibrer sur les meilleurs morceaux de Bachata. L’ambiance chaleureuse et festive vous garantit une nuit inoubliable. Des animations de groupe, des démonstrations par des danseurs professionnels, ainsi que des surprises tout au long de la soirée vous attendent. Rejoignez la communauté des passionnés de danse dans l’un des plus beaux lieux de Bruxelles : l’Albert Hall. Dress code : élégant avec une touche latine. Préparez-vous à vivre une expérience unique où la danse et le plaisir seront à l’honneur.',
                'location' => 'Albert Hall, Bruxelles',
                'organizer_id' => 5,
                'date' => '2025-05-25 20:00:00',
                'image' => 'events/soiree-bachata.jpg',
            ],
            [
                'title' => 'Stage Salsa Intermédiaire',
                'slug' => Str::slug('Stage Salsa Intermédiaire'),
                'description' => 'Ce stage intensif s’adresse aux danseurs et danseuses de niveau intermédiaire qui souhaitent perfectionner leur technique et enrichir leur style. Pendant plusieurs heures, vous aurez la chance d’apprendre avec des professeurs invités de renommée internationale. Le programme comprend : technique des tours, travail du style, musicalité, expression corporelle et connexion avec le partenaire. Des ateliers spécifiques et des séances de pratique vous permettront de progresser à votre rythme. Vivez une immersion totale dans l’univers de la salsa, dans le cadre convivial du Studio Mambo à Bruxelles. Réservez votre place rapidement car le nombre de participants est limité !',
                'location' => 'Studio Mambo, Bruxelles',
                'organizer_id' => 5,
                'date' => '2025-06-10 18:30:00',
                'image' => 'events/stage-salsa.jpg',
            ],
            [
                'title' => 'Zouk Weekend',
                'slug' => Str::slug('Zouk Weekend'),
                'description' => 'Le WEDANCE Loft ouvre ses portes pour un week-end 100% dédié au Zouk. Deux jours de pur bonheur avec des workshops intensifs animés par des artistes internationaux. Initiez-vous ou perfectionnez votre style dans un cadre unique et convivial. Au programme : techniques de guidage et de connexion, travail sur la fluidité des mouvements, musicalité et style personnel. Des soirées dansantes prolongeront l’expérience jusque tard dans la nuit avec DJ et ambiance de folie. De nombreuses animations, des démonstrations et des surprises rythmeront l’événement. Repas et boissons seront disponibles sur place pour un week-end inoubliable dédié à la danse et au partage.',
                'location' => 'WEDANCE Loft',
                'organizer_id' => 5,
                'date' => '2025-07-06 10:00:00',
                'image' => 'events/zouk-weekend.jpg',
            ]
        ]);
    }
}
