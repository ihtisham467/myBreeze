<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superAdmin = Role::create([
            'name' => 'SuperAdmin',
            'guard_name' => 'web',
        ]);

        $user = User::create([
            'name' => 'Super Admin',
            'email' => 'ihtisham467@gmail.com',
            'password' => '$2a$12$KN/2tagBOwK5mpgf4E8g8.5U6Pvlkx/ve.529ucSaV2lhk4IgFDdW',
        ]);

        $user->assignRole($superAdmin);
    }
}
