<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class GalleryController extends Controller
{
    public function index()
    {
        return view("admin.gallery.index", ['title' => 'Gallery']);
    }

    public function render_gallery(Request $request)
    {
        $limit = $request->limit;
        if ($limit <= 8) {
            $gallery = Gallery::orderBy('id', 'desc')->limit(8)->get();
            $max = Gallery::count('id');
        } else {
            $gallery = Gallery::orderBy('id', 'desc')->skip($limit - 8)->take(8)->get();
            $max = Gallery::count('id');
        }
        return response()->json(['data' => $gallery, 'max' => $max]);
    }

    public function store(Request $request)
    {
        $rules = [
            'photo' => 'required|image|max:2048',
        ];
        $pesan = [
            'photo.required' => 'Photo tidak boleh kosong!',
            'photo.image' => 'Photo tidak valid!',
            'photo.max' => 'Ukuran Photo max 2MB!',
        ];
        $validator = Validator::make($request->all(), $rules, $pesan);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()])->setStatusCode(400);
        } else {
            $data = [
                'uuid' => Str::orderedUuid(),
                'photo' => $request->file('photo')->store('gallery')
            ];
            Gallery::create($data);
            return response()->json(['success' => "Gambar Berhasil Diupload"]);
        }
    }

    public function destroy(Gallery $gallery)
    {
        Storage::delete($gallery->photo);
        Gallery::destroy($gallery->id);
        return response()->json(['success' => "Gambar Berhasil Dihapus"]);
    }
}
