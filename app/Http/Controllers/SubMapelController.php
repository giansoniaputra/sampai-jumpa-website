<?php

namespace App\Http\Controllers;

use App\Models\SubMapel;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class SubMapelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
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
            'sub_mapel' => 'required',
            'jumlah_jam' => 'required',
            'jumlah_jam_2' => 'required',
        ];
        $pesan = [
            'sub_mapel.required' => 'Sub mata pelajaran tidak boleh kosong!',
            'jumlah_jam.required' => 'Jumlah jam tidak boleh kosong',
            'jumlah_jam_2.required' => 'Jumlah jam tidak boleh kosong',
        ];
        $validator = Validator::make($request->all(), $rules, $pesan);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()])->setStatusCode(400);
        } else {
            $data = [
                'uuid' => Str::orderedUuid(),
                'mapel_uuid' => $request->mapel_uuid,
                'sub_mapel' => $request->sub_mapel,
                'jumlah_jam' => $request->jumlah_jam,
                'jumlah_jam_2' => $request->jumlah_jam_2,
            ];
            SubMapel::create($data);
            return response()->json(['success' => 'Sub Mata Pelajaran Berhasil Ditambahkan']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(SubMapel $subMapel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubMapel $subMapel)
    {
        return response()->json(['data' => $subMapel]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SubMapel $subMapel)
    {
        $rules = [
            'sub_mapel' => 'required',
            'jumlah_jam' => 'required',
            'jumlah_jam_2' => 'required',
        ];
        $pesan = [
            'sub_mapel.required' => 'Sub mata pelajaran tidak boleh kosong!',
            'jumlah_jam.required' => 'Jumlah jam tidak boleh kosong',
            'jumlah_jam_2.required' => 'Jumlah jam tidak boleh kosong',
        ];
        $validator = Validator::make($request->all(), $rules, $pesan);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()])->setStatusCode(400);
        } else {
            $data = [
                'mapel_uuid' => $request->mapel_uuid,
                'sub_mapel' => $request->sub_mapel,
                'jumlah_jam' => $request->jumlah_jam,
                'jumlah_jam_2' => $request->jumlah_jam_2,
            ];
            SubMapel::where('uuid', $subMapel->uuid)->update($data);
            return response()->json(['success' => 'Sub Mata Pelajaran Berhasil Diubah']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubMapel $subMapel)
    {
        SubMapel::destroy($subMapel->id);
        return response()->json(['success' => 'Sub Mata Pelajaran Berhasil Dihapus']);
    }

    public function dataTables(Request $request)
    {
        $query = SubMapel::where('mapel_uuid', $request->mapel_uuid)->get();

        return DataTables::of($query)->addColumn('action', function ($row) {
            $actionBtn =
                '
                <button class="btn btn-rounded btn-sm btn-warning text-dark edit-button" title="Edit Data" data-uuid="' . $row->uuid . '"><i class="fas fa-edit"></i></button>
                <button class="btn btn-rounded btn-sm btn-danger text-white delete-button" title="Hapus Data" data-uuid="' . $row->uuid . '" data-token="' . csrf_token() . '"><i class="fas fa-trash-alt"></i></button>';
            return $actionBtn;
        })->make(true);
    }
}
