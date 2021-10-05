<?php
namespace Modules\Doctor\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DoctorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Doctor\Entities\Doctor::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {   $hashedPassword = Hash::make(12345678);
        return [
            //
            'uuid' => Str::uuid(),
            'first_name' => $this->faker->name,
            'last_name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'phone_number' => $this->faker->phoneNumber,
            'password' => $hashedPassword,

        ];
    }
}

