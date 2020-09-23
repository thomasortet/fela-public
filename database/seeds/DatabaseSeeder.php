<?php

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
        //$this->call(UserSeeder::class);
        $this->call(PresentateurSeeder::class);
        $this->call(TagSeeder::class);
        $this->call(NoteSeeder::class);
        $this->call(EpisodeSeeder::class);
        $this->call(EpisodeTagSeeder::class);
        $this->call(EpisodePresentateurSeeder::class);
    }
}
