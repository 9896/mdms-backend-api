<?php

namespace Modules\Doctor\Database\Seeders;

use Modules\Doctor\Database\factories\DoctorFactory;
use Modules\Symptom\Database\factories\SymptomFactory;
use Modules\Disease\Database\factories\DiseaseFactory;
use Illuminate\Support\Facades\DB;
use Modules\Doctor\Entities\Doctor;
use Modules\Symptom\Entities\Symptom;
use Modules\Disease\Entities\Disease;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DoctorDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // $symptom = Symptom::factory()
        // ->count(4)
        // ->create();

        // $disease = Disease::factory()
        // ->count(8)
        // ->create();

        // $doctor = Doctor::factory()
        // ->count(4)
        // ->has(Disease::factory()
        //     ->count(3)
        //     ->state(function(array $attributes, Doctor $doctor){
        //         return ['doctor_id' => $doctor->id];
        //     })
        //     ->hasAttached(Symptom::factory()
        //         ->count(4)))
        // ->create();

        // $doctor = Doctor::factory()
        // ->count(4)
        // ->create();
        // $this->call("OthersTableSeeder");

    }
}
