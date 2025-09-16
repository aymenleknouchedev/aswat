<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // 1. إنشاء الدور admin إذا لم يكن موجود
        $adminRole = Role::firstOrCreate(
            ['name' => 'admin'],
        );

        // 2. قائمة الصلاحيات
        $permissions = [
            'dashboard_access',
            'content_access',
            'media_access',
            'content_management_access',
            'sections_access',
            'categories_access',
            'trends_access',
            'windows_access',
            'tags_access',
            'locations_access',
            'users_access',
            'roles_access',
            'writers_access',
            'pages_access',
            'settings_access',
        ];

        // 3. إنشاء كل صلاحية إذا لم تكن موجودة
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(
                ['name' => $permission],
            );
        }

        // 4. ربط الدور admin بكل الصلاحيات
        $allPermissions = Permission::all();
        $adminRole->permissions()->sync($allPermissions->pluck('id'));

        // 5. إنشاء المستخدم super admin إذا لم يكن موجود
        $superAdmin = User::firstOrCreate(
            ['email' => 'admin@asswat.com'],
            [
                'name'     => 'super',
                'surname'  => 'admin',
                'password' => Hash::make('123456789'),
                'image'    => 'user.png',
            ]
        );

        // 6. ربط المستخدم بالدور admin
        $superAdmin->roles()->syncWithoutDetaching([$adminRole->id]);
    }
}
