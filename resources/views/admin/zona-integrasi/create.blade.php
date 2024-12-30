@extends('admin.layouts.main')
@section('container')
<div class="card">
    <div class="card-body row">
        <div class="col-sm-6">
            <form method="post" action="/admin/zona-integrasi" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="title" value="{{ old('title') }}">
                    @error('title')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="slug" class="form-label">Slug</label>
                    <input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror" id="slug" readonly value="{{ old('slug') }}">
                    @error('slug')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="author" class="form-label">Author</label>
                    <input type="text" name="author" class="form-control @error('author') is-invalid @enderror" id="author" value="{{ old('author') }}">
                    @error('author')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <input type="hidden" name="category_id" id="category_id" value="{{ $categories->id }}">
                <div class="mb-3">
                    <label for="image" class="form-label">Sampul</label>
                    <img class="img-fluid img-preview mb-2 col-sm-5">
                    <input class="form-control @error('image') is-invalid @enderror" name="image" type="file" id="image" onchange="previewImage()">
                    @error('image')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
        </div>
        <div class="col-sm-6">
            <div class="mb-3">
                <label for="body" class="form-label">body</label>
                <input id="body" type="hidden" name="body" value="{{ old('body') }}">
                <trix-editor input="body" style="height: 350px; overflow-y:scroll "></trix-editor>
                @error('body')
                <p class="text-danger mb-3">
                    {{ $message }}
                </p>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Create Post</button>
        </div>
        </form>
    </div>
</div>
<script>
    $(document).ready(function() {
        $("#title").on("change", function() {
            $.ajax({
                data: {
                    title: $(this).val()
                }
                , url: "/cekSlug"
                , type: "GET"
                , dataType: 'json'
                , success: function(response) {
                    $("#slug").val(response.slug)
                }
            });
        })

        $("button[data-trix-action='attachFiles']").addClass('d-none')
    });
    // const title = document.querySelector('#title');
    // const slug = document.querySelector('#slug');

    // title.addEventListener('change', function() {
    //     fetch('/admin/news/cekSlug?title=' + title.value)
    //         .then(response => response.json())
    //         .then(data => slug.value = data.slug)
    // });




    function previewImage() {
        const image = document.querySelector('#image');
        const imgPre = document.querySelector('.img-preview');

        imgPre.style.display = 'block';

        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);
        oFReader.onload = function(oFREvent) {
            imgPre.src = oFREvent.target.result;
        }
    }

</script>


@endsection
