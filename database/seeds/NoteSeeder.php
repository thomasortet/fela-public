<?php

use App\Model\Note;
use Illuminate\Database\Seeder;

class NoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Note::insert ([
            ['name' => "Bronze"],
            ['name' => "Argent"],
            ['name' => "Or"],
            ['name' => "Diamant"],
        ]);
    }
}
