<?php

namespace App\Http\Controllers;

use App\Models\Home;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function index()
    {
        return view("admin.home.index", [
            'title' => 'Dashboard'
        ]);
    }

    public function render_home()
    {
        $data = Home::first();
        if ($data) {
            return response()->json(['data' => $data]);
        } else {
            return response()->json(['kosong' => 'kosong']);
        }
    }

    public function update_home(Request $request)
    {
        $cek = Home::all();
        if (count($cek) == 0) {
            $rules = [
                'welcome' => 'required',
                'photo' => 'required|image|max:2048',
            ];
            $pesan = [
                'welcome.required' => 'Deskripsi tidak boleh kosong!',
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
                    'welcome' => $request->welcome,
                    'photo' => $request->file('photo')->store('photo-kepsek')
                ];
                Home::create($data);
                return response()->json(['success' => 'Deskripsi berhasil Di Update']);
            }
        } else {
            $lastData = Home::first();
            $rules = [
                'welcome' => 'required',
                'photo' => 'image|max:2048',
            ];
            $pesan = [
                'welcome.required' => 'Deskripsi tidak boleh kosong!',
                'photo.image' => 'Photo tidak valid!',
                'photo.max' => 'Ukuran Photo max 2MB!',
            ];
            $validator = Validator::make($request->all(), $rules, $pesan);
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()])->setStatusCode(400);
            } else {
                $data = [
                    'welcome' => $request->welcome,
                ];
                if ($request->file('photo')) {
                    Storage::delete($lastData->photo);
                    $data['photo'] = $request->file('photo')->store('photo-kepsek');
                }
                Home::where('uuid', $lastData->uuid)->update($data);
                return response()->json(['success' => 'Deskripsi berhasil Di Update']);
            }
        }
    }
}
