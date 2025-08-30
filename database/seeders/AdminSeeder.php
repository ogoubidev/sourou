<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        User::updateOrCreate(
            ['email' => 'admin@sourouimmobilier.com'],
            [
                'name' => 'Administrateur',
                'surname' => 'Administrateur',
                'password' => Hash::make('password'),
                'telephone' => '0196462142',
                'role' => 'admin',
            ]
        );
    }
}

