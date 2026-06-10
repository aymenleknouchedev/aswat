<style>
    .category-link-hover { text-decoration: none; }
    .category-link-hover:hover { text-decoration: underline; }
</style>
@if ($content->category && $content->country)
    <a href="{{ route('category.show', ['id' => $content->category->id, 'type' => 'Category']) }}" class="category-link-hover">
        {{ $content->category->name ?? '' }}
    </a>
    -
    <a href="{{ route('category.show', ['id' => $content->country->id, 'type' => 'Country']) }}" class="category-link-hover">
        {{ $content->country->name ?? '' }}
    </a>
@elseif ($content->category && $content->continent)
    <a href="{{ route('category.show', ['id' => $content->category->id, 'type' => 'Category']) }}" class="category-link-hover">
        {{ $content->category->name ?? '' }}
    </a>
    -
    <a href="{{ route('category.show', ['id' => $content->continent->id, 'type' => 'Continent']) }}" class="category-link-hover">
        {{ $content->continent->name ?? '' }}
    </a>
@elseif ($content->category)
    <a href="{{ route('category.show', ['id' => $content->category->id, 'type' => 'Category']) }}" class="category-link-hover">
        {{ $content->category->name ?? '' }}
    </a>
@endif
