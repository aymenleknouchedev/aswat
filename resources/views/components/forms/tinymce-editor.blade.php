@props(['id' => 'myeditorinstance', 'value' => ''])

<textarea name="content" id="{{ $id }}" class="form-control">
    {!! $value !!}
</textarea>
