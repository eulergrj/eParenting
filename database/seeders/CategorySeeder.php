<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        $data = [
            ["name" => "Movie"], 
            ["name" => "Series"], 
            ["name" => "Kids"], 
            ["name" => "Music"], 
            ["name" => "Short"], 
            ["name" => "Animation"], 
        ];

        foreach ($data as $key => $d) {            
            Category::create([
                'name' => $d["name"],                  
                'active' => true,
            ]);
        }
    }
}
