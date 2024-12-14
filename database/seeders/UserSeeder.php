<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user=['name'=>'Reviewer 1','email'=>'reviewer1@gmail.com','password'=>Hash::make('Reviewer@2024'),'role_id'=>1];

        User::create($user);
    }
}
