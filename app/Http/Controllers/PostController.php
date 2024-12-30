<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Cviebrock\EloquentSluggable\Services\SlugService;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'posts' => Post::all(),
            'title' => 'Postingan Berita'
        ];
        return view('admin.posts.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.posts.create', ['categories' => Category::where('name', '!=', 'Zona Integrasi')->get(), 'title' => 'Tambah Postingan baru']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|max:255',
            'author' => 'required',
            'slug' => 'required|unique:posts',
            'image' => 'required|image|file|max:2048',
            'category_id' => 'required',
            'body' => 'required',
        ]);

        if ($request->file('image')) {
            $data['image'] = $request->file('image')->store('post-images');
        }

        $data['author'] = $request->author;
        $data['excerpt'] = Str::limit(strip_tags($request->body), 150);

        Post::create($data);


        return redirect('/admin/news')->with('success', 'Postingan baru berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', ['posts' => $post, 'title' => 'Detail Berita']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $data = [
            'post' => $post,
            'categories' => Category::where('name', '!=', 'Zona Integrasi')->get(),
            'title' => 'Edit Postingan Berita'
        ];
        return view('admin.posts.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {

        $data = [
            'title' => 'required|max:255',
            'author' => 'required',
            'category_id' => 'required',
            'body' => 'required',
        ];

        if ($request->slug != $post->slug) {
            $data['slug'] = 'required|unique:posts';
        }
        if ($request->file('image')) {
            $data['image'] = 'image|file|max:1024';
        }
        $validateData = $request->validate($data);

        if ($request->file('image')) {

            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validateData['image'] = $request->file('image')->store('post-images');
        }

        Post::where('id', $post->id)->update($validateData);




        return redirect('/admin/news')->with('success', 'Postingan baru berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if ($post->image) {
            Storage::delete($post->image);
        }
        Post::where('slug', $post->slug)->delete();
        return redirect('/admin/news')->with('success', 'Data Berhasil Dihapus');
    }

    //Menangani Cek Slug
    public function cekSlug(Request $request)
    {
        $slug = SlugService::createSlug(Post::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }
}
