<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateAdmin extends Command
{
    protected $signature = 'bpad:admin
        {--username= : Username admin}
        {--email= : Email admin}
        {--name= : Nama lengkap admin}
        {--password= : Password admin}';

    protected $description = 'Membuat atau memperbarui akun administrator BPAD';

    public function handle(): int
    {
        $username = strtolower(trim((string) ($this->option('username')
            ?: env('BPAD_ADMIN_USERNAME')
            ?: $this->ask('Username', 'admin'))));
        $email = strtolower(trim((string) ($this->option('email')
            ?: env('BPAD_ADMIN_EMAIL')
            ?: $this->ask('Email', 'admin@bpadntt.local'))));
        $name = trim((string) ($this->option('name')
            ?: env('BPAD_ADMIN_NAME')
            ?: $this->ask('Nama lengkap', 'Administrator BPAD')));
        $password = (string) ($this->option('password') ?: $this->secret('Password minimal 12 karakter'));

        if (strlen($password) < 12) {
            $this->error('Password harus memiliki minimal 12 karakter.');

            return self::FAILURE;
        }

        $user = User::updateOrCreate(
            ['username' => $username],
            [
                'name' => $name,
                'email' => $email,
                'password' => Hash::make($password),
                'role' => 'admin',
                'is_active' => true,
            ],
        );

        $this->info("Admin {$user->username} siap digunakan.");

        return self::SUCCESS;
    }
}
