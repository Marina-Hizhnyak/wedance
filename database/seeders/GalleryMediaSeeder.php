<?php

namespace Database\Seeders;

use App\Models\GalleryMedia;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GalleryMediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 12; $i++) {
            GalleryMedia::create([
                'title' => "Photo $i",
                'image' => "/images/gallery/$i.jpg",
                'event_id' => null,
            ]);
        }
    }
}
