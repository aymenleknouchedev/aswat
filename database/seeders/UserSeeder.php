<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;

use Illuminate\Support\Facades\Hash;

use App\Models\Location;
use App\Models\Category;
use App\Models\Trend;
use App\Models\PrincipalTrend;
use App\Models\Section;
use App\Models\Content;
use App\Models\ContentMedia;
use App\Models\Tag;

class UserSeeder extends Seeder
{
    public function run()
    {
    // Use Arabic faker for news content text
    $faker = \Faker\Factory::create('ar_SA');
        // 1. Create permissions
          $permissions = [
            'dashboard_access',
            'content_access',
            'publish_content',
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
            'publish_content',
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

        // 8. Create some tags
        $tagsData = [
            'عاجل',
            'تحقيق',
            'تحليل',
            'رأي',
            'حوار',
            'سياسة',
            'اقتصاد',
            'رياضة',
            'ثقافة',
            'فن',
            'تكنولوجيا',
            'صحة',
            'بيئة',
            'ميديا',
        ];

        $tags = collect();
        foreach ($tagsData as $tagName) {
            $tags->push(Tag::firstOrCreate(['name' => $tagName]));
        }

        // Create a default trend and assign it as the principal trend
        $trend = Trend::firstOrCreate(
            ['slug' => 'main-trend'],
            ['title' => 'الترند الرئيسي', 'image' => 'trend.png']
        );

        PrincipalTrend::updateOrCreate(
            [],
            ['trend_id' => $trend->id, 'is_active' => 1]
        );
        
        // 9. Create sections
        $sectionsData = [
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
            'أخبار',
            'آراء',
            'نوافذ',
            'ملفات',
            'فحص',
            'فيديو',
            'بودكاست',
            'صور',
        ];

        $sections = [];
        foreach ($sectionsData as $sectionName) {
            $sections[] = Section::firstOrCreate(['name' => $sectionName]);
        }

        // 10. Create 6 contents for each section (static Arabic text)
        foreach ($sections as $section) {
            for ($i = 0; $i < 6; $i++) {
                $template = 'normal_image';

                $contentData = [
                    'title'        => 'عنوان ثابت للمحتوى التجريبي',
                    'long_title'   => 'عنوان تفصيلي ثابت للمحتوى التجريبي على موقع الأخبار',
                    'mobile_title' => 'عنوان مختصر ثابت',
                    'caption'      => 'وصف قصير ثابت يستخدم لاختبار عرض المحتوى في الموقع.',
                    'summary'      => 'ملخص ثابت للمحتوى الإخباري يُستخدم فقط لأغراض الاختبار داخل قاعدة البيانات.',
                    'content'      => 'هذا نص ثابت لمحتوى إخباري تجريبي. يتم استخدامه لملء قاعدة البيانات بمحتوى افتراضي من أجل اختبار الواجهات، الأقسام، النوافذ، ومحركات البحث داخل الموقع. يمكن تعديل هذا النص لاحقاً ليتناسب مع احتياجات التحرير الفعلية، لكنه حالياً مخصص فقط للاختبارات الداخلية على نظام إدارة المحتوى.',
                    'user_id' => 1, // super admin
                    'section_id' => $section->id,
                    'category_id' => Category::inRandomOrder()->first()->id,
                    'status' => 'published',
                    'template'       => $template,
                    'display_method' => 'simple',
                    'published_at'   => now(),
                    'seo_keyword'    => 'أخبار، محتوى تجريبي، اختبار',
                    'importance' => 1,
                    'shortlink' => bin2hex(random_bytes(3)),
                    'is_latest' => true,
                ];

                $content = Content::create($contentData);

                // Attach 1-3 random tags to each content
                if ($tags->isNotEmpty()) {
                    $contentTagIds = $tags->random(min(3, $tags->count()))->pluck('id')->toArray();
                    $content->tags()->attach($contentTagIds);
                }

                // Attach media via content_media + media_content pivot (no direct image columns on contents)
                if ($template === 'normal_image') {
                    $imageUrl = 'https://assets.nick.com/uri/mgid:arc:imageassetref:ws.kids.com:94fb9b46-8a69-4569-9a3f-893dea5e491b?quality=0.7&gen=ntrn&format=webp&crop=true&width=660';

                    $images = [
                        'main'   => $imageUrl,
                        'mobile' => $imageUrl,
                        'detail' => $imageUrl,
                    ];

                    foreach ($images as $type => $url) {
                        $media = ContentMedia::create([
                            'name'       => "Fake {$type} image",
                            'alt'        => $content->title,
                            'media_type' => 'image',
                            'path'       => $url,
                            'user_id'    => 1,
                        ]);

                        $content->media()->attach($media->id, ['type' => $type]);
                    }
                }
            }
        }
    }
}
