<?php
namespace Modules\Symptom\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SymptomFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Symptom\Entities\Symptom::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'uuid' => Str::uuid(),
            'name' => $this->faker->unique()->randomElement(['Headache', 'Diarrhea', 'Muscle aches', 'Coughing', 'Skin rashes', 'Swollen neck', 'Blood in Stool', 'Running nose'])
        ];
    }
}

