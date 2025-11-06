<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Article Communiqué',
            'Article Conseils',
            'Article Immobilier',
            'Article Projet',
            'Soutien / Partenariat',
        ];

        foreach ($categories as $nom) {
            DB::table('categories')->insert([
                'nom' => $nom,
                'slug' => Str::slug($nom),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
