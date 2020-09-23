<?php

use App\Model\Presentateur;
use Illuminate\Database\Seeder;

class PresentateurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Presentateur::insert ([
            ['name' => "Christophe Hondelatte"],
            ['name' => "Frédérique Lantieri"],
            ['name' => "Rachid M'Barki"],
            ]);
    }
}
