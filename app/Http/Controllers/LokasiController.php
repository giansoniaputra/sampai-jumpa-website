<?php

namespace App\Http\Controllers;

use App\Models\Lokasi;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LokasiController extends Controller
{
    public function index()
    {
        return view("admin.lokasi.index", ['title' => 'Lokasi']);
    }

    public function render_lokasi()
    {
        $lokasi = Lokasi::first();
        if ($lokasi) {
            return response()->json(['data' => $lokasi]);
        } else {
            return response()->json(['kosong' => '']);
        }
    }

    public function update(Request $request)
    {
        $lokasi = Lokasi::first();
        if ($lokasi) {
            $rules = [
                'lokasi' => 'required',
            ];
            $pesan = [
                'lokasi.required' => 'Lokasi tidak boleh kosong!',
            ];
            $validator = Validator::make($request->all(), $rules, $pesan);
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()])->setStatusCode(400);
            } else {
                $data = [
                    'lokasi' => $request->lokasi
                ];
                Lokasi::where('uuid', $lokasi->uuid)->update($data);
                return response()->json(['success' => 'Lokasi Berhasil Diupdate']);
            }
        } else {
            $rules = [
                'lokasi' => 'required',
            ];
            $pesan = [
                'lokasi.required' => 'Lokasi tidak boleh kosong!',
            ];
            $validator = Validator::make($request->all(), $rules, $pesan);
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()])->setStatusCode(400);
            } else {
                $data = [
                    'uuid' => Str::orderedUuid(),
                    'lokasi' => $request->lokasi
                ];
                Lokasi::create($data);
                return response()->json(['success' => 'Lokasi Berhasil Diupdate']);
            }
        }
    }
}
