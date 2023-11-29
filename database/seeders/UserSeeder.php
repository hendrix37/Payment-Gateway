<?php

namespace Database\Seeders;

use App\Models\Syarat;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $users = [
            [
                'name' => 'admin',
                'email' => 'admin@gmail.com',
            ],
        ];

        for ($i = 0; $i < 10; $i++) {
            $users[] =
                [
                    'name' => 'rental' . $i,
                    'email' => 'rental' . $i . '@gmail.com',
                ];
        }

        foreach ($users as $userData) {
           \App\Models\User::factory()->create($userData);


            echo "Create user : " . ucfirst($userData['name']) . "...\n";
        }
    }
}
