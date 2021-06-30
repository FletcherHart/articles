<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\RolesUser;
use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::firstOrcreate(['role' => 'admin']);
        RolesUser::firstOrCreate(['user_id' => 1, 'role_id' => 1]);
    }
}
