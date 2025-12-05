<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;

use Illuminate\Support\Facades\Hash;

use App\Models\Location;
use App\Models\Category;

class UserSeeder extends Seeder
{
    public function run()
    {
        // 1. Create permissions
        $permissions = [
            'view_dashboard',
            'manage_users',
            'manage_roles',
            'manage_permissions',
            'manage_content',
            'manage_categories',
            'manage_sections',
            'manage_locations',
            'manage_tags',
            'manage_comments',
            'manage_media',
            'manage_settings',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // 2. Create admin role and attach all permissions
        $adminRole = Role::firstOrCreate(
            ['name' => 'admin'],
        );

        $allPermissions = Permission::all();
        $adminRole->permissions()->sync($allPermissions->pluck('id'));

        // 3. Create one super admin user
        $superAdmin = User::firstOrCreate(
            ['email' => 'admin@asswat.com'],
            [
                'name'     => 'super',
                'surname'  => 'admin',
                'username' => 'superadmin',
                'email'    => 'admin@asswat.com',
                'password' => Hash::make('123456789'),
                'image'    => 'user.png',
            ]
        );

        // Attach admin role to user
        $superAdmin->roles()->sync([$adminRole->id]);

        // 4. Create continents
        $continents = [
            ['name' => 'أفريقيا', 'slug' => 'africa'],
            ['name' => 'آسيا', 'slug' => 'asia'],
            ['name' => 'أوروبا', 'slug' => 'europe'],
            ['name' => 'أمريكا الشمالية', 'slug' => 'north-america'],
            ['name' => 'أمريكا الجنوبية', 'slug' => 'south-america'],
            ['name' => 'أستراليا', 'slug' => 'australia'],
            ['name' => 'القارة القطبية الجنوبية', 'slug' => 'antarctica'],
        ];

        foreach ($continents as $continent) {
            Location::firstOrCreate([
                'name' => $continent['name'],
                'slug' => $continent['slug'],
                'type' => 'continent',
            ]);
        }

        // 5. Create some countries
        $countries = [
            ['name' => 'الجزائر', 'slug' => 'algeria'],
            ['name' => 'مصر', 'slug' => 'egypt'],
            ['name' => 'المغرب', 'slug' => 'morocco'],
            ['name' => 'تونس', 'slug' => 'tunisia'],
            ['name' => 'السعودية', 'slug' => 'saudi-arabia'],
            ['name' => 'فرنسا', 'slug' => 'france'],
            ['name' => 'الولايات المتحدة', 'slug' => 'united-states']
        ];

        foreach ($countries as $country) {
            Location::firstOrCreate([
                'name' => $country['name'],
                'slug' => $country['slug'],
                'type' => 'country',
            ]);
        }

        // 6. Create some cities
        $cities = [
            ['name' => 'الجزائر العاصمة', 'slug' => 'algiers'],
            ['name' => 'وهران', 'slug' => 'oran'],
            ['name' => 'قسنطينة', 'slug' => 'constantine'],
            ['name' => 'القاهرة', 'slug' => 'cairo'],
            ['name' => 'الدار البيضاء', 'slug' => 'casablanca'],
            ['name' => 'تونس', 'slug' => 'tunis'],
            ['name' => 'الرياض', 'slug' => 'riyadh'],
            ['name' => 'باريس', 'slug' => 'paris'],
            ['name' => 'نيويورك', 'slug' => 'new-york']
        ];

        foreach ($cities as $city) {
            Location::firstOrCreate([
                'name' => $city['name'],
                'slug' => $city['slug'],
                'type' => 'city',
            ]);
        }

        // 7. Create some categories
        $categories = [
            ['name' => 'سياسة', 'slug' => 'politics'],
            ['name' => 'اقتصاد', 'slug' => 'economy'],
            ['name' => 'رياضة', 'slug' => 'sports'],
            ['name' => 'ثقافة', 'slug' => 'culture'],
            ['name' => 'تكنولوجيا', 'slug' => 'technology'],
            ['name' => 'صحة', 'slug' => 'health'],
            ['name' => 'تعليم', 'slug' => 'education'],
            ['name' => 'ترفيه', 'slug' => 'entertainment'],

        ];

        foreach ($categories as $category) {
            Category::firstOrCreate(
                ['name' => $category['name']],
                ['slug' => $category['slug']]
            );
        }
    }
}
