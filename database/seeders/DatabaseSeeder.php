<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        User::factory()->create([
            'name' => "Admin_Prueba",
            'email' => "Admin_Prueba@unet.edu.ve",
            'email_verified_at' => now(),
            'password' => Hash::make('password_unet'),
            'es_escritor' => true
        ]);

        $this->call([Factory_Seeder::class]);
    }
}
