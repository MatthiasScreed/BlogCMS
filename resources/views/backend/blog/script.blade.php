@section('style')
    {{-- <link rel="stylesheet" href="/backend/plugins/tag-editor/jquery.tag-editor.css"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tag-editor/1.0.20/jquery.tag-editor.min.css" integrity="sha512-QZr414Am8HQVvn2yIBCtByjrjbTLYzpWE3CRyhbu22dkjX4gcB7HVbpMz8YpLBhVL024/MYaDyXPmUwaZkQ+iQ==" crossorigin="anonymous" />
@endsection

@section('script')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/caret/1.3.7/jquery.caret.min.js" integrity="sha512-DR6H+EMq4MRv9T/QJGF4zuiGrnzTM2gRVeLb5DOll25f3Nfx3dQp/NlneENuIwRHngZ3eN6w9jqqybT3Lwq+4A==" crossorigin="anonymous"></script>
  {{-- <script src="/backend/plugins/tag-editor/jquery.caret.min.js"></script> --}}
  {{-- <script src="/backend/plugins/tag-editor/jquery.tag-editor.min.js"></script> --}}
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tag-editor/1.0.20/jquery.tag-editor.min.js" integrity="sha512-wexRM3SVzXnR9XDRR32JUDTyDZP3XGAsrsbVl+rBMupJsHZqbUCBMxVHDDzCpvKVhJqerRYoInsRA2ySEzpYLg==" crossorigin="anonymous"></script>
  <script type="text/javascript">

    var options = {};

    @if($post->exists)
        options = {
            initialTags: {!! $post->tags_list !!}
        }
    @endif

    $('input[name=post_tags]').tagEditor();
    $('ul.pagination').addClass('no-margin pagination-sm');

    $('#title').on('blur', function() {
        var theTitle = this.value.toLowerCase().trim(),
            slugInput = $('#slug'),
            theSlug = theTitle.replace(/&/g, '-and-')
                              .replace(/[^a-z0-9-]/g, '-')
                              .replace(/\-\-+/g, '-')
                              .replace(/^-+|-+$/g, '-');

            slugInput.val(theSlug);
    });

    var simplemde1 = new SimpleMDE({ element: $("#excerpt")[0] });
    var simplemde2 = new SimpleMDE({ element: $("#body")[0] });

    $('#datetimepicker1').datetimepicker({
        format: 'YYY-MM-DD HH:mm:ss',
        showClear: true
    });

    $('#draft-btn').click(function(e) {
        e.preventDefault();
        $('#published_at').val("");
        $('#post-form').submit();
    });
  </script>
@endsection
