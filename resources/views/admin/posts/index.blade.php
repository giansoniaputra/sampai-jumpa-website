@extends('admin.layouts.main')
@section('container')
@if(session()->has('success'))
<div class="alert alert-success" role="alert">
    {{ session('success') }}
</div>
@endif
<a href="/admin/news/create" class="btn btn-primary mb-3">Create New Post</a>
<div class="row mt-2">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
            </div>
            <div class="card-body table-responsive">
                <table id="table-berita" class="table table-bordered table-hover dataTable dtr-inline">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Category</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($posts as $post)
                        @if(strtolower($post->category->name) != 'zona integrasi')
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->category->name }}</td>
                            <td>
                                <a href="/show-news/{{ $post->slug }}" class="btn btn-info"><i class="fas fa-eye"></i></a>
                                <a href="/edit-news/{{ $post->slug }}" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                                <form action="/delete-news/{{ $post->slug }}" method="post" class="d-inline">
                                    @method('delete')
                                    @csrf
                                    <button class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus data?')"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $("#table-berita").DataTable({
            columnDefs: [{
                    targets: [3], // index kolom atau sel yang ingin diatur
                    className: "text-center", // kelas CSS untuk memposisikan isi ke tengah
                }
                , {
                    searchable: false
                    , orderable: false
                    , targets: 0, // Kolom nomor, dimulai dari 0
                }
            , ]
        , });
    });

</script>
@endsection
