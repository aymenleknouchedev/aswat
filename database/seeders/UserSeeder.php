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
use Illuminate\Support\Facades\DB;
use App\Models\PrincipalTrend;
use App\Models\Trend;

class UserSeeder extends Seeder
{
    public function run()
    {

        $trends = [
            ['name' => 'ترند الجزائر', 'slug' => 'algeria-trend', 'image' => 'algeria.png'],
            ['name' => 'ترند كأس العالم', 'slug' => 'world-cup-trend', 'image' => 'world-cup.png'],
            ['name' => 'ترند الانتخابات', 'slug' => 'elections-trend', 'image' => 'elections.png'],
            ['name' => 'ترند الحكومة', 'slug' => 'government-trend', 'image' => 'government.png'],
            ['name' => 'ترند التعليم', 'slug' => 'education-trend', 'image' => 'education.png'],
            ['name' => 'ترند الاقتصاد', 'slug' => 'economy-trend', 'image' => 'economy.png'],
            ['name' => 'ترند الرياضة', 'slug' => 'sports-trend', 'image' => 'sports.png'],
            ['name' => 'ترند كرة القدم', 'slug' => 'football-trend', 'image' => 'football.png'],
            ['name' => 'ترند المشاهير', 'slug' => 'celebrities-trend', 'image' => 'celebrities.png'],
            ['name' => 'ترند الفن', 'slug' => 'art-trend', 'image' => 'art.png'],
            ['name' => 'ترند الموسيقى', 'slug' => 'music-trend', 'image' => 'music.png'],
            ['name' => 'ترند التكنولوجيا', 'slug' => 'technology-trend', 'image' => 'technology.png'],
            ['name' => 'ترند الصحة', 'slug' => 'health-trend', 'image' => 'health.png'],
            ['name' => 'ترند البيئة', 'slug' => 'environment-trend', 'image' => 'environment.png'],
            ['name' => 'ترند المناخ', 'slug' => 'climate-trend', 'image' => 'climate.png'],
            ['name' => 'ترند عاجل', 'slug' => 'breaking-trend', 'image' => 'breaking.png'],
            ['name' => 'ترند محلي', 'slug' => 'local-trend', 'image' => 'local.png'],
            ['name' => 'ترند دولي', 'slug' => 'international-trend', 'image' => 'international.png'],
            ['name' => 'ترند الثقافة', 'slug' => 'culture-trend', 'image' => 'culture.png'],
            ['name' => 'ترند الميديا', 'slug' => 'media-trend', 'image' => 'media.png'],
        ];

        foreach ($trends as $trend) {
            Trend::firstOrCreate([
            'title' => $trend['name'],
            'slug' => $trend['slug'],
            ], [
            'image' => $trend['image'],
            ]);
        }

        PrincipalTrend::firstOrCreate(
            ['trend_id' => 1]
        );

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
            'view_actions_access',
            'coming_soon_access',
            'email_access',
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
            'tag',
            'tag 1',
            'tag 2',
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

        // 12. الدول (أمثلة)
        $countries = [
            ['name' => 'الجزائر', 'slug' => 'algeria'],
            ['name' => 'مصر', 'slug' => 'egypt'],
            ['name' => 'فرنسا', 'slug' => 'france'],
            ['name' => 'ألمانيا', 'slug' => 'germany'],
            ['name' => 'الولايات المتحدة', 'slug' => 'united-states'],
            ['name' => 'البرازيل', 'slug' => 'brazil'],
            ['name' => 'الصين', 'slug' => 'china'],
        ];

        foreach ($countries as $country) {
            Location::firstOrCreate([
                'name' => $country['name'],
                'slug' => $country['slug'],
                'type' => 'country',
            ]);
        }

        // 13. المدن (أمثلة)
        $cities = [
            ['name' => 'الجزائر العاصمة', 'slug' => 'algiers'],
            ['name' => 'القاهرة', 'slug' => 'cairo'],
            ['name' => 'باريس', 'slug' => 'paris'],
            ['name' => 'برلين', 'slug' => 'berlin'],
            ['name' => 'نيويورك', 'slug' => 'new-york'],
            ['name' => 'ريو دي جانيرو', 'slug' => 'rio-de-janeiro'],
            ['name' => 'بكين', 'slug' => 'beijing'],
            ['name' => 'سيدني', 'slug' => 'sydney'],
        ];

        foreach ($cities as $city) {
            Location::firstOrCreate([
                'name' => $city['name'],
                'slug' => $city['slug'],
                'type' => 'city',
            ]);
        }

        // 14. الفئات (أمثلة)

        $categories = [
            ['name' => 'category', 'slug' => 'category'],
            ['name' => 'category 1', 'slug' => 'category-1'],
            ['name' => 'category 2', 'slug' => 'category-2'],
            ['name' => 'سياسة', 'slug' => 'politics'],
            ['name' => 'انتخابات', 'slug' => 'elections'],
            ['name' => 'حكومة', 'slug' => 'government'],
            ['name' => 'city', 'slug' => 'city'],
            ['name' => 'تعليم', 'slug' => 'education'],
            ['name' => 'بورصة', 'slug' => 'stock-market'],
            ['name' => 'أعمال', 'slug' => 'business'],
            ['name' => 'كرة القدم', 'slug' => 'football'],
            ['name' => 'كرة السلة', 'slug' => 'basketball'],
            ['name' => 'مشاهير', 'slug' => 'celebrities'],
            ['name' => 'فن', 'slug' => 'art'],
            ['name' => 'موسيقى', 'slug' => 'music'],
            ['name' => 'هواتف', 'slug' => 'phones'],
            ['name' => 'إنترنت', 'slug' => 'internet'],
            ['name' => 'طب', 'slug' => 'medicine'],
            ['name' => 'تغير المناخ', 'slug' => 'climate-change'],
            ['name' => 'تحقيقات', 'slug' => 'investigations'],
            ['name' => 'مقالات', 'slug' => 'articles'],
            ['name' => 'مقابلات', 'slug' => 'interviews'],
            ['name' => 'عاجل', 'slug' => 'breaking-news'],
            ['name' => 'محلي', 'slug' => 'local'],
            ['name' => 'دولي', 'slug' => 'international'],
            ['name' => 'كتب', 'slug' => 'books'],
            ['name' => 'ترفيه', 'slug' => 'entertainment'],
            ['name' => 'سفر', 'slug' => 'travel'],
            ['name' => 'سياحة', 'slug' => 'tourism'],
            ['name' => 'أمن', 'slug' => 'security'],
            ['name' => 'حوادث', 'slug' => 'accidents'],
            ['name' => 'علوم', 'slug' => 'science'],
            ['name' => 'بيئة', 'slug' => 'environment'],
            ['name' => 'صحة', 'slug' => 'health'],
            ['name' => 'ثقافة', 'slug' => 'culture'],
            ['name' => 'تكنولوجيا', 'slug' => 'technology'],
            ['name' => 'رياضة', 'slug' => 'sports'],
            ['name' => 'اقتصاد', 'slug' => 'economy'],
            ['name' => 'ميديا', 'slug' => 'media'],
            ['name' => 'صور', 'slug' => 'photos'],
            ['name' => 'فيديو', 'slug' => 'videos'],
            ['name' => 'بودكاست', 'slug' => 'podcast'],
            ['name' => 'ملفات', 'slug' => 'files'],
            ['name' => 'نوافذ', 'slug' => 'windows'],
            ['name' => 'آراء', 'slug' => 'opinions'],
            ['name' => 'ناس', 'slug' => 'people'],
            ['name' => 'منوعات', 'slug' => 'variety'],
            ['name' => 'ثقافة وفنون', 'slug' => 'culture-and-arts'],
            ['name' => 'بيانات', 'slug' => 'data'],
            ['name' => 'إحصائيات', 'slug' => 'statistics'],
            ['name' => 'ابتكارات', 'slug' => 'innovations'],
            ['name' => 'سيارات', 'slug' => 'cars'],
            ['name' => 'عقارات', 'slug' => 'real-estate'],
            ['name' => 'أزياء', 'slug' => 'fashion'],
            ['name' => 'طبخ', 'slug' => 'cooking'],
            ['name' => 'أسرة', 'slug' => 'family'],
            ['name' => 'طفولة', 'slug' => 'childhood'],
            ['name' => 'شباب', 'slug' => 'youth'],
            ['name' => 'مرأة', 'slug' => 'women'],
            ['name' => 'رجال', 'slug' => 'men'],
            ['name' => 'حياة يومية', 'slug' => 'daily-life'],
            ['name' => 'مناسبات', 'slug' => 'occasions'],
            ['name' => 'مهرجانات', 'slug' => 'festivals'],
            ['name' => 'جوائز', 'slug' => 'awards'],
            ['name' => 'مؤتمرات', 'slug' => 'conferences'],
            ['name' => 'معارض', 'slug' => 'exhibitions'],
            ['name' => 'دراسات', 'slug' => 'studies'],
            ['name' => 'أبحاث', 'slug' => 'research'],
            ['name' => 'قصص نجاح', 'slug' => 'success-stories'],
            ['name' => 'مبادرات', 'slug' => 'initiatives'],
            ['name' => 'تطوع', 'slug' => 'volunteering'],
            ['name' => 'تراث', 'slug' => 'heritage'],
            ['name' => 'سياحة داخلية', 'slug' => 'domestic-tourism'],
            ['name' => 'سياحة خارجية', 'slug' => 'international-tourism'],
            ['name' => 'ألعاب إلكترونية', 'slug' => 'video-games'],
            ['name' => 'ذكاء اصطناعي', 'slug' => 'artificial-intelligence'],
            ['name' => 'روبوتات', 'slug' => 'robots'],
            ['name' => 'برمجيات', 'slug' => 'software'],
            ['name' => 'أمن سيبراني', 'slug' => 'cybersecurity'],
            ['name' => 'فضاء', 'slug' => 'space'],
            ['name' => 'طاقة', 'slug' => 'energy'],
            ['name' => 'مياه', 'slug' => 'water'],
            ['name' => 'زراعة', 'slug' => 'agriculture'],
            ['name' => 'غذاء', 'slug' => 'food'],
            ['name' => 'حيوانات', 'slug' => 'animals'],
            ['name' => 'نباتات', 'slug' => 'plants'],
            ['name' => 'كوارث طبيعية', 'slug' => 'natural-disasters'],
            ['name' => 'طقس', 'slug' => 'weather'],
            ['name' => 'أخبار محلية', 'slug' => 'local-news'],
            ['name' => 'أخبار دولية', 'slug' => 'international-news'],
        ];


        foreach ($categories as $category) {
            \App\Models\Category::firstOrCreate(
                ['name' => $category['name']],
                ['slug' => $category['slug']]
            );
        }


        // 15. محتوى تجريبي لكل قسم (6 أخبار لكل قسم)
        $sectionsModels = Section::all()->keyBy('name');
        $categoryId = \App\Models\Category::where('name', 'سياسة')->first()?->id;
        $continentId = Location::where('type', 'continent')->where('name', 'أفريقيا')->first()?->id;
        $writerId = \App\Models\Writer::firstOrCreate(
            ['name' => 'كاتب تجريبي'],
            ['slug' => 'katib-tajreebi'],
            ['image' => 'https://www.alaraby.co.uk/sites/default/files/styles/large_16_9/public/2236249571.jpeg?h=40d8988c&itok=6IjF68uM'],
        )->id;

        $mediaIds = [];
        $contentMedia = [
            [
                'name' => 'صورة تجريبية',
                'alt' => 'صورة توضيحية',
                'media_type' => 'image',
                'path' => 'https://www.alaraby.co.uk/sites/default/files/styles/large_16_9/public/2236249571.jpeg?h=40d8988c&itok=6IjF68uM',
                'user_id' => 1,
            ],
            [
                'name' => 'فيديو تجريبي',
                'alt' => 'فيديو توضيحي',
                'media_type' => 'image',
                'path' => 'https://www.alaraby.co.uk/sites/default/files/styles/large_16_9/public/2236249571.jpeg?h=40d8988c&itok=6IjF68uM',
                'user_id' => 1,
            ],
            [
                'name' => 'ميديا إضافية',
                'alt' => 'ميديا إضافية',
                'media_type' => 'image',
                'path' => 'https://www.alaraby.co.uk/sites/default/files/styles/large_16_9/public/2236249571.jpeg?h=40d8988c&itok=6IjF68uM',
                'user_id' => 1,
            ],
        ];
        foreach ($contentMedia as $media) {
            $mediaModel = \App\Models\ContentMedia::firstOrCreate(
                ['name' => $media['name'], 'user_id' => $media['user_id']],
                $media
            );
            $mediaIds[] = $mediaModel->id;
        }
        $pivotTypes = ['main', 'mobile', 'detail'];

        foreach ($sectionsModels as $sectionName => $section) {
            for ($i = 1; $i <= 20; $i++) {
                $contentModel = \App\Models\Content::firstOrCreate(
                    [
                        'title' => "خبر {$i} في قسم {$sectionName}",
                    ],
                    [
                        'title' => "جيش الاحتلال يتقدّم في محاور جديدة بمدينة غزة على وقع قصف مستمرّ",
                        'long_title' => "عنوان طويل لخبر {$i} في قسم {$sectionName}",
                        'mobile_title' => "خبر {$i} - {$sectionName}",
                        'display_method' => 'simple',
                        'section_id' => $section->id,
                        'category_id' => $categoryId,
                        'continent_id' => $continentId,
                        'writer_id' => $writerId,
                        'user_id' => 1,
                        'summary' => "طرح الرئيس الأميركي، دونالد ترامب، اليوم، خطته لإنهاء الحرب على غزة وتضمنت بنوداً عدة؛ أبرزها: الانسحاب التدريجي للجيش الإسرائيلي.",
                        'content' => "هذا نص خبر {$i} في قسم {$sectionName}.",
                        'status' => 'published',
                        'template' => 'normal_image',
                        'seo_keyword' => "{$sectionName}, خبر, {$i}",
                        'share_title' => "شارك خبر {$i} في قسم {$sectionName}",
                        'share_description' => "وصف مشاركة خبر {$i} في قسم {$sectionName}.",
                        'share_image' => 'default_share_image.png',
                    ]
                );
                foreach ($mediaIds as $idx => $mediaId) {
                    $type = $pivotTypes[$idx] ?? 'detail';
                    DB::table('media_content')->updateOrInsert(
                        [
                            'content_id' => $contentModel->id,
                            'content_media_id' => $mediaId,
                            'type' => $type,
                        ],
                        []
                    );
                }
            }
        }
    }
}
