<?php

namespace Database\Seeders;

use App\Models\Technology;
use App\Models\Projectt;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $_technologies = ["HTML", "CSS", "SQL", "JavaScript", "PHP", "GIT", "Blade"];

        foreach ($_technologies as $_technology) {
            $technology = new Technology();
            $technology->name = $_technology;
            $technology->color = $faker->hexColor();
            $technology->save();
        }
    }
}
