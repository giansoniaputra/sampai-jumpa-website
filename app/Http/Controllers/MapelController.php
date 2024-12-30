<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use App\Models\Kurikulum;
use App\Models\JenisMapel;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class MapelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("admin.mapel.index", [
            'title' => 'Mata Pelajaran',
            'jenis_mapel' => JenisMapel::all(),
            'kelas' => Kurikulum::all()
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
            'jenis_mapel_uuid' => 'required',
            'is_parent' => 'required',
            'nama_mapel' => 'required',
        ];
        $pesan = [
            'nama_mapel.required' => 'Nama mata pelajaran tidak boleh kosong',
            'is_parent.required' => 'Sub mata pelajaran tidak boleh kosong!',
            'jenis_mapel_uuid.required' => 'Jenis mataelajaran tidak boleh kosong!',
        ];
        $validator = Validator::make($request->all(), $rules, $pesan);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()])->setStatusCode(400);
        } else {
            $data = [
                'uuid' => Str::orderedUuid(),
                'jenis_mapel_uuid' => $request->jenis_mapel_uuid,
                'is_parent' => $request->is_parent,
                'kelas' => $request->kelas,
                'nama_mapel' => $request->nama_mapel,
                'jumlah_jam' => $request->jumlah_jam,
                'jumlah_jam_2' => $request->jumlah_jam_2
            ];
            Mapel::create($data);
            return response()->json(['success' => 'Mata Pelajaran Berhasil Ditambahkan']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Mapel $mapel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mapel $mapel)
    {
        return response()->json(['data' => $mapel]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mapel $mapel)
    {
        $rules = [
            'jenis_mapel_uuid' => 'required',
            'is_parent' => 'required',
            'nama_mapel' => 'required',
        ];
        $pesan = [
            'nama_mapel.required' => 'Nama mata pelajaran tidak boleh kosong',
            'is_parent.required' => 'Sub mata pelajaran tidak boleh kosong!',
            'jenis_mapel_uuid.required' => 'Jenis mataelajaran tidak boleh kosong!',
        ];
        $validator = Validator::make($request->all(), $rules, $pesan);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()])->setStatusCode(400);
        } else {
            $data = [
                'jenis_mapel_uuid' => $request->jenis_mapel_uuid,
                'is_parent' => $request->is_parent,
                'kelas' => $request->kelas,
                'nama_mapel' => $request->nama_mapel,
                'jumlah_jam' => $request->jumlah_jam,
                'jumlah_jam_2' => $request->jumlah_jam_2
            ];
            Mapel::where('uuid', $mapel->uuid)->update($data);
            return response()->json(['success' => 'Mata Pelajaran Berhasil Diubah']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mapel $mapel)
    {
        Mapel::destroy($mapel->id);
        return response()->json(['success' => 'Mata Pelajaran Berhasil Dihapus']);
    }

    public function dataTables(Request $request)
    {
        $query = DB::table('mapels as a')
            ->join('jenis_mapels as b', 'a.jenis_mapel_uuid', '=', 'b.uuid')
            ->join('kurikulums as c', 'a.kelas', '=', 'c.uuid')
            ->select('a.*', 'b.jenis_mapel', 'c.uuid as cuuid')
            ->orderBy('b.jenis_mapel', 'asc')
            ->where('c.uuid', $request->uuid)
            ->get();

        return DataTables::of($query)->addColumn('action', function ($row) {
            if ($row->is_parent == 1) {
                $actionBtn =
                    '
                <button class="btn btn-rounded btn-sm btn-success text-white add-button" title="Edit Data" data-uuid="' . $row->uuid . '"><i class="fas fa-plus"></i></button>
                <button class="btn btn-rounded btn-sm btn-warning text-dark edit-button" title="Edit Data" data-uuid="' . $row->uuid . '"><i class="fas fa-edit"></i></button>
                <button class="btn btn-rounded btn-sm btn-danger text-white delete-button" title="Hapus Data" data-uuid="' . $row->uuid . '" data-token="' . csrf_token() . '"><i class="fas fa-trash-alt"></i></button>';
            } else {
                $actionBtn =
                    '
                <button class="btn btn-rounded btn-sm btn-warning text-dark edit-button" title="Edit Data" data-uuid="' . $row->uuid . '"><i class="fas fa-edit"></i></button>
                <button class="btn btn-rounded btn-sm btn-danger text-white delete-button" title="Hapus Data" data-uuid="' . $row->uuid . '" data-token="' . csrf_token() . '"><i class="fas fa-trash-alt"></i></button>';
            }
            return $actionBtn;
        })->make(true);
    }
}
