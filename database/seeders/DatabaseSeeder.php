<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Book::create([
            'title' => 'sdsdsd',
            'slug' => 'asassaas',
            'description' => 'sddssddssd',
            'author_id' => 1,
            'publisher_id' => 1,
            'publication_year' => '2025',
            'jumlah' => 5,
            'rak_id' => 1,
            'cover' => '1.png'
        ]);

        Book::create([
            'title' => 'sdsdsd',
            'slug' => 'asassaas',
            'description' => 'sddssddssd',
            'author_id' => 1,
            'publisher_id' => 1,
            'publication_year' => '2025',
            'jumlah' => 5,
            'rak_id' => 1,
            'cover' => '1.png'
        ]);
        Book::create([
            'title' => 'sdsdsd',
            'slug' => 'asassaas',
            'description' => 'sddssddssd',
            'author_id' => 1,
            'publisher_id' => 1,
            'publication_year' => '2025',
            'jumlah' => 5,
            'rak_id' => 1,
            'cover' => '1.png'
        ]);
    }
}
