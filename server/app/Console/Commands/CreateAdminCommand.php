<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class CreateAdminCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create-data:admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new admin account';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->ask('Enter admin name');
        $account = $this->ask('Enter admin account');
        $club = $this->ask('Enter admin club code');
        $role = $this->ask('Enter admin role');
        $password = $this->secret('Enter admin password');
        $confirmPassword = $this->secret('Confirm admin password');

        if (Admin::where('account', $account)->exists()) {
            $this->error('Account already exists');
            return;
        }

        if ($account === '') {
            $this->error('Account cannot be empty');
            return;
        }

        if ($name === '') {
            $this->error('Name cannot be empty');
            return;
        }

        if ($club === '') {
            $this->error('Club code cannot be empty');
            return;
        }

        if ($role === '') {
            $this->error('Role cannot be empty');
            return;
        }

        if (is_numeric($role) === false) {
            $this->error('Role must be a number');
            return;
        }

        if ($password === '') {
            $this->error('Password cannot be empty');
            return;
        }

        if ($password !== $confirmPassword) {
            $this->error('Password not match');
            return;
        }

        Admin::create([
            'name' => $name,
            'account' => $account,
            'club_code' => $club,
            'role' => $role,
            'password' => Hash::make($password),
        ]);
        $this->info('Admin created');
    }
}
