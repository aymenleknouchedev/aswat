@if (isset($content->country))
    <a href="{{ route('category.show', ['id' => $content->category->id, 'type' => 'Category']) }}">
        {{ $content->category->name ?? '' }}
    </a>
    -
    <a href="{{ route('category.show', ['id' => $content->country->id, 'type' => 'Country']) }}">
        {{ $content->country->name ?? '' }}
    </a>
@elseif (isset($content->continent))
    <a href="{{ route('category.show', ['id' => $content->category->id, 'type' => 'Category']) }}">
        {{ $content->category->name ?? '' }}
    </a>
    -
    <a href="{{ route('category.show', ['id' => $content->continent->id, 'type' => 'Continent']) }}">
        {{ $content->continent->name ?? '' }}
    </a>
@else
    <a href="{{ route('category.show', ['id' => $content->category->id, 'type' => 'Category']) }}">
        {{ $content->category->name ?? '' }}
    </a>
@endif
