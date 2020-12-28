<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        DB::table('role_user')->truncate();

        $adminRole = Role::where('name','admin')->first();
        $organizerRole = Role::where('name','organizer')->first();
        $userRole = Role::where('name','user')->first();

        $admin = User::create([
            'matric_no' => 'B031920001',
            'name' => 'Admin User',
            'email' => 'admin@uems.admin.com.my',
            'password' => Hash::make('password')
        ]);

        $organizer = User::create([
            'matric_no' => 'B031920002',
            'name' => 'Organizer User',
            'email' => 'organizer@uems.organizer.com.my',
            'password' => Hash::make('password')
        ]);

        $user = User::create([
            'matric_no' => 'B031920003',
            'name' => 'Wan Ismat',
            'email' => 'ismat@uems.com.my',
            'password' => Hash::make('password')
        ]);

        $admin->roles()->attach($adminRole);
        $organizer->roles()->attach($organizerRole);
        $user->roles()->attach($userRole);

    }
}
