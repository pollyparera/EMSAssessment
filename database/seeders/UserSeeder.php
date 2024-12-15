<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role_id=Role::where('role','Reviewer')->value('id');

        $user=['name'=>'Reviewer 1','email'=>'reviewer1@gmail.com','password'=>Hash::make('Reviewer@2024'),'role_id'=>$role_id];

        User::create($user);
    }
}
