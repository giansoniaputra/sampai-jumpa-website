<?php

namespace App\Http\Controllers;

use App\Models\Information;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class InformationController extends Controller
{
    public function index()
    {
        $informasi = Information::first();
        $data = [
            'title' => 'Informasi Sekolah'
        ];
        if ($informasi) {
            $data['informasi'] = $informasi;
        }
        return view("admin.information.index", $data);
    }

    public function dataTables(Request $request)
    {
        $query = Information::all();
        return DataTables::of($query)->make(true);
    }

    public function render_informasi()
    {
        $informasi = Information::first();
        if ($informasi) {
            return response()->json(['data' => $informasi]);
        } else {
            return response()->json(['kosong' => 'kosong']);
        }
    }

    public function update(Request $request)
    {
        if ($request->current_uuid) {
            $rules = [
                'nama_madrasah' => 'required',
                'npsn' => 'required',
                'nsm' => 'required',
                'alamat' => 'required',
                'telepon' => 'required',
                'sk' => 'required',
            ];
            $pesan = [
                'nama_madrasah.required' => 'Tidak boleh kosong',
                'npsn.required' => 'Tidak boleh kosong',
                'nsm.required' => 'Tidak boleh kosong',
                'alamat.required' => 'Tidak boleh kosong',
                'telepon.required' => 'Tidak boleh kosong',
                'sk.required' => 'Tidak boleh kosong',
            ];
            $validator = Validator::make($request->all(), $rules, $pesan);
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()])->setStatusCode(400);
            } else {
                $data = $request->request->all();
                unset($data['_token']);
                unset($data['current_uuid']);
                Information::where('uuid', $request->current_uuid)->update($data);
                return response()->json(['success' => 'Informasi Berhasil Diupdate']);
            }
        } else {
            $rules = [
                'nama_madrasah' => 'required',
                'npsn' => 'required',
                'nsm' => 'required',
                'alamat' => 'required',
                'telepon' => 'required',
                'sk' => 'required',
            ];
            $pesan = [
                'nama_madrasah.required' => 'Tidak boleh kosong',
                'npsn.required' => 'Tidak boleh kosong',
                'nsm.required' => 'Tidak boleh kosong',
                'alamat.required' => 'Tidak boleh kosong',
                'telepon.required' => 'Tidak boleh kosong',
                'sk.required' => 'Tidak boleh kosong',
            ];
            $validator = Validator::make($request->all(), $rules, $pesan);
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()])->setStatusCode(400);
            } else {
                $data = $request->all();
                unset($data['_token']);
                $data['uuid'] = Str::orderedUuid();
                Information::create($data);
                return response()->json(['success' => 'Informasi Berhasil Diupdate']);
            }
        }
    }
}
