<?php


use App\Model\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tag::insert([
            ['name' => "Hondelatte", 'slug' => "Hondelatte", 'parent_tag_name' => "presentation"],
            ['name' => "Lantieri", 'slug' => "Lantieri", 'parent_tag_name' => "presentation"],
            ['name' => "Ville", 'slug' => "Ville", 'parent_tag_name' => "decor"],
            ['name' => "Campagne", 'slug' => "Campagne", 'parent_tag_name' => "decor"],
            ['name' => "Une seule scène de crime", 'slug' => "Une seule scène de crime", 'parent_tag_name' => "style"],
            ['name' => "Plusieurs scènes de crime", 'slug' => "Plusieurs scènes de crime", 'parent_tag_name' => "style"],
            ['name' => "Pas de scène de crime", 'slug' => "Pas de scène de crime", 'parent_tag_name' => "style"],
            ['name' => "Années 60", 'slug' => "Années 60", 'parent_tag_name' => "ambiance"],
            ['name' => "Années 70", 'slug' => "Années 70", 'parent_tag_name' => "ambiance"],
            ['name' => "Années 80", 'slug' => "Années 80", 'parent_tag_name' => "ambiance"],
            ['name' => "Années 90", 'slug' => "Années 90", 'parent_tag_name' => "ambiance"],
            ['name' => "Années 2000", 'slug' => "Années 2000", 'parent_tag_name' => "ambiance"],
            ['name' => "Années 2010", 'slug' => "Années 2010", 'parent_tag_name' => "ambiance"],
            ['name' => "Pipe de bronze", 'slug' => "Pipe de bronze", 'parent_tag_name' => "note"],
            ['name' => "Pipe d'argent", 'slug' => "Pipe d'argent", 'parent_tag_name' => "note"],
            ['name' => "Pipe d'or", 'slug' => "Pipe d'or", 'parent_tag_name' => "note"],
            ['name' => "Pipe de diamant", 'slug' => "Pipe de diamant", 'parent_tag_name' => "note"],
            ['name' => "Longue enquête", 'slug' => "Longue enquête", 'parent_tag_name' => "divers"],
            ['name' => "Affaire mystérieuse", 'slug' => "Affaire mystérieuse", 'parent_tag_name' => "divers"],
            ['name' => "Principal suspect témoigne", 'slug' => "Principal suspect témoigne", 'parent_tag_name' => "divers"],
            ['name' => "Affaire adaptée au cinéma", 'slug' => "Affaire adaptée au cinéma", 'parent_tag_name' => "divers"],
            ['name' => "Grand banditisme", 'slug' => "Grand banditisme", 'parent_tag_name' => "divers"],
        ]);
    }
}
