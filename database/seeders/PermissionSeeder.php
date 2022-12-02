<?php

namespace Database\Seeders;

use App\Models\PermissionCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = PermissionCategory::create(['title' => 'Setting']);
        $permission = Permission::create(['name' => 'Update App Setting', 'permission_category_id' => $category->id]);
        
        $category = PermissionCategory::create(['title' => 'Roles']);
        $permission = Permission::create(['name' => 'View Roles', 'permission_category_id' => $category->id]);
        $permission = Permission::create(['name' => 'Create Role', 'permission_category_id' => $category->id]);
        $permission = Permission::create(['name' => 'Edit Role', 'permission_category_id' => $category->id]);
        $permission = Permission::create(['name' => 'Delete Role', 'permission_category_id' => $category->id]);
        $permission = Permission::create(['name' => 'Set Role Permissions', 'permission_category_id' => $category->id]);
        
        $category = PermissionCategory::create(['title' => 'Users']);
        $permission = Permission::create(['name' => 'View Users', 'permission_category_id' => $category->id]);
        $permission = Permission::create(['name' => 'Create Users', 'permission_category_id' => $category->id]);
        $permission = Permission::create(['name' => 'Edit Users', 'permission_category_id' => $category->id]);
        $permission = Permission::create(['name' => 'Delete Users', 'permission_category_id' => $category->id]);
    }
}
