@foreach ($otherInvestigations as $investigation)
    <div class="investigations-section-item">
        <img src="{{ $investigation->media()->wherePivot('type', 'main')->first()->path }}" alt="{{ $investigation->title }}">
        <h3>{{ $investigation->category->name ?? '' }}</h3>
        <a href="{{ route('news.show', $investigation->title) }}" style="text-decoration: none; color: inherit;">
            <h2>{{ $investigation->title }}</h2>
        </a>
    </div>
@endforeach
