@foreach ($otherInvestigations as $investigation)
    <div class="investigations-section-item">
        <a href="{{ route('news.show', $investigation->title) }}">
            <img src="{{ $investigation->media()->wherePivot('type', 'main')->first()->path }}"
                alt="{{ $investigation->title }}">
        </a>
        <h3><x-category-links :content="$investigation" /></h3>
        <a href="{{ route('news.show', $investigation->title) }}" style="text-decoration: none; color: inherit;">
            <h2>{{ $investigation->title }}</h2>
        </a>
    </div>
@endforeach
