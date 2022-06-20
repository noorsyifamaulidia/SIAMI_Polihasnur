<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserUPMSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $attr = [
            'name' => 'Kepala Unit Penjamin Mutu',
            'username' => 'upm',
            'password' => bcrypt('upm123'),
            'is_active' => true,
        ];

        $user = User::create($attr);

        $user->assignRole('kepala upm');
    }
}
