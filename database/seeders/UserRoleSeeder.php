<?php

namespace Database\Seeders;

use App\Models\Auth\UserRole;
use Illuminate\Database\Seeder;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        UserRole::insert(['user_id'=> '1', 'role_id'=> '2',]);
        UserRole::insert(['user_id'=> '2', 'role_id'=> '3',]);
    }
}
