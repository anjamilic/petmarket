<?php


namespace Database\Seeders;
use \App\Models\User;
use \App\Models\Pet;
use \App\Models\Necklace;
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
       
        User::truncate(); 
        Pet::truncate();
        Necklace::truncate();

      
        $necklace1= Necklace::factory()->create();
        $necklace2= Necklace::factory()->create();
        
    }
}
