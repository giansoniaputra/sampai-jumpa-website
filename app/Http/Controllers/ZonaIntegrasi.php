<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ZonaIntegrasi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'posts' => Post::all(),
            'title' => 'Postingan Zona Integrasi'
        ];
        return view('admin.zona-integrasi.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.zona-integrasi.create', ['categories' => Category::where('name', '=', 'Zona Integrasi')->first(), 'title' => 'Tambah Postingan Zona Integrasi']);
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


        return redirect('/admin/zona-integrasi')->with('success', 'Postingan baru berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $zona_integrasi)
    {
        return view('admin.zona-integrasi.show', ['posts' => $zona_integrasi, 'title' => 'Detail Postingan Zona Integrasi']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $zona_integrasi)
    {
        $data = [
            'post' => $zona_integrasi,
            'categories' => Category::where('name', 'Zona Integrasi')->first(),
            'title' => 'Edit Postingan'
        ];
        return view('admin.zona-integrasi.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $zona_integrasi)
    {

        $data = [
            'title' => 'required|max:255',
            'author' => 'required',
            'body' => 'required',
        ];

        if ($request->slug != $zona_integrasi->slug) {
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

        Post::where('id', $zona_integrasi->id)->update($validateData);




        return redirect('/admin/zona-integrasi')->with('success', 'Postingan berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $zona_integrasi)
    {
        if ($zona_integrasi->image) {
            Storage::delete($zona_integrasi->image);
        }
        Post::where('slug', $zona_integrasi->slug)->delete();
        return redirect('/admin/zona-integrasi')->with('success', 'Data Berhasil Dihapus');
    }
}
