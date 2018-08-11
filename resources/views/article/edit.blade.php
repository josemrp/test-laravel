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
        $('#submit-btn').click((e) => {
            e.preventDefault();
            /*var data = new FormData();

            //Get all Form data
            var mainForm = $('#main-form').serializeArray();
            var asideForm = $('#aside-form').serializeArray();
            var _data = mainForm.concat(asideForm);
            $.each(_data, function(key, input){
                data.append(input.name, input.value);
            });

            //Get files
            $.each($('input[type=file]')[0].files, function(i, file) {
                data.append('image', file);
            });*/

            $.ajax({
                url: "{{ route('article.update', $article->id) }}",
                method: 'PUT',
                cache: false,
                contentType: false,
                //processData: false,
                data: $('#main-form').serialize() + '&' + $('#aside-form').serialize()
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