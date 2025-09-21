<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use App\Models\Section;
use Illuminate\Support\Facades\Hash;
use App\Models\Tag;
use App\Models\Location;

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

        // 9. الوسوم المتعلقة بموقع إخباري، مستوحاة من الأقسام
        $tags = [
            'سياسة',
            'انتخابات',
            'حكومة',
            'مجتمع',
            'تعليم',
            'اقتصاد',
            'بورصة',
            'أعمال',
            'رياضة',
            'كرة القدم',
            'كرة السلة',
            'مشاهير',
            'فن',
            'موسيقى',
            'تكنولوجيا',
            'هواتف',
            'إنترنت',
            'صحة',
            'طب',
            'بيئة',
            'تغير المناخ',
            'صور',
            'فيديو',
            'بودكاست',
            'تحقيقات',
            'رأي',
            'مقالات',
            'مقابلات',
            'عاجل',
            'محلي',
            'دولي',
            'ثقافة',
            'كتب',
            'ميديا',
            'ترفيه',
            'سفر',
            'سياحة',
            'أمن',
            'حوادث',
            'علوم',
        ];

        // 10. إنشاء كل وسم إذا لم يكن موجود
        foreach ($tags as $tag) {
            Tag::firstOrCreate(
                ['name' => $tag],
            );
        }


        // 11. القارات
        $continents = [
            'أفريقيا',
            'آسيا',
            'أوروبا',
            'أمريكا الشمالية',
            'أمريكا الجنوبية',
            'أستراليا',
            'القارة القطبية الجنوبية',
        ];

        foreach ($continents as $continent) {
            Location::firstOrCreate([
                'name' => $continent,
                'type' => 'continent',
            ]);
        }

        // 12. الدول (أمثلة)
        $countries = [
            'الجزائر',
            'مصر',
            'فرنسا',
            'ألمانيا',
            'الولايات المتحدة',
            'البرازيل',
            'الصين',
            'أستراليا',
        ];

        foreach ($countries as $country) {
            Location::firstOrCreate([
                'name' => $country,
                'type' => 'country',
            ]);
        }

        // 13. المدن (أمثلة)
        $cities = [
            'الجزائر العاصمة',
            'القاهرة',
            'باريس',
            'برلين',
            'نيويورك',
            'ريو دي جانيرو',
            'بكين',
            'سيدني',
        ];

        foreach ($cities as $city) {
            Location::firstOrCreate([
                'name' => $city,
                'type' => 'city',
            ]);
        }

        // 14. الفئات (أمثلة)
        $categories = [
            // إضافات تفصيلية مستوحاة من الأقسام
            'سياسة',
            'انتخابات',
            'حكومة',
            'مجتمع',
            'تعليم',
            'بورصة',
            'أعمال',
            'كرة القدم',
            'كرة السلة',
            'مشاهير',
            'فن',
            'موسيقى',
            'هواتف',
            'إنترنت',
            'طب',
            'تغير المناخ',
            'تحقيقات',
            'مقالات',
            'مقابلات',
            'عاجل',
            'محلي',
            'دولي',
            'كتب',
            'ترفيه',
            'سفر',
            'سياحة',
            'أمن',
            'حوادث',
            'علوم',
            'بيئة',
            'صحة',
            'ثقافة',
            'تكنولوجيا',
            'رياضة',
            'اقتصاد',
            'ميديا',
            'صور',
            'فيديو',
            'بودكاست',
            'ملفات',
            'نوافذ',
            'آراء',
            'ناس',
            'منوعات',
            'ثقافة وفنون',
            'بيانات',
            'إحصائيات',
            'ابتكارات',
            'سيارات',
            'عقارات',
            'أزياء',
            'طبخ',
            'أسرة',
            'طفولة',
            'شباب',
            'مرأة',
            'رجال',
            'حياة يومية',
            'مناسبات',
            'مهرجانات',
            'جوائز',
            'مؤتمرات',
            'معارض',
            'دراسات',
            'أبحاث',
            'قصص نجاح',
            'مبادرات',
            'تطوع',
            'تراث',
            'سياحة داخلية',
            'سياحة خارجية',
            'ألعاب إلكترونية',
            'ذكاء اصطناعي',
            'روبوتات',
            'برمجيات',
            'أمن سيبراني',
            'فضاء',
            'طاقة',
            'مياه',
            'زراعة',
            'غذاء',
            'حيوانات',
            'نباتات',
            'كوارث طبيعية',
            'طقس',
            'أخبار محلية',
            'أخبار دولية',
        ];

        foreach ($categories as $category) {
            \App\Models\Category::firstOrCreate(
            ['name' => $category],
            );
        }
    }
}
