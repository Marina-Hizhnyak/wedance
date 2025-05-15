<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BlogPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BlogPost::insert([
            [
                'title' => 'Découvrez la passion de la Bachata',
                'content' => 'La bachata est bien plus qu\'une simple danse : c\'est une véritable expérience sensorielle. Dans cet article, nous explorons l\'histoire de la bachata, ses origines en République dominicaine, et comment elle a conquis le monde. Vous apprendrez également des conseils pratiques pour débuter et progresser rapidement dans cette danse pleine de sensualité.',
                'image' => 'blog/bachata-passion.jpg',
                'author_id' => 1,
                'slug' => Str::slug('Découvrez la passion de la Bachata'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Les bienfaits insoupçonnés de la Salsa',
                'content' => 'Au-delà du plaisir de danser, la salsa offre de nombreux avantages pour la santé : amélioration de la posture, coordination, perte de poids, et surtout, elle renforce la confiance en soi. Nous partageons dans cet article les témoignages de danseurs qui expliquent comment la salsa a changé leur vie.',
                'image' => 'blog/salsa-bienfaits.jpg',
                'author_id' => 1,
                'slug' => Str::slug('Les bienfaits insoupçonnés de la Salsa'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Comment progresser rapidement en danse latine',
                'content' => 'Beaucoup de nouveaux danseurs se demandent comment accélérer leur apprentissage. Nous vous donnons ici des conseils d’experts : la régularité des cours, le choix du bon partenaire, l’écoute musicale, et la participation aux soirées dansantes sont les clés d’une progression rapide et durable.',
                'image' => 'blog/progresser-danse-latine.jpg',
                'author_id' => 1,
                'slug' => Str::slug('Comment progresser rapidement en danse latine'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Top 5 des musiques incontournables pour vos soirées Salsa',
                'content' => 'Pour animer vos soirées salsa, rien de tel qu’une playlist bien pensée. Voici notre sélection des 5 morceaux incontournables qui feront danser tous vos invités, du classique intemporel au hit moderne.',
                'image' => 'blog/top5-salsa.jpg',
                'author_id' => 1,
                'slug' => Str::slug('Top 5 des musiques incontournables pour vos soirées Salsa'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Zouk : l\'art de la connexion entre partenaires',
                'content' => 'Le Zouk est reconnu pour sa fluidité et sa sensualité. Ce style met l’accent sur la connexion et la communication non verbale entre partenaires. Découvrez les techniques essentielles et les astuces pour améliorer votre danse et ressentir pleinement la magie du Zouk.',
                'image' => 'blog/zouk-connexion.jpg',
                'author_id' => 1,
                'slug' => Str::slug('Zouk : l\'art de la connexion entre partenaires'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
