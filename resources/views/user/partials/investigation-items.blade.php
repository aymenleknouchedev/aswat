@foreach ($otherInvestigations as $investigation)
    <div class="investigations-section-item">
        <img src="{{ $investigation->media()->wherePivot('type', 'main')->first()->path }}" alt="{{ $investigation->title }}">
        <h3>{{ $investigation->category->name ?? '' }}</h3>
        <h2>{{ $investigation->title }}</h2>
    </div>
@endforeach
