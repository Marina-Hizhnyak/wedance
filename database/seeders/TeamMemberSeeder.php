<?php

namespace Database\Seeders;

use App\Models\TeamMember;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeamMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TeamMember::create([
            'name' => 'Kate Retina',
            'role' => 'Coach de salsa',
            'photo' => '/images/teams/kate-main.jpg',
            'avatar' => 'team/kate-avatar.jpg',
            'quote' => "La salsa, c'est bien plus qu'une danse, c'est un langage universel.",
            'description' => "Professeur de salsa, danseuse professionnelle avec plus de 5 ans d'expérience. Allie technique et bonne humeur."
        ]);

        TeamMember::create([
            'name' => 'Eva Marie',
            'role' => 'Coach de bachata',
            'photo' => '/images/teams/eva-main.jpg',
            'avatar' => 'team/eva-avatar.jpg',
            'quote' => "Danser, c’est respirer autrement.",
            'description' => "Spécialiste de la bachata moderne. Enseigne avec passion et patience tous les niveaux."
        ]);

        TeamMember::create([
            'name' => 'Leo Martinez',
            'role' => 'Chorégraphe & animateur',
            'photo' => '/images/teams/leo-main.jpg',
            'avatar' => 'team/leo-avatar.jpg',
            'quote' => "Chaque pas est une émotion.",
            'description' => "Ancien compétiteur international, Leo apporte une énergie incroyable à chaque atelier."
        ]);

        TeamMember::create([
            'name' => 'Sofia Lopez',
            'role' => 'Responsable des événements',
            'photo' => '/images/teams/sofia-main.jpg',
            'avatar' => 'team/sofia-avatar.jpg',
            'quote' => "Un bon événement est une danse bien menée.",
            'description' => "Organisatrice hors pair, elle s’occupe des soirées et stages avec le sourire."
        ]);

        TeamMember::create([
            'name' => 'Nina Da Costa',
            'role' => 'Coach débutants',
            'photo' => '/images/teams/nina-main.jpg',
            'avatar' => 'team/nina-avatar.jpg',
            'quote' => "Chaque danse commence par un premier pas.",
            'description' => "Excellente pédagogue, elle accompagne les nouveaux élèves avec douceur et rigueur."
        ]);

        TeamMember::create([
            'name' => 'Julien Morel',
            'role' => 'Coach styling masculin',
            'photo' => 'team/julien-main.png',
            'avatar' => 'team/julien-avatar.jpg',
            'quote' => "Le style, c’est l’attitude.",
            'description' => "Il enseigne l’élégance et la présence scénique dans chaque mouvement."
        ]);

        TeamMember::create([
            'name' => 'Maya Benali',
            'role' => 'Assistante administrative',
            'photo' => 'team/maya-main.png',
            'avatar' => 'team/maya-avatar.jpg',
            'quote' => "Sans organisation, pas de danse fluide !",
            'description' => "Répond à toutes vos questions, gère les inscriptions et facilite la vie de l’école."
        ]);
    }
}
