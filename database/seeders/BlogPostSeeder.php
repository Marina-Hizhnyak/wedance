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
                'content' => <<<HTML
<p>La bachata est bien plus qu'une simple danse : c'est une véritable expérience sensorielle. Originaire de la République dominicaine, cette danse a conquis les cœurs à travers le monde grâce à sa musicalité envoûtante et ses mouvements sensuels.</p>

<p>Au fil des années, la bachata a évolué, passant des ruelles de Saint-Domingue aux studios de danse modernes. Elle se décline aujourd’hui en plusieurs styles : traditionnelle, moderne et sensual, chacun offrant une expérience unique.</p>

<p>Pour progresser en bachata, la régularité est la clé. Prendre des cours avec un professeur expérimenté, danser avec différents partenaires et écouter beaucoup de musique sont autant de façons de s'améliorer rapidement. Ne soyez pas intimidé : l’important est de se laisser porter par le rythme et de s’amuser !</p>
HTML,
                'image' => '/images/blog/1.jpg',
                'author_id' => 1,
                'slug' => Str::slug('Découvrez la passion de la Bachata'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Les bienfaits insoupçonnés de la Salsa',
                'content' => <<<HTML
<p>Danser la salsa, c’est bien plus que s’amuser : c’est aussi un excellent moyen de rester en forme et de se sentir bien dans son corps. Grâce à ses mouvements dynamiques, la salsa permet de travailler l'endurance, la coordination et le tonus musculaire.</p>

<p>Au-delà des bienfaits physiques, la salsa est aussi bénéfique pour le moral. Elle permet de se socialiser, de vaincre la timidité et de gagner en confiance. De nombreux danseurs témoignent d’un réel changement dans leur vie personnelle grâce à cette pratique.</p>

<p>Si vous cherchez une activité complète, joyeuse et accessible à tous, la salsa est faite pour vous. Alors n’attendez plus : chaussez vos chaussures de danse et rejoignez la piste !</p>
HTML,
                'image' => '/images/blog/2.png',
                'author_id' => 1,
                'slug' => Str::slug('Les bienfaits insoupçonnés de la Salsa'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Comment progresser rapidement en danse latine',
                'content' => <<<HTML
<p>La progression en danse latine dépend de plusieurs facteurs clés. Le premier est la régularité : assister à des cours chaque semaine permet de consolider ses acquis et de développer sa technique progressivement.</p>

<p>Le choix d’un bon partenaire est également essentiel. Avec quelqu’un de patient et à l’écoute, on apprend plus facilement à gérer la connexion et les déplacements.</p>

<p>N’oubliez pas l’écoute musicale : elle vous aide à mieux anticiper les accents et à rendre votre danse plus fluide. Enfin, participer à des soirées est indispensable pour appliquer vos connaissances dans un contexte réel. La pratique, c’est ce qui fait toute la différence !</p>
HTML,
                'image' => '/images/blog/3.jpg',
                'author_id' => 1,
                'slug' => Str::slug('Comment progresser rapidement en danse latine'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Top 5 des musiques incontournables pour vos soirées Salsa',
                'content' => <<<HTML
<p>Rien ne vaut une bonne playlist pour assurer l’ambiance d’une soirée salsa. Voici notre top 5 des musiques qui mettront tout le monde sur la piste :</p>

<p><strong>1. Marc Anthony – Vivir Mi Vida :</strong> Un hymne à la joie de vivre, parfait pour démarrer la soirée.</p>
<p><strong>2. Grupo Niche – Una Aventura :</strong> Ce classique colombien allie romantisme et rythme entraînant.</p>
<p><strong>3. Héctor Lavoe – Periódico de Ayer :</strong> Un incontournable du répertoire salsa new-yorkaise.</p>
<p><strong>4. Romeo Santos – Propuesta Indecente :</strong> Une touche de bachata fusionnée à la salsa pour varier les plaisirs.</p>
<p><strong>5. La Maxima 79 – Salsa Italiana :</strong> Une preuve que la salsa est universelle !</p>

<p>Ajoutez ces morceaux à votre playlist et laissez la magie opérer !</p>
HTML,
                'image' => '/images/blog/4.jpg',
                'author_id' => 1,
                'slug' => Str::slug('Top 5 des musiques incontournables pour vos soirées Salsa'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Zouk : l\'art de la connexion entre partenaires',
                'content' => <<<HTML
<p>Le Zouk est une danse née aux Antilles, célèbre pour ses mouvements fluides et sa musicalité sensuelle. Contrairement à d’autres danses plus techniques, le Zouk met l’accent sur la connexion entre les partenaires, presque comme une conversation silencieuse.</p>

<p>Cette connexion se crée grâce à des techniques précises : guidage subtil, placement du corps, et surtout écoute mutuelle. Le regard, la respiration et les micro-mouvements jouent un rôle central dans la communication non verbale.</p>

<p>Pour progresser en Zouk, il est conseillé de travailler sa posture, sa souplesse et sa conscience corporelle. Participer à des stages, filmer ses danses, et prendre le temps d’analyser ses sensations sont des outils précieux pour ressentir pleinement la magie du Zouk.</p>
HTML,
                'image' => '/images/blog/5.png',
                'author_id' => 1,
                'slug' => Str::slug('Zouk : l\'art de la connexion entre partenaires'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
