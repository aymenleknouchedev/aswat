@props(['id' => 'myeditorinstance', 'name' => 'content', 'value' => ''])

<textarea id="{{ $id }}" name="{{ $name }}">{{ old($name, $value) }}</textarea>
