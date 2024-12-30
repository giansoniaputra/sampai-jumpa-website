<?php

namespace App\Http\Controllers;

use App\Models\Profil;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProfilController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Profil'
        ];
        return view('admin.profil.index', $data);
    }

    public function render_profil()
    {
        $data = Profil::first();
        if ($data) {
            return response()->json(['data' => $data]);
        } else {
            return response()->json(['kosong' => 'kosong']);
        }
    }

    public function update_profil(Request $request)
    {
        $cek = Profil::all();
        if (count($cek) == 0) {
            $rules = [
                'visi' => 'required',
                'misi' => 'required',
                'photo' => 'required|image|max:2048',
            ];
            $pesan = [
                'visi.required' => 'Visi tidak boleh kosong!',
                'misi.required' => 'Misi tidak boleh kosong!',
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
                    'visi' => $request->visi,
                    'misi' => $request->misi,
                    'photo' => $request->file('photo')->store('photo-misi')
                ];
                Profil::create($data);
                return response()->json(['success' => 'Visi & Misi berhasil Di Update']);
            }
        } else if ($cek[0] && $cek[0]->visi == null) {
            $lastData = Profil::first();
            $rules = [
                'visi' => 'required',
                'misi' => 'required',
                'photo' => 'required|image|max:2048',
            ];
            $pesan = [
                'visi.required' => 'Visi tidak boleh kosong!',
                'misi.required' => 'Misi tidak boleh kosong!',
                'photo.required' => 'Photo tidak boleh kosong!',
                'photo.image' => 'Photo tidak valid!',
                'photo.max' => 'Ukuran Photo max 2MB!',
            ];
            $validator = Validator::make($request->all(), $rules, $pesan);
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()])->setStatusCode(400);
            } else {
                $data = [
                    'visi' => $request->visi,
                    'misi' => $request->misi,
                    'photo' => $request->file('photo')->store('photo-misi')
                ];
                Profil::where('uuid', $lastData->uuid)->update($data);
                return response()->json(['success' => 'Visi & Misi berhasil Di Update']);
            }
        } else {
            $lastData = Profil::first();
            $rules = [
                'visi' => 'required',
                'misi' => 'required',
                'photo' => 'image|max:2048',
            ];
            $pesan = [
                'visi.required' => 'Visi tidak boleh kosong!',
                'misi.required' => 'Misi tidak boleh kosong!',
                'photo.image' => 'Photo tidak valid!',
                'photo.max' => 'Ukuran Photo max 2MB!',
            ];
            $validator = Validator::make($request->all(), $rules, $pesan);
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()])->setStatusCode(400);
            } else {
                $data = [
                    'visi' => $request->visi,
                    'misi' => $request->misi,
                ];
                if ($request->file('photo')) {
                    Storage::delete($lastData->photo);
                    $data['photo'] = $request->file('photo')->store('photo-misi');
                }
                Profil::where('uuid', $lastData->uuid)->update($data);
                return response()->json(['success' => 'Visi & Misi berhasil Di Update']);
            }
        }
    }

    public function update_tujuan(Request $request)
    {
        $cek = Profil::all();
        if (count($cek) == 0) {
            $rules = [
                'tujuan' => 'required',
                'strategi' => 'required',
            ];
            $pesan = [
                'tujuan.required' => 'Tujuan tidak boleh kosong!',
                'strategi.required' => 'Strategi tidak boleh kosong!',
            ];
            $validator = Validator::make($request->all(), $rules, $pesan);
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()])->setStatusCode(400);
            } else {
                $data = [
                    'uuid' => Str::orderedUuid(),
                    'tujuan' => $request->tujuan,
                    'strategi' => $request->strategi,
                ];
                Profil::create($data);
                return response()->json(['success' => 'Tujuan & Strategi berhasil Di Update']);
            }
        } else {
            $lastData = Profil::first();
            $rules = [
                'tujuan' => 'required',
                'strategi' => 'required',
            ];
            $pesan = [
                'tujuan.required' => 'Tujuan tidak boleh kosong!',
                'strategi.required' => 'Strategi tidak boleh kosong!',
            ];
            $validator = Validator::make($request->all(), $rules, $pesan);
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()])->setStatusCode(400);
            } else {
                $data = [
                    'tujuan' => $request->tujuan,
                    'strategi' => $request->strategi,
                ];
                Profil::where('uuid', $lastData->uuid)->update($data);
                return response()->json(['success' => 'Tujuan & Strategi berhasil Di Update']);
            }
        }
    }
}
