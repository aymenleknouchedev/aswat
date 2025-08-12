<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Logic to retrieve and display all contents
        return view('dashboard.allcontents');
    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {

        $sections = [
            (object) ['id' => 1, 'name' => 'الأخبار المحلية', 'en' => 'Local News'],
            (object) ['id' => 2, 'name' => 'التكنولوجيا', 'en' => 'Technology'],
            (object) ['id' => 3, 'name' => 'الصحة', 'en' => 'Health'],
            (object) ['id' => 4, 'name' => 'الرياضة', 'en' => 'Sports'],
            (object) ['id' => 5, 'name' => 'الثقافة', 'en' => 'Culture'],
        ];

        $categories = [
            (object) ['id' => 1, 'name' => 'تصنيف 1', 'en' => 'Category 1'],
            (object) ['id' => 2, 'name' => 'تصنيف 2', 'en' => 'Category 2'],
        ];

        $writers = [
            (object) ['id' => 1, 'name' => 'أحمد العلي', 'en' => 'Ahmed Ali'],
            (object) ['id' => 2, 'name' => 'سارة منصور', 'en' => 'Sarah Mansour'],
            (object) ['id' => 3, 'name' => 'ليلى خالد', 'en' => 'Laila Khaled'],
            (object) ['id' => 4, 'name' => 'محمد ناصر', 'en' => 'Mohamed Nasser'],
        ];

        $locations = [
            (object) ['id' => 1, 'name' => 'الجزائر العاصمة', 'en' => 'Algiers'],
            (object) ['id' => 2, 'name' => 'وهران', 'en' => 'Oran'],
        ];

        $tags = [
            (object) ['id' => 1, 'name' => 'تقنية', 'en' => 'Tech'],
            (object) ['id' => 2, 'name' => 'رياضة', 'en' => 'Sports'],
            (object) ['id' => 3, 'name' => 'صحة', 'en' => 'Health'],
            (object) ['id' => 4, 'name' => 'ثقافة', 'en' => 'Culture'],
        ];

        $trends = [
            (object) ['id' => 1, 'name' => 'ترند 1', 'en' => 'Trend 1'],
            (object) ['id' => 2, 'name' => 'ترند 2', 'en' => 'Trend 2'],
            (object) ['id' => 3, 'name' => 'ترند 3', 'en' => 'Trend 3'],
        ];

        $windows = [
            (object) ['id' => 1, 'name' => 'نافذة 1', 'en' => 'Window 1'],
            (object) ['id' => 2, 'name' => 'نافذة 2', 'en' => 'Window 2'],
            (object) ['id' => 3, 'name' => 'نافذة 3', 'en' => 'Window 3'],
        ];

        $existing_images = ['existing_image_1.jpg', 'existing_image_2.jpg', 'existing_image_3.jpg'];
        $existing_videos = ['existing_video_1.mp4', 'existing_video_2.mp4'];
        $existing_podcasts = ['existing_podcast_1.mp3', 'existing_podcast_2.mp3'];
        $existing_albums = ['album_image_1.jpg', 'album_image_2.jpg', 'album_image_3.jpg'];

        return view('dashboard.addcontent', compact(
            'sections',
            'categories',
            'writers',
            'locations',
            'tags',
            'trends',
            'windows',
            'existing_images',
            'existing_videos',
            'existing_podcasts',
            'existing_albums'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
