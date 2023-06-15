<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Create Admin User
        $user = [
            'name' => 'Admin',
            'email' => 'admin@ngoemployment.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password123'),
            'rol_user_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ];

        DB::table('users')->insert($user);
    }
}
