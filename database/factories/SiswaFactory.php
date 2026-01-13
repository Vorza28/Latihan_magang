<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Siswa>
 */
class SiswaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama' => $this->faker->name(),
            'nis' => $this->faker->unique()->numerify('2023###'),
            'kelas' => $this->faker->randomElement(['X-A', 'X-B', 'X-C']),
            'nilai' => $this->faker->numberBetween(60, 100),
        ];
    }
}
