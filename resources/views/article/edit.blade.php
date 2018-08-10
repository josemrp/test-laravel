@extends('article.create')

@section('title-value', $article->title)
@section('content-value', $article->content)
{{-- @section('tags-value', $article->tags);  --}}

@section('submit-btn', 'Update')

@section('script')

    <script>
        $('#submit-btn').click((e) => {
            e.preventDefault();
            $.ajax({
                url: "{{ route('article.update', $article->id) }}",
                method: 'PUT',
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