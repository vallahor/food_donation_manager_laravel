<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Family>
 */
class FamilyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $fake = fake('pt_BR');
        return [
            'first_name' => $fake->firstName(),
            'last_name' => $fake->lastName(),
            'street_name' => $fake->streetName(),
            'zipcode' => $fake->numerify('#########'),
            'phone_number' => $fake->numerify('###########'),
            'visited' => $fake->optional(0.4)->dateTimeBetween('-1 year', 'now')?->format('d-m-Y'),
        ];
    }
}
