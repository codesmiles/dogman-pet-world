<?php

namespace App\Console\Commands\User;

use App\Models\User;
use App\Models\Employee;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class MakeUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:admin-user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Filament custom admin user user custom';

    /**
     *
     * custom
     */
    public function handle()
    {
        /*
        |--------------------------------------------------------------------------
        | create Admin User info
        |--------------------------------------------------------------------------
        */
        $this->info('Creating a new Filament custom admin user...');

        /*
        |--------------------------------------------------------------------------
        | calling terminal request
        |--------------------------------------------------------------------------
        */
        $data = $this->getUserData();

        /*
        |--------------------------------------------------------------------------
        | validating parameters
        |--------------------------------------------------------------------------
        */
        $validator = Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'address' => ['nullable', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
            "phone_number" => ['required', 'string', 'max:14',"min:11",]
        ]);

        if ($validator->fails()) {
            $this->error('Admin User creation failed due to validation errors:');
            foreach ($validator->errors()->all() as $error) {
                $this->error($error);
            }
            return;
        }

        /*
        |--------------------------------------------------------------------------
        | seting varables
        |--------------------------------------------------------------------------
        */
        $create_user_payload = [
            'name' => $data['name'],
            'email' => $data['email'],
            'address' => $data['address'],
            'password' => Hash::make($data['password']),
            "client_id" => "DPW/client/admin",
            'phone_number' => $data['phone_number'],
        ];

        /*
        |--------------------------------------------------------------------------
        | creating user
        |--------------------------------------------------------------------------
        */
        $user_created = User::create($create_user_payload);

        if(! $user_created) {
            $this->error('Admin User creation failed due to database error.');
            return;
        }


        /*
        |--------------------------------------------------------------------------
        | set employee payload
        |--------------------------------------------------------------------------
        */
        $employee_payload = [
            "user_id" =>$user_created->id,
            "is_admin" => true,
            "employee_id" => "DPW/employee/admin",
            "employment_date" => now()->toDateTimeString(),
        ];

        /*
        |--------------------------------------------------------------------------
        | set employee payload
        |--------------------------------------------------------------------------
        */
        $employee_created = Employee::create($employee_payload);

        if(!$employee_created){
            $this->error('Admin User creation failed due to database error.');
            return;
        }
        $this->info('Admin user created successfully!');
    }

    protected function getUserData()
    {
        return [
            'name' => $this->ask('Input Your full Name*:'),
            'email' => $this->ask('Input your Email*:'),
            "address" => $this->ask('Input Your Address:'),
            'password' => $this->secret('Input User Password*:'),
            "phone_number" => $this->ask('Input your phone number*:')
        ];
    }
}
