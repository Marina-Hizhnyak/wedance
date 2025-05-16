<?php

namespace Database\Seeders;

use App\Models\TeamMember;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeamMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $team = [
            [
                'name' => 'Kate Retina',
                'email' => 'kate@wedance.com',
                'password' => bcrypt('password'),
                'role' => 'teacher',
                'team' => [
                    'role' => 'Coach de salsa',
                    'photo' => '/images/teams/kate-main.jpg',
                    'avatar' => '/images/teams/avatar.png',
                    'quote' => "La salsa, c'est bien plus qu'une danse, c'est un langage universel.",
                    'description' => "Professeur de salsa, danseuse professionnelle avec plus de 5 ans d'expérience. Allie technique et bonne humeur.",
                    'telegram_url' => 'https://t.me/username',
                    'whatsapp_url' => 'https://wa.me/32471234567',
                    'vk_url' => 'https://vk.com/kate_salsa',
                ]
            ],
            [
                'name' => 'Eva Marie',
                'email' => 'eva@wedance.com',
                'password' => bcrypt('password'),
                'role' => 'teacher',
                'team' => [
                    'role' => 'Coach de bachata',
                    'photo' => '/images/teams/eva-main.jpg',
                    'avatar' => '/images/teams/avatar.png',
                    'quote' => "Danser, c’est respirer autrement.",
                    'description' => "Spécialiste de la bachata moderne. Enseigne avec passion et patience tous les niveaux.",
                    'telegram_url' => 'https://t.me/username',
                    'whatsapp_url' => 'https://wa.me/32471234567',
                    'vk_url' => 'https://vk.com/kate_salsa',
                ]
            ],
            [
                'name' => 'Leo Martinez',
                'email' => 'leo@wedance.com',
                'password' => bcrypt('password'),
                'role' => 'teacher',
                'team' => [
                    'role' => 'Chorégraphe & animateur',
                    'photo' => '/images/teams/leo-main.jpg',
                    'avatar' => '/images/teams/avatar.png',
                    'quote' => "Chaque pas est une émotion.",
                    'description' => "Ancien compétiteur international, Leo apporte une énergie incroyable à chaque atelier.",
                    'telegram_url' => 'https://t.me/username',
                    'whatsapp_url' => 'https://wa.me/32471234567',
                    'vk_url' => 'https://vk.com/kate_salsa',
                ]
            ],
            [
                'name' => 'Sofia Lopez',
                'email' => 'sofia@wedance.com',
                'password' => bcrypt('password'),
                'role' => 'teacher',
                'team' => [
                    'role' => 'Responsable des événements',
                    'photo' => '/images/teams/sofia-main.jpg',
                    'avatar' => '/images/teams/avatar.png',
                    'quote' => "Un bon événement est une danse bien menée.",
                    'description' => "Organisatrice hors pair, elle s’occupe des soirées et stages avec le sourire.",
                    'telegram_url' => 'https://t.me/username',
                    'whatsapp_url' => 'https://wa.me/32471234567',
                    'vk_url' => 'https://vk.com/kate_salsa',
                ]
            ],
            [
                'name' => 'Nina Da Costa',
                'email' => 'nina@wedance.com',
                'password' => bcrypt('password'),
                'role' => 'teacher',
                'team' => [
                    'role' => 'Coach débutants',
                    'photo' => '/images/teams/nina-main.jpg',
                    'avatar' => '/images/teams/avatar.png',
                    'quote' => "Chaque danse commence par un premier pas.",
                    'description' => "Excellente pédagogue, elle accompagne les nouveaux élèves avec douceur et rigueur.",
                    'telegram_url' => 'https://t.me/username',
                    'whatsapp_url' => 'https://wa.me/32471234567',
                    'vk_url' => 'https://vk.com/kate_salsa',
                ]
            ],
            [
                'name' => 'Julien Morel',
                'email' => 'julien@wedance.com',
                'password' => bcrypt('password'),
                'role' => 'teacher',
                'team' => [
                    'role' => 'Coach styling masculin',
                    'photo' => 'team/julien-main.png',
                    'avatar' => '/images/teams/avatar.png',
                    'quote' => "Le style, c’est l’attitude.",
                    'description' => "Il enseigne l’élégance et la présence scénique dans chaque mouvement.",
                    'telegram_url' => 'https://t.me/username',
                    'whatsapp_url' => 'https://wa.me/32471234567',
                    'vk_url' => 'https://vk.com/kate_salsa',
                ]
            ],
            [
                'name' => 'Maya Benali',
                'email' => 'maya@wedance.com',
                'password' => bcrypt('password'),
                'role' => 'teacher',
                'team' => [
                    'role' => 'Assistante administrative',
                    'photo' => 'team/maya-main.png',
                    'avatar' => '/images/teams/avatar.png',
                    'quote' => "Sans organisation, pas de danse fluide !",
                    'description' => "Répond à toutes vos questions, gère les inscriptions et facilite la vie de l’école.",
                    'telegram_url' => 'https://t.me/username',
                    'whatsapp_url' => 'https://wa.me/32471234567',
                    'vk_url' => 'https://vk.com/kate_salsa',
                ]
            ],
        ];

        foreach ($team as $person) {
            $user = User::create([
                'name' => $person['name'],
                'email' => $person['email'],
                'password' => $person['password'],
                'role' => $person['role'],
            ]);

            TeamMember::create(array_merge($person['team'], ['user_id' => $user->id]));
        }
    }
}
