@extends('article.create')
@section('title', 'Edit Article')

{{-- Main --}}
@section('title-value', $article->title)
@section('content-value', $article->content)

{{-- Aside --}}
@section('tags-value')
@php
    foreach($article->tags as $key => $tag) {
        if($key > 0)
            echo ', ';
        echo $tag->name;
    }
@endphp
@endsection

@section('submit-btn', 'Update')

{{-- Ajax --}}
@section('script')

    <script>
        var file = {};
        //Upload the file is preloaded because I can't send files with PUT method
        $('input[type=file]').change(() => {
            var data = new FormData();
            $.each($('input[type=file]')[0].files, function(i, f) {
                data.append('image', f);
                file = f;
            });
            
            data.append('_token', '{{ csrf_token() }}');

            $.ajax({
                url: "{{ route('article.upload.image') }}",
                method: 'POST',
                cache: false,
                contentType: false,
                processData: false,
                data
            }).always((r) => {
                dd(r);
                //ddw(r);
            });;
        });

        $('#submit-btn').click((e) => {
            e.preventDefault();

            var data = $('#main-form').serialize() + '&' + $('#aside-form').serialize();
            if(file instanceof File) {
                data += '&image=' + file.name;
            }

            $.ajax({
                url: "{{ route('article.update', $article->id) }}",
                method: 'PUT',
                data
            }).done((r) => {
                if(r === '') 
                    window.location.replace("{{ route('article.index') }}");
            }).always((r) => {
                dd(r);
                //ddw(r);
            });
        });
    </script>

@endsection