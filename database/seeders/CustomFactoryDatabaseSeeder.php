<?php

namespace Database\Seeders;

use App\Models\Pet;
use App\Models\User;
use App\Models\Employee;
use App\Models\PetActivitySchedule;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CustomFactoryDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | create admin user
        |--------------------------------------------------------------------------
        */
        // client
        $admin_user = User::factory([
            'name' => 'admin',
            'email' => 'admin@example.com',
            "address" => "lagos Nigeria",
            "password" => "12345678",
            "client_id" => "DPW/client/admin",
            "phone_number" => "08123456789",
        ])->create();

        // admin employee
        Employee::factory([
            'status' => 'active',
            'is_admin' => true,
            'user_id' => $admin_user->id,
            'employee_id' => 'DPW/employee/admin',
        ])->create();


        /*
        |--------------------------------------------------------------------------
        | create Employee user
        |--------------------------------------------------------------------------
        */
        // client
        $employee_user = User::factory([
            'name' => 'employee',
            'email' => 'employee@example.com',
            "password" => "12345678",
            "client_id" => "DPW/client/emloyee",
        ])->create();

        // employee
        $employee = Employee::factory([
            'status' => 'active',
            'is_admin' => false,
            'user_id' => $employee_user->id,
            'employee_id' => 'DPW/employee/employee',
        ])->create();

        /*
        |--------------------------------------------------------------------------
        | create client user
        |--------------------------------------------------------------------------
        */
        // client
        $client_user = User::factory([
            'name' => 'client',
            'email' => 'client@example.com',
            "password" => "12345678",
            "client_id" => "DPW/client/client",
        ])->create();

        /*
        |--------------------------------------------------------------------------
        | create pet
        |--------------------------------------------------------------------------
        */
        $pet_created = Pet::factory([
            "user_id" => $client_user->id
        ])->create();

        /*
        |--------------------------------------------------------------------------
        | create pet activity schedule
        |--------------------------------------------------------------------------
        */
        PetActivitySchedule::factory([
            "pet_id" => $pet_created->id,
            "employee_id" => $employee->id,
        ])->create();

    }
}
