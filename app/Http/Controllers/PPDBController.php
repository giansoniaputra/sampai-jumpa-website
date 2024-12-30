<?php

namespace App\Http\Controllers;

use App\Models\PPDB;
use App\Models\Sampul;
use App\Models\Sosmed;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class PPDBController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("admin.ppdb.index", [
            'title' => 'PPDB'
        ]);
    }

    public function update_ppdb(Request $request)
    {
        $cek = Sosmed::first();
        if ($cek) {
            Sosmed::where('uuid', $cek->uuid)->update(['ppdb' => $request->ppdb]);
            return response()->json(['success' => 'Link PPDB Berhasil Diupdate']);
        } else {
            Sosmed::create([
                'uuid' => Str::orderedUuid(),
                'ppdb' => $request->ppdb
            ]);
            return response()->json(['success' => 'Link PPDB Berhasil Diupdate']);
        }
    }

    public function update_ulang(Request $request)
    {
        $cek = Sosmed::first();
        if ($cek) {
            Sosmed::where('uuid', $cek->uuid)->update(['ulang' => $request->ulang]);
            return response()->json(['success' => 'Link Pendaftaran Berhasil Diupdate']);
        } else {
            Sosmed::create([
                'uuid' => Str::orderedUuid(),
                'ulang' => $request->ulang
            ]);
            return response()->json(['success' => 'Link Pendaftaran Ulang Berhasil Diupdate']);
        }
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
            'kegiatan' => 'required',
            'tanggal' => 'required',
            'tanggal2' => 'required',
        ];
        $pesan = [
            'kegiatan.required' => 'Kegiatan tidak boleh kosong!',
            'tanggal.required' => 'Tanggal tidak boleh kosong!',
            'tanggal2.required' => 'Tanggal tidak boleh kosong!',
        ];
        $validator = Validator::make($request->all(), $rules, $pesan);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()])->setStatusCode(400);
        } else {
            $data = [
                'uuid' => Str::orderedUuid(),
                'kegiatan' => $request->kegiatan,
                'tanggal' => $request->tanggal,
                'tanggal2' => $request->tanggal2,
            ];
            PPDB::create($data);
            return response()->json(['success' => 'Kegiatan Berhasil Ditambahkan']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(PPDB $pPDB)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PPDB $pPDB, $uuid)
    {
        $data = PPDB::where('uuid', $uuid)->first();
        return response()->json(['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PPDB $pPDB, $uuid)
    {
        $rules = [
            'kegiatan' => 'required',
            'tanggal' => 'required',
            'tanggal2' => 'required',
        ];
        $pesan = [
            'kegiatan.required' => 'Kegiatan tidak boleh kosong!',
            'tanggal.required' => 'Tanggal tidak boleh kosong!',
            'tanggal2.required' => 'Tanggal tidak boleh kosong!',
        ];
        $validator = Validator::make($request->all(), $rules, $pesan);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()])->setStatusCode(400);
        } else {
            $data = [
                'kegiatan' => $request->kegiatan,
                'tanggal' => $request->tanggal,
                'tanggal2' => $request->tanggal2,
            ];
            PPDB::where('uuid', $uuid)->update($data);
            return response()->json(['success' => 'Kegiatan Berhasil Diupdate']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PPDB $pPDB)
    {
        PPDB::where('uuid', $pPDB->uuid)->delete();
        return response()->json(['success' => 'Kegiatan Berhasil Dihapus']);
    }
    public function destroy2($uuid)
    {
        PPDB::where('uuid', $uuid)->delete();
        return response()->json(['success' => 'Kegiatan Berhasil Dihapus']);
    }

    public function dataTablesPrestasi(Request $request)
    {
        $query = PPDB::all();
        return DataTables::of($query)->addColumn('action', function ($row) {
            $actionBtn =
                '
    <button class="btn btn-rounded btn-sm btn-warning text-dark edit-button" title="Edit Data" data-uuid="' . $row->uuid . '"><i class="fas fa-edit"></i></button>
    <button class="btn btn-rounded btn-sm btn-danger text-white delete-button" title="Hapus Data" data-uuid="' . $row->uuid . '" data-token="' . csrf_token() . '"><i class="fas fa-trash-alt"></i></button>';
            return $actionBtn;
        })->make(true);
    }

    public function render_view_link()
    {
        $data = [
            'sosmed' => Sosmed::first(),
        ];
        $sampul = Sampul::first();
        if ($sampul && $sampul->link_ppdb != null) {
            $data['sampul'] = $sampul->link_ppdb;
        }
        if ($sampul && $sampul->link_ppdb_bawah != null) {
            $data['sampul_bawah'] = $sampul->link_ppdb_bawah;
        }
        $view = View::make('admin.ppdb.view-link', $data)->render();
        return response()->json(['view' => $view]);
    }
}
