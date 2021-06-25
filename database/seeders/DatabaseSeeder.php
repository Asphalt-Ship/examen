<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // profil 'admin' par défaut
        $admin = User::create([
            "name" => "admin",
            "email" => "admin@admin.com",
            "password" => Hash::make("admin@admin.com"),
            "role" => "admin"
        ]);

        // livre exemple
        $book = Book::create([
            "title" => "L'Odyssée",
            "author" => "Homère",
            "rating" => "17",
            "review" => "Un grand classique."
        ]);
    }
}
