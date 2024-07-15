<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Filament\Facades\Filament;
use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\UserProvider;
use Symfony\Component\Console\Attribute\AsCommand;

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
        $name = $this->ask('Name');
        $email = $this->ask('Email');
        $address = $this->ask('Address');  // Add this line to ask for address
        $password = $this->secret('Password');

        User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'address' => $address,  // Add this line to include address
        ]);

        $this->info('User created successfully.');
    }
}
