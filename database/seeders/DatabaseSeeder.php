<?php

namespace Database\Seeders;

use App\Models\Pet;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Employee;
use App\Models\PetActivitySchedule;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);


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
