<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Support\Facades\Hash;
use App\Models\PrincipalTrend;
use App\Models\Trend;
use App\Models\Section;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Create only one trend named "startpoint"
        Trend::firstOrCreate([
            'title' => 'startpoint',
            'slug' => 'startpoint',
        ], [
            'image' => 'default-trend.png',
        ]);

        // Set it as principal trend
        PrincipalTrend::firstOrCreate(
            [
                'trend_id' => 1
            ]
        );

        // 1. Create admin role if it doesn't exist
        $adminRole = Role::firstOrCreate(
            ['name' => 'admin'],
        );

        // 2. Permissions list
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
            'view_actions_access',
            'coming_soon_access',
            'email_access',
        ];

        // 3. Create each permission if it doesn't exist
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(
                ['name' => $permission],
            );
        }

        // 4. Link admin role to all permissions
        $allPermissions = Permission::all();
        $adminRole->permissions()->sync($allPermissions->pluck('id'));

        // 5. Create the user with hexadecimal password
        $superAdmin = User::firstOrCreate(
            ['email' => 'naji@admin.com'],
            [
                'name'     => 'naji',
                'surname'  => 'admin',
                'password' => Hash::make('a1b2c3d4e5'), // 10-character hexadecimal
                'image'    => 'user.png',
            ]
        );

        // 6. Link user to admin role
        $superAdmin->roles()->syncWithoutDetaching([$adminRole->id]);

        // 7. الأقسام    
        $sections = [
            'الجزائر',
            'عالم',
            'اقتصاد',
            'رياضة',
            'ناس',
            'ثقافة وفنون',
            'تكنولوجيا',
            'صحة',
            'بيئة',
            'ميديا',
            'منوعات',
            'آراء',
            'نوافذ',
            'ملفات',
            'فحص',
            'فيديو',
            'بودكاست',
            'صور',
        ];

        // 8. إنشاء كل قسم إذا لم يكن موجود
        foreach ($sections as $section) {
            Section::firstOrCreate(
                ['name' => $section],
            );
        }
    }
}
