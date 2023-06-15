<?php

use Illuminate\Database\Seeder;

class RolUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Rol users seeder
        $roles = [
            [
                'name' => 'Administrator',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'People',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Company',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('rol_users')->insert($roles);
    }
}
