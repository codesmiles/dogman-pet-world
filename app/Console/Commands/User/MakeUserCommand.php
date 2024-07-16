<?php

namespace App\Console\Commands\User;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class MakeUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:filament-user-custom';

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
        $this->info('Creating a new Filament custom admin user...');
        $name = $this->ask('Input Name');
        $email = $this->ask('Email');
        $address = $this->ask('Address');
        $password = $this->secret('Password');
        

        // User::create([
        //     'name' => $name,
        //     'email' => $email,
        //     'password' => Hash::make($password),
        //     'address' => $address,  // Add this line to include address
        // ]);

        $this->info('User created successfully.');
    }
}
