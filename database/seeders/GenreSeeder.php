<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Genre;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        $data = [
            ["name" => "Action"], 
            ["name" => "Comedy"], 
            ["name" => "Drama"], 
            ["name" => "Fantasy"], 
            ["name" => "Horror"], 
            ["name" => "Mystery"], 
            ["name" => "Romance"], 
            ["name" => "Thriller"], 
            ["name" => "Western"], 
            ["name" => "Kids"], 
        ];

        foreach ($data as $key => $d) {            
            Genre::create([
                'name' => $d["name"],                  
                'active' => true,
            ]);
        }
    }
}
