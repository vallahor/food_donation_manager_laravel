<?php

namespace Database\Factories;

use App\Enums\Measurement;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
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
            'name' => $fake->name(),
            'description' => $fake->paragraph(),
            'quantity' => $fake->randomDigitNotNull(),
            'measurement' => $fake->randomElement(Measurement::cases())->value,
        ];
    }
}
