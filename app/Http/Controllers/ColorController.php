<?php

namespace App\Http\Controllers;

use App\Models\Home;
use App\Models\Color;
use App\Models\Sampul;
use App\Models\Gallery;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class ColorController extends Controller
{
    public function index()
    {
        return view("admin.color.index", [
            'title' => "Atur Warna Background",
        ]);
    }

    public function store(Request $request)
    {
        $cek = Color::first();
        if ($cek) {
            Color::where('uuid', $cek->uuid)->update(['color' => $request->color]);
            $data = $this->_data();
            $view = View::make('front-end.index', $data)->render();
            return response()->json(['success' => 'Warna Background Berhasil Diupdate!', 'view' => $view]);
        } else {
            $data = [
                'uuid' => Str::orderedUuid(),
                'color' => $request->color
            ];
            Color::create($data);
            $data2 = $this->_data();
            $view = View::make('front-end.index', $data2)->render();
            return response()->json(['success' => 'Warna Background Berhasil Diupdate!', 'view' => $view]);
        }
    }

    public function render_view()
    {
        $data = $this->_data();
        $view = View::make('front-end.index', $data)->render();
        return response()->json(['view' => $view]);
    }

    public function _data()
    {
        $sampul = Sampul::first();
        $home = Home::first();
        $gallery = Gallery::all();
        $news = DB::table('posts as a')
            ->join('categories as b', 'a.category_id', '=', 'b.id')
            ->select('a.*', 'b.name')
            ->where('b.name', '!=', 'Kegiatan')
            ->limit(3)
            ->get();
        $kegiatan = DB::table('posts as a')
            ->join('categories as b', 'a.category_id', '=', 'b.id')
            ->select('a.*', 'b.name')
            ->where('b.name', '=', 'Kegiatan')
            ->limit(3)
            ->get();
        $id_kegiatan = Category::where('name', 'Kegiatan')->first();
        $data = [
            'sub_judul' => 'Hello & Welcome',
            'posts' => $news,
            'kegiatan' => $kegiatan,
            'id_kegiatan' => $id_kegiatan
        ];
        if ($sampul && $sampul->home != null) {
            $data['sampul'] = $sampul->home;
        }
        if ($home) {
            $data['home'] = $home;
        }
        if (count($gallery) > 0) {
            $data['gallery'] = $gallery;
        }

        return $data;
    }
}
