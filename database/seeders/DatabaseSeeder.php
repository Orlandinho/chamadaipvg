<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Classroom;
use App\Models\Student;
use App\Models\User;
use Database\Factories\ClassroomFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

         User::factory()->create([
             'name' => 'Antonio Orlando',
             'email' => 'orlando@example.com',
         ]);

         Classroom::factory()->createMany([
             ['name' => 'Jovens', 'color' => 'orange-500', 'slug' => 'jovens'],
             ['name' => 'Catecúmenos', 'color' => 'blue-500', 'slug' => 'catecumenos'],
             ['name' => 'Infantil', 'color' => 'purple-500', 'slug' => 'infantil'],
             ['name' => 'Adolescentes', 'color' => 'indigo-500', 'slug' => 'adolescentes'],
             ['name' => 'Adultos', 'color' => 'green-500', 'slug' => 'adultos'],
             ['name' => 'Cordeirinhos', 'color' => 'red-500', 'slug' => 'cordeirinhos'],
         ]);

         Student::factory(150)->create();
    }
}
