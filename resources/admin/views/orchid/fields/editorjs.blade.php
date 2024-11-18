@component($typeForm, get_defined_vars())
    <div id="{{ $editor }}" data-controller="editorjs" data-editorjs-value="{!! $attributes['value'] !!}"
        data-editorjs-editor-id="{{ $editor }}">
        <input type="hidden" {{ $attributes }}>
    </div>
@endcomponent
