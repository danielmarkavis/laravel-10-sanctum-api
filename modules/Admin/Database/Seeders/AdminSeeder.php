<?php

namespace Modules\Admin\Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name'=> 'admin',
            'email' => 'admin@danielmarkavis.co.uk',
            'email_verified_at' => now(),
            'password' => Hash::make('password')
        ])->assignRole(['AdminRole','UserRole']);

        User::create([
            'name'=> 'user',
            'email' => 'user@danielmarkavis.co.uk',
            'email_verified_at' => now(),
            'password' => Hash::make('password')
        ])->assignRole(['UserRole']);
    }
}
