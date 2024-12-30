<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\Kepemimpinan;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class KepemimpinanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("admin.kepemimpinan.index", ['title' => 'Kepemimpinan']);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'nama' => 'required',
            'tahun_awal' => 'required',
            'tahun_akhir' => 'required',
        ];
        $pesan = [
            'nama.required' => 'Nama tidak boleh kosong',
            'tahun_awal.required' => 'Tahun awal tidak boleh kosong',
            'tahun_akhir.required' => 'Tahun akhir tidak boleh kosong',
        ];
        $validator = Validator::make($request->all(), $rules, $pesan);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()])->setStatusCode(400);
        } else {
            $data = [
                'uuid' => Str::orderedUuid(),
                'nama' => $request->nama,
                'tahun_awal' => $request->tahun_awal,
                'tahun_akhir' => $request->tahun_akhir,
            ];
            Kepemimpinan::create($data);
            return response()->json(['success' => 'Kepemimpinan Berhasil Ditambahkan!']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Kepemimpinan $kepemimpinan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kepemimpinan $kepemimpinan)
    {
        return response()->json(['data' => $kepemimpinan]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kepemimpinan $kepemimpinan)
    {
        $rules = [
            'nama' => 'required',
            'tahun_awal' => 'required',
            'tahun_akhir' => 'required',
        ];
        $pesan = [
            'nama.required' => 'Nama tidak boleh kosong',
            'tahun_awal.required' => 'Tahun awal tidak boleh kosong',
            'tahun_akhir.required' => 'Tahun akhir tidak boleh kosong',
        ];
        $validator = Validator::make($request->all(), $rules, $pesan);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()])->setStatusCode(400);
        } else {
            $data = [
                'nama' => $request->nama,
                'tahun_awal' => $request->tahun_awal,
                'tahun_akhir' => $request->tahun_akhir,
            ];
            Kepemimpinan::where('uuid', $kepemimpinan->uuid)->update($data);
            return response()->json(['success' => 'Kepemimpinan Berhasil Diubah!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kepemimpinan $kepemimpinan)
    {
        Kepemimpinan::destroy($kepemimpinan->id);
        return response()->json(['success' => 'Kepemimpinan Berhasil Dihapus!']);
    }

    public function dataTables(Request $request)
    {
        $query = Kepemimpinan::all();
        return DataTables::of($query)->addColumn('action', function ($row) {
            $actionBtn =
                '
    <button class="btn btn-rounded btn-sm btn-warning text-dark edit-button" title="Edit Data" data-uuid="' . $row->uuid . '"><i class="fas fa-edit"></i></button>
    <button class="btn btn-rounded btn-sm btn-danger text-white delete-button" title="Hapus Data" data-uuid="' . $row->uuid . '" data-token="' . csrf_token() . '"><i class="fas fa-trash-alt"></i></button>';
            return $actionBtn;
        })->make(true);
    }
}
