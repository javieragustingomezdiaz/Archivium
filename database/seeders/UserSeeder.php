<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;
use App\Models\User;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::where('name','administrador')->first();
        $biblioRole = Role::where('name', 'bibliotecario')->first();
        $socioRole = Role::where('name', 'socio')->first();

        User::firstOrCreate(['email' => 'admin@gmail.com'], [
            'name' => 'admin',
            'surname' => 'user',
            'DNI' => '12345678',
            'phone' => '11223344',
            'address' => 'Avenidad Principal 1',
            'city' => 'Apostoles',
            'zip_code' => '3350',
            'password' => Hash::make('admin'),
            'role_id' => $adminRole->id,
            'date_of_birth' => '1999-03-17',
        ]);

        User::firstOrCreate(['email' => 'biblio@gmail.com'], [
            'name' => 'biblio',
            'surname' => 'user',
            'DNI' => '12345679',
            'phone' => '55667788',
            'address' => 'Calle secundaria 2',
            'city' => 'Apostoles',
            'zip_code' => '3350',
            'password' => Hash::make('biblio'),
            'role_id' => $biblioRole->id,
            'date_of_birth' => '1997-02-17',
        ]);

        User::firstOrCreate(['email' => 'socio@gmail.com'], [
            'name' => 'socio',
            'surname' => 'user',
            'DNI' => '12345680',
            'phone' => '99101011',
            'address' => 'Calle secundaria 3',
            'city' => 'Apostoles',
            'zip_code' => '3350',
            'password' => Hash::make('socio'),
            'role_id' => $socioRole->id,
            'date_of_birth' => '1995-02-16',
        ]);
    }
}
