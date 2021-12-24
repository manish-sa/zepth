<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\CompanyModel;

class CompanySeeder extends Seeder
{
    public function run()
    {
        $company = new CompanyModel;
        $faker = \Faker\Factory::create();
        // create fake user details
        for ($i=0; $i < 10 ; $i++) { 
            $company->save(
                [
                    'company_name' => $faker->company,
                ]
            );
        }
    }
}
