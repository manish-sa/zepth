<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\UserModel;

class UserSeeder extends Seeder
{
    public function run()
    {
        $user = new UserModel;
        $faker = \Faker\Factory::create();
        
        //add one user 
        $user->save(
            [
                'username' => 'admin',
                'name' => 'Admin',
                'password' => password_hash('admin', PASSWORD_DEFAULT),
            ]
        );

        // create fake user details
        for ($i=0; $i < 10 ; $i++) { 
            $user->save(
                [
                    'username' => $faker->username,
                    'name' => $faker->name,
                    'password' => password_hash($faker->password, PASSWORD_DEFAULT),
                ]
            );
        }
    }
}
