<?php

namespace App\Http\Controllers;

use App\Models\Komponen;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class KomponenController extends Controller
{
    public function index()
    {
        return view("admin.komponen.index", [
            'title' => 'Komponen Jabatan'
        ]);
    }

    public function store(Request $request)
    {
        $rules = [
            'nama' => 'required',
            'jabatan' => 'required',
        ];
        $pesan = [
            'nama.required' => 'Nama tidak boleh kosong',
            'jabatan.required' => 'Jabatan tidak boleh kosong',
        ];
        $validator = Validator::make($request->all(), $rules, $pesan);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()])->setStatusCode(400);
        } else {
            $data = [
                'uuid' => Str::orderedUuid(),
                'nama' => $request->nama,
                'jabatan' => $request->jabatan,
            ];
            Komponen::create($data);
            return response()->json(['success' => 'Komponen Jabatan Berhasil Ditambahkan!']);
        }
    }

    public function edit(Komponen $komponen)
    {
        return response()->json(['data' => $komponen]);
    }

    public function update(Komponen $komponen, Request $request)
    {
        $rules = [
            'nama' => 'required',
            'jabatan' => 'required',
        ];
        $pesan = [
            'nama.required' => 'Nama tidak boleh kosong',
            'jabatan.required' => 'Jabatan tidak boleh kosong',
        ];
        $validator = Validator::make($request->all(), $rules, $pesan);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()])->setStatusCode(400);
        } else {
            $data = [
                'nama' => $request->nama,
                'jabatan' => $request->jabatan,
            ];
            Komponen::where('uuid', $komponen->uuid)->update($data);
            return response()->json(['success' => 'Komponen Jabatan Berhasil Diubah!']);
        }
    }

    public function destroy(Komponen $komponen)
    {
        Komponen::destroy($komponen->id);
        return response()->json(['success' => 'Komponen Jabatan Berhasil Dihapus']);
    }

    public function dataTables(Request $request)
    {
        $query = Komponen::all();
        return DataTables::of($query)->addColumn('action', function ($row) {
            $actionBtn =
                '
    <button class="btn btn-rounded btn-sm btn-warning text-dark edit-button" title="Edit Data" data-uuid="' . $row->uuid . '"><i class="fas fa-edit"></i></button>
    <button class="btn btn-rounded btn-sm btn-danger text-white delete-button" title="Hapus Data" data-uuid="' . $row->uuid . '" data-token="' . csrf_token() . '"><i class="fas fa-trash-alt"></i></button>';
            return $actionBtn;
        })->make(true);
    }
}
