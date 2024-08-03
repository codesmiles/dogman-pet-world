<?php

namespace App\Console\Commands\Seeder;

use App\Enums\IntMock;
use Illuminate\Console\Command;
use App\Models\Pet;
use App\Models\User;
use App\Enums\Mocks;
use App\Models\Employee;
use app\Models\PetActivitySchedule;
use Illuminate\Support\Facades\Hash;


class MakeSeederCommand extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:make-seeder-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command for seeding into the database with the necessary parameters to run the project';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        /*
        |--------------------------------------------------------------------------
        | set admin payload
        |--------------------------------------------------------------------------
        */
        $create_user_payload = [
            'name' => Mocks::ADMIN_NAME->value,
            'email' => Mocks::ADMIN_EMAIL->value,
            'address' => Mocks::ADMIN_ADDRESS->value,
            'password' => Hash::make(Mocks::DEFAULT_PASSWORD->value),
            "client_id" => Mocks::ADMIN_CLIENT_ID->value,
            'phone_number' => MOCKS::ADMIN_PHONE_NUMBER->value,
        ];

        /*
        |--------------------------------------------------------------------------
        | create admin
        |--------------------------------------------------------------------------
        */
        $user_admin_created = User::create($create_user_payload);

        if (!$user_admin_created) {
            $this->error('Admin User creation failed due to database error.');
            return;
        }

        $this->info('User created');

        /*
        |--------------------------------------------------------------------------
        | set employee payload
        |--------------------------------------------------------------------------
        */
        $employee_payload = [
            "user_id" => $user_admin_created->id,
            "is_admin" => true,
            "employee_id" => Mocks::ADMIN_EMPLOYEE_ID->value,
            "employment_date" => now()->toDateTimeString(),
        ];

        /*
        |--------------------------------------------------------------------------
        | create employee
        |--------------------------------------------------------------------------
        */
        $employee_created = Employee::create($employee_payload);

        if (!$employee_created) {
            $this->error('Admin User creation failed due to database error.');
            return;
        }

        $this->info('Admin user created successfully!');

        /*
        |--------------------------------------------------------------------------
        | set client payload
        |--------------------------------------------------------------------------
        */
        $create_client_payload = [
            'name' => Mocks::CLIENT_NAME->value,
            'email' => Mocks::CLIENT_EMAIL->value,
            'address' => Mocks::CLIENT_ADDRESS->value,
            'password' => Hash::make(Mocks::DEFAULT_PASSWORD->value),
            "client_id" => Mocks::CLIENT_ID->value,
            'phone_number' => MOCKS::CLIENT_PHONE_NUMBER->value,
        ];

        /*
        |--------------------------------------------------------------------------
        | create client
        |--------------------------------------------------------------------------
        */
        $user_created = User::create($create_client_payload);

        if (!$user_created) {
            $this->error('Admin User creation failed due to database error.');
            return;
        }

        $this->info('User created');

        /*
        |--------------------------------------------------------------------------
        | set pet payload
        |--------------------------------------------------------------------------
        */
        $create_pet_payload = [
            "name" => Mocks::PET_NAME->value,
            "breed" => Mocks::PET_BREED->value,
            "photo" => Mocks::PET_PHOTO->value,
            "genus" => Mocks::PET_GENUS->value,
            "weight" => IntMock::PET_WEIGHT->value,
            "gender" => Mocks::PET_GENDER->value,
            "status" => Mocks::PET_STATUS->value,
            "user_id" => $user_created->id,
            "file_number" => Mocks::PET_FILE_NUMBER->value,
            "date_of_birth" => now()->toDateTimeString(),
            "microchip_number" => Mocks::PET_MICROCHIP_NUMBER->value,
            "date_of_adoption" => now()->toDateTimeString(),
            "retainership_plan" => Mocks::PET_RETAINERSHIP_PLAN->value,
            "custom_plan_details" => Mocks::CUSTOM_PLAN_DETAILS->value,
        ];

        /*
        |--------------------------------------------------------------------------
        | create pet
        |--------------------------------------------------------------------------
        */
        $pet_created = Pet::create($create_pet_payload);

        if (!$pet_created) {
            $this->error("Admin User creation failed due to database error. {$pet_created->toString()}");
            return;
        }

        $this->info('Pet created');

        // /*
        // |--------------------------------------------------------------------------
        // | set pet activity schedule payload
        // |--------------------------------------------------------------------------
        // */
        // $create_PetActivitySchedule_payload = [
        //     "report" => Mocks::PET_ACTIVITY_REPORT->value,
        //     "pet_id" => $pet_created->id,
        //     "employee_id" => $employee_created->id,
        //     "next_visit_date" => now()->toDateTimeString(),
        //     "treatment_or_vaccinations" => Mocks::PET_ACTVITY_TREATMENT_OR_VACCINATIONS->value,
        // ];

        // /*
        // |--------------------------------------------------------------------------
        // | create pet activity schedule
        // |--------------------------------------------------------------------------
        // */
        // $pet_activity_schedule_created = PetActivitySchedule::create($create_PetActivitySchedule_payload);

        // if (!$pet_activity_schedule_created) {
        //     $this->error("Admin User creation failed due to database error. {$pet_activity_schedule_created->toString()}");
        //     return;
        // }

        // $this->info('Pet activity schedule created');


    }
}
