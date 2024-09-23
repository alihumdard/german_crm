<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Carbon\Carbon;

class Users extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
                // Create an Super Admin
                User::factory()->create([
                    'name'       => 'Web Admin',
                    'email'      => 'superadmin@gmail.com',
                    'password'   => Hash::make('admin@123'),
                    'role'       => 'Super_Admin',
                    'gender'       => 'male',
                    'status'     => '1',
                    'created_by' => '1',
                ]);
        
                // Create a MGW_Agent
                User::factory()->create([
                    'name'         => 'MGW Agent',
                    'email'        => 'mgwagent@gmail.com',
                    'phone'        => '+923394030',
                    'gender'       => 'male',
                    'address'      => 'gernal texi stand.',
                    'password'     => Hash::make('admin@123'),
                    'role'         => 'MGW_Agent',
                    'status'       => '1',
                    'created_by'   => '2'
                ]);
        
                // Create a Employer 
                User::factory()->create([
                    'name'         => 'Employer',
                    'email'        => 'employer@gmail.com',
                    'phone'        => '+923394030',
                    'gender'       => 'male',
                    'address'      => 'gernal texi stand.',
                    'password'     => Hash::make('admin@123'),
                    'role'         => 'Employer',
                    'status'       => '1',
                    'created_by'   => '3'
                ]);
        
                // Create a Employee
                User::factory()->create([
                    'name'      => 'Employee',
                    'email'     => 'employee@gmail.com',
                    'dob'       => '02/16/2024',
                    'phone'     => '+923394030',
                    'gender'    => 'male',
                    'address'   => 'gernal texi stand.',
                    'password'  => Hash::make('admin@123'),
                    'role'      => 'Employee',
                    'status'    => '1',
                    'created_by' => '1'
                ]);
    }
}
