<?php
namespace Modules\Disease\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class DiseaseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Disease\Entities\Disease::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            // Note doctor_id is missing
            'uuid' => Str::uuid(),
            'name' => $this->faker->unique()->randomElement([
                'Hepatitis B',
                'Malaria',
                'Tuberculosis',
                'Hepatitis C',
                'Common Cold',
                'Giardiasis',
                'HIV/AIDS',
                'Influenza(flu)',
            ]),
            'doctor_id' => $this->faker->numberBetween($min = 1, $max = 6),
            'content' => implode(" ",$this->faker->paragraphs($nb=5, $asText = false)),
            'prevelance_rate' => $this->faker->randomDigit,
            'age_start' => $this->faker->numberBetween($min = 1, $max = 6),
            'age_end' => $this->faker->numberBetween($min = 8, $max = 48),

        ];
    }
}

