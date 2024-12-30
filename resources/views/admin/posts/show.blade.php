@extends('admin.layouts.main')

@section('container')
<div class="card">
    <div class="card-body row">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">{{ $posts->title }}</h1>
        </div>
        <div class="container">
            <div class="d-flex mb-2">
                <a href="/admin/news" class="btn btn-primary">Back To All Post</a>
                <a href="/edit-news/{{ $posts->slug }}" class="btn btn-warning text-white ml-2">Edit</a>
                <form action="/delete-news/{{ $posts->slug }}" method="post" class="d-inline">
                    @method('delete')
                    @csrf
                    <button class="btn btn-danger border-0 " onclick="return confirm('Yakin ingin menghapus data?')">Hapus</button>
                </form>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-12 ">
                    @if($posts->image == NULL)
                    <img src="https://source.unsplash.com/1200x400?{{ $posts->name }}" alt="{{ $posts->category->name }}" class="img-fluid">
                    @else
                    <img src="/storage/{{ $posts->image }}" alt="{{ $posts->category->name }}" class="img-fluid">
                    @endif
                    <article class="my-3 fs-6">
                        <p>{!! $posts->body !!}</p>
                    </article>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
