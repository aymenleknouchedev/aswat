@foreach ($moreContents as $content)
    <div style="margin-bottom: 15px" class="newCategory-all-card">
        <div class="newCategory-all-card-image">
            <img src="{{ $content->media()->wherePivot('type', 'main')->first()->path ?? './user/assets/images/IMG19.jpg' }}"
                alt="{{ $content->title ?? 'News Image' }}">
        </div>
        <div class="newCategory-all-card-text">
            <h3>{{ $content->category->name ?? 'سياسة' }}</h3>
            <h2>{{ $content->title ?? '' }}</h2>
            <p>{{ $content->summary ?? '' }}</p>
        </div>
    </div>
@endforeach
