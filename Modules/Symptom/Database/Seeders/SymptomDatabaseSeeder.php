<?php

namespace Modules\Symptom\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Symptom\Database\factories\SymptomFactory;
use Modules\Symptom\Entities\Symptom;

class SymptomDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        //Symptom::factory()->count(8)->create();
        // $this->call("OthersTableSeeder");
    }
}
