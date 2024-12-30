<?php

namespace App\Http\Controllers;

use App\Models\JenisMapel;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class JenisMapelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("admin.jenis-mapel.index", [
            'title' => 'Jenis Mata Pelajaran'
        ]);
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
            'jenis_mapel' => 'required',
        ];
        $pesan = [
            'jenis_mapel.required' => 'Jenis mata pelajaran tidak boleh kosong',
        ];
        $validator = Validator::make($request->all(), $rules, $pesan);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()])->setStatusCode(400);
        } else {
            $data = [
                'uuid' => Str::orderedUuid(),
                'jenis_mapel' => $request->jenis_mapel,
                'jumlah_jam' => $request->jumlah_jam
            ];
            JenisMapel::create($data);
            return response()->json(['success' => 'Jenis Mata Pelajaran Berhasil Ditambahkan']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(JenisMapel $jenisMapel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JenisMapel $jenisMapel)
    {
        return response()->json(['data' => $jenisMapel]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JenisMapel $jenisMapel)
    {
        $rules = [
            'jenis_mapel' => 'required',
        ];
        $pesan = [
            'jenis_mapel.required' => 'Jenis mata pelajaran tidak boleh kosong',
        ];
        $validator = Validator::make($request->all(), $rules, $pesan);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()])->setStatusCode(400);
        } else {
            $data = [
                'jenis_mapel' => $request->jenis_mapel,
                'jumlah_jam' => $request->jumlah_jam
            ];
            JenisMapel::where('uuid', $jenisMapel->uuid)->update($data);
            return response()->json(['success' => 'Jenis Mata Pelajaran Berhasil Diubah']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JenisMapel $jenisMapel)
    {
        JenisMapel::destroy($jenisMapel->id);
        return response()->json(['success' => 'Jenis Mata Pelajaran Berhasil Dihapus']);
    }

    public function dataTables(Request $request)
    {
        $query = JenisMapel::all();
        return DataTables::of($query)->addColumn('action', function ($row) {
            $actionBtn =
                '
    <button class="btn btn-rounded btn-sm btn-warning text-dark edit-button" title="Edit Data" data-uuid="' . $row->uuid . '"><i class="fas fa-edit"></i></button>
    <button class="btn btn-rounded btn-sm btn-danger text-white delete-button" title="Hapus Data" data-uuid="' . $row->uuid . '" data-token="' . csrf_token() . '"><i class="fas fa-trash-alt"></i></button>';
            return $actionBtn;
        })->make(true);
    }
}
