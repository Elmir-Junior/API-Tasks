<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdmin = [
            'name' => 'Elmir Junior',
            'email' => 'elmir.jr75@gmail.com',
            'password' => '12345678',
            'cpf' => '98538081020',
            'birth_date' => '07/12/1999',
            'phone' => '63991056884',
            'sex' => 'Masculino',
            'role_id' => 1
        ];

        User::create($superAdmin)->assignRole('super_admin');
    }
}
