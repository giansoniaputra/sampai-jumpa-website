<?php

namespace App\Http\Controllers;

use App\Models\Sambutan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class SambutanController extends Controller
{
    public function index()
    {
        return view("admin.sambutan.index", [
            'title' => 'Sambutan Kepala Sekolah dan Sejarah'
        ]);
    }

    public function render_sambutan()
    {
        $sambutan = Sambutan::first();
        if ($sambutan) {
            return response()->json(['data' => $sambutan]);
        } else {
            return response()->json(['kosong' => 'kosong']);
        }
    }

    public function update_sambutan(Request $request)
    {
        $lastData = Sambutan::first();
        if ($lastData) {
            $data = [
                'sambutan' => $request->sambutan,
                'sejarah' => $request->sejarah,
            ];
            Sambutan::where('uuid', $lastData->uuid)->update($data);
            return response()->json(['success' => 'Sambutan dan Sejarah Berhasil Diupdate']);
        } else {
            $data = [
                'uuid' => Str::orderedUuid(),
                'sambutan' => $request->sambutan,
                'sejarah' => $request->sejarah,
            ];
            Sambutan::create($data);
            return response()->json(['success' => 'Sambutan dan Sejarah Berhasil Diupdate']);
        }
    }
}
