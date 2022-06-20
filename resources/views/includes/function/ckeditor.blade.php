@push('after-scripts')

    @if (@$type == 'standard')
        <script src="{{ asset('plugins/ckeditor4-standard/ckeditor.js') }}"></script>
    @else
        <script src="{{ asset('plugins/ckeditor4-basic/ckeditor.js') }}"></script>
    @endif

    <script>
        CKEDITOR.replace('editor1');
        CKEDITOR.replace('editor2');
        CKEDITOR.replace('editor3');
        CKEDITOR.replace('editor4');
        CKEDITOR.replace('editor5');
        CKEDITOR.replace('editor6');
        CKEDITOR.replace('editor7');
        CKEDITOR.replace('editor8');
        CKEDITOR.replace('editor9');
        CKEDITOR.replace('editor10');
        CKEDITOR.replace('editor11');
    </script>
@endpush
