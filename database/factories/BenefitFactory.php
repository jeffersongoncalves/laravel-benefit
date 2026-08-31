<?php

namespace JeffersonGoncalves\Benefit\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use JeffersonGoncalves\Benefit\Models\Benefit;

/** @extends Factory<Benefit> */
class BenefitFactory extends Factory
{
    protected $model = Benefit::class;

    /** @return array<string, mixed> */
    public function definition(): array
    {
        $name = fake()->unique()->words(3, true);

        return [
            'name' => ['en' => $name, 'pt_BR' => $name],
            'description' => ['en' => fake()->sentence(), 'pt_BR' => fake()->sentence()],
            'slug' => Str::slug($name).'-'.fake()->unique()->numberBetween(1, 1000000),
        ];
    }
}
