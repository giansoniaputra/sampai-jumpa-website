<?php

namespace App\Http\Controllers;

use App\Models\Prestasi;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class PrestasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("admin.prestasi.index", [
            'title' => 'Prestasi'
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
            'even' => 'required',
            'jenis_prestasi' => 'required',
            'penyelenggara' => 'required',
            'tanggal' => 'required',
            'prestasi' => 'required',
        ];
        $pesan = [
            'jenis_prestasi.required' => 'Jenis prestasi tidak boleh kosong',
            'even.required' => 'Even tidak boleh kosong',
            'penyelenggara.required' => 'Penyelenggara tidak boleh kosong',
            'tanggal.required' => 'Tanggal tidak boleh kosong',
            'prestasi.required' => 'Prestasi tidak boleh kosong',
        ];
        $validator = Validator::make($request->all(), $rules, $pesan);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()])->setStatusCode(400);
        } else {
            $data = $request->all();
            unset($data['_token']);
            $data['uuid'] = Str::orderedUuid();
            Prestasi::create($data);
            return response()->json(['success' => 'Prestasi Berhasil Ditambahkan']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Prestasi $prestasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Prestasi $prestasi)
    {
        return response()->json(['data' => $prestasi]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Prestasi $prestasi)
    {
        $rules = [
            'even' => 'required',
            'jenis_prestasi' => 'required',
            'penyelenggara' => 'required',
            'tanggal' => 'required',
            'prestasi' => 'required',
        ];
        $pesan = [
            'jenis_prestasi.required' => 'Jenis prestasi tidak boleh kosong',
            'even.required' => 'Even tidak boleh kosong',
            'penyelenggara.required' => 'Penyelenggara tidak boleh kosong',
            'tanggal.required' => 'Tanggal tidak boleh kosong',
            'prestasi.required' => 'Prestasi tidak boleh kosong',
        ];
        $validator = Validator::make($request->all(), $rules, $pesan);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()])->setStatusCode(400);
        } else {
            $data = $request->all();
            unset($data['_token']);
            unset($data['_method']);
            Prestasi::where('uuid', $prestasi->uuid)->update($data);
            return response()->json(['success' => 'Prestasi Berhasil Diubah']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Prestasi $prestasi)
    {
        Prestasi::destroy($prestasi->id);
        return response()->json(['success' => 'Prestasi Berhasil Dihapus']);
    }

    public function dataTables(Request $request)
    {
        $query = Prestasi::all();
        foreach ($query as $row) {
            $row->tanggal = tanggaL_hari($row->tanggal);
        }
        return DataTables::of($query)->addColumn('action', function ($row) {
            $actionBtn =
                '
                <button class="btn btn-rounded btn-sm btn-warning text-dark edit-button" title="Edit Data" data-uuid="' . $row->uuid . '"><i class="fas fa-edit"></i></button>
                <button class="btn btn-rounded btn-sm btn-danger text-white delete-button" title="Hapus Data" data-uuid="' . $row->uuid . '" data-token="' . csrf_token() . '"><i class="fas fa-trash-alt"></i></button>';
            return $actionBtn;
        })->make(true);
    }
}
