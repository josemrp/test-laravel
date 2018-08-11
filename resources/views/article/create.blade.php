@extends('template')

@section('title', 'Create Article')

@section('content')

    <h3>@yield('title')</h3>

    <form id="main-form">
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" 
                class="form-control" 
                name="title" 
                id="title" 
                value="@yield('title-value')"
                placeholder="How to use Laravel">
        </div>
        <div class="form-group">
            <label for="content">Content</label>
            <textarea name="content" 
                id="content" 
                cols="30" 
                rows="10" 
                class="form-control" 
                placeholder="Coming in Laravel 5.6 you can..."
            >@yield('content-value')</textarea>
        </div>
    </form>

@endsection

@section('aside')

    <form id="aside-form">
        <div class="form-group">
            <label>Image</label>
            <div class="custom-file">
                <input type="file" 
                    class="custom-file-input"
                    name="image" 
                    id="image" 
                    accept="image/*">
                <label class="custom-file-label" for="image">Choose file</label>
            </div>
        </div>
        
        <div class="form-group">
            <label for="tags">Tags</label>
            <input type="text" 
                name="tags" 
                id="tags"
                class="form-control" 
                value="@yield('tags-value')"
                placeholder="PHP, Back-End, Web">
        </div>
        <br>
        <hr>
        <button id="submit-btn" class="btn btn-primary float-right">
            @yield('submit-btn', 'Create')
        </button>
    </form>

@endsection

@section('script')

    <script>
        $('#submit-btn').click((e) => {
            e.preventDefault();
            var data = new FormData();

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
            });

            $.ajax({
                url: "{{ route('article.store') }}",
                method: 'POST',
                cache: false,
                contentType: false,
                processData: false,
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