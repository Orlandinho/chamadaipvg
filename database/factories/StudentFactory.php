<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $gender = fake()->randomElement(['male','female']);
        $name = fake()->firstName($gender) . ' ' . fake()->lastName();
        return [
            'name' => $name,
            'gender' => $gender === 'male' ? 'm' : 'f',
            'slug' => Str::slug($name, '-'),
            'email' => Str::slug($name, '.') . '@example.com',
            'dob' => fake()->dateTimeBetween('-75 years', '-1 year'),
            'contact' => '(11) 9' . rand(1000, 9999) . '-' . rand(1000, 9999),
            'address' => fake()->streetAddress(),
            'district' => array_rand(array_flip(['Jd ', 'Vila ', 'Pq ', 'São ']), 1) . fake()->country(),
            'city' => fake()->city(),
            'zipcode' => '0' . rand(1001, 9990) . rand(01, 99) . '0'
        ];
    }
}
