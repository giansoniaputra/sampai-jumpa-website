@extends('admin.layouts.main')
@section('container')
<div class="card">
    <div class="card-body row">
        <div class="col-sm-6">
            <form method="post" action="/update-news/{{ $post->slug }}" enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="title" value="{{ old('title', $post->title) }}">
                    @error('title')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="slug" class="form-label">Slug</label>
                    <input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror" id="slug" readonly value="{{ old('slug', $post->slug) }}">
                    @error('slug')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <label for="category_id" class="form-label">Kategori</label>
                <div class="mb-3">
                    <select class="form-control @error('category_id') is-invalid @enderror" name="category_id" id="category_id">
                        <option selected disabled value="">Pilih Kategori</option>
                        @foreach( $categories as $category)
                        <option value="{{ $category->id }}" {{ ($category->id == old('category_id', $post->category_id) ? 'selected':'') }}>
                            {{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="author" class="form-label">Author</label>
                    <input type="text" name="author" class="form-control @error('author') is-invalid @enderror" id="author" value="{{ old('author', $post->author) }}">
                    @error('author')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Sampul</label>
                    <input type="hidden" name="oldImage" value="{{ $post->image }}">
                    @if($post->image)
                    <img src="{{ asset('storage/'. $post->image) }}" alt="" class="img-fluid img-preview mb-2 col-sm-5">
                    @else
                    <img class="img-fluid img-preview mb-2 col-sm-5">
                    @endif
                    <input class="form-control @error('image') is-invalid @enderror" name="image" type="file" id="image" onchange="previewImage()">
                    @error('image')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
        </div>
        <div class="col-sm-6">
            <div class="mb-3 mt-3">
                <label for="body" class="form-label">body</label>
                <input id="body" type="hidden" name="body" value="{{ old('body', $post->body) }}">
                <trix-editor input="body" style="height: 350px;  overflow-y:scroll"></trix-editor>
                @error('body')
                <p class="text-danger mb-3">
                    {{ $message }}
                </p>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Update Post</button>
            </form>
        </div>
    </div>
</div>
@include('admin.posts.modal-cropper')

<script>
    const title = document.querySelector('#title');
    const slug = document.querySelector('#slug');

    title.addEventListener('change', function() {
        fetch('/cekSlug?title=' + title.value)
            .then(response => response.json())
            .then(data => slug.value = data.slug)
    });

    document.addEventListener('trix-file-accept', function(event) {
        event.preventDefault();
    })

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
@section('js_after')
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


    let modal = $("#modal-cropper")
    let image = document.getElementById('image-modal');
    let cropper, reader, file
    $("body").on("change", "#image", function(e) {
        let files = e.target.files;
        let done = function(url) {
            image.src = url;
            modal.modal("show");
        }
        if (files && files.length > 0) {
            file = files[0];
            if (URL) {
                done(URL.createObjectURL(file));
            } else if (FileReader) {
                reader = new FileReader();
                reader.onload = function(e) {
                    done(reader.result);
                }
                reader.readAsDataURL(file)
            }
        }

    })

    modal.on('shown.bs.modal', function() {
        cropper = new Cropper(image, {
            aspectRatio: 3 / 2
            , preview: '.preview'
        })
    }).on('hidden.bs.modal', function() {
        cropper.destroy();
        cropper = null;
    })

    $("#modal-cropper").on("click", ".crop_photo", function() {
        canvas = cropper.getCroppedCanvas({
            width: 1080
            , height: 720
        , })
        canvas.toBlob(function(blob) {
            let image = document.querySelector("#image");
            const imgPre = document.querySelector(".img-preview");
            // const imgPre = document.querySelector("#");
            const oFReader = new FileReader();
            oFReader.readAsDataURL(blob);
            oFReader.onload = function(oFREvent) {
                var file = dataURLtoFile(oFREvent.target.result, "photo-sampul.png");
                let container = new DataTransfer();
                container.items.add(file);
                image.files = container.files;
                var newfile = image.files[0];
                imgPre.src = oFREvent.target.result
                modal.modal("hide")
            }
        })
    })

    function dataURLtoFile(dataurl, filename) {

        var arr = dataurl.split(',')
            , mime = arr[0].match(/:(.*?);/)[1]
            , bstr = atob(arr[1])
            , n = bstr.length
            , u8arr = new Uint8Array(n);

        while (n--) {
            u8arr[n] = bstr.charCodeAt(n);
        }

        return new File([u8arr], filename, {
            type: mime
        });
    }

    // function previewImage() {
    //     const image = document.querySelector('#image');
    //     const imgPre = document.querySelector('.img-preview');

    //     imgPre.style.display = 'block';

    //     const oFReader = new FileReader();
    //     oFReader.readAsDataURL(image.files[0]);
    //     oFReader.onload = function(oFREvent) {
    //         imgPre.src = oFREvent.target.result;
    //     }
    // }

</script>
@endsection
