<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(1)->create([
        	'name' => "Uchiha Senjuu",
        	'email' => "user@resthotel.co.id",
        	'password' => \Hash::make('user123'),
        	'role' => 'user',
        	'phone' => '0895324774832',
        ]);
    }
}
