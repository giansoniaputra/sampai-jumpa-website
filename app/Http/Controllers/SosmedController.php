<?php

namespace App\Http\Controllers;

use App\Models\Sosmed;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class SosmedController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("admin.sosmed.index", ['title' => 'Sosmed dan Link PPDB']);
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
            'wa' => 'required',
            'ig' => 'required',
            'yt' => 'required',
            'fb' => 'required',
            'x' => 'required',
            'tt' => 'required',
            'gmail' => 'required',
            'website' => 'required',
        ];
        $pesan = [
            'wa.required' => "Tidak boleh kosong!",
            'ig.required' => "Tidak boleh kosong!",
            'yt.required' => "Tidak boleh kosong!",
            'fb.required' => "Tidak boleh kosong!",
            'x.required' => "Tidak boleh kosong!",
            'tt.required' => "Tidak boleh kosong!",
            'gmail.required' => "Tidak boleh kosong!",
            'website.required' => "Tidak boleh kosong!",
        ];
        $validator = Validator::make($request->all(), $rules, $pesan);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()])->setStatusCode(400);
        } else {
            $cek = Sosmed::first();
            if ($cek) {
                $data = [
                    'wa' => $request->wa,
                    'ig' => $request->ig,
                    'yt' => $request->yt,
                    'fb' => $request->fb,
                    'x' => $request->x,
                    'tt' => $request->tt,
                    'gmail' => $request->gmail,
                    'website' => $request->website,
                    'ppdb' => $request->ppdb,
                    'ulang' => $request->ulang,
                ];
                Sosmed::where('uuid', $cek->uuid)->update($data);
                return response()->json(['success' => 'Berhasil mengupdate sosial media!']);
            } else {
                $data = [
                    'uuid' => Str::orderedUuid(),
                    'wa' => $request->wa,
                    'ig' => $request->ig,
                    'yt' => $request->yt,
                    'fb' => $request->fb,
                    'x' => $request->x,
                    'tt' => $request->tt,
                    'gmail' => $request->gmail,
                    'website' => $request->website,
                    'ppdb' => $request->ppdb,
                    'ulang' => $request->ulang,
                ];
                Sosmed::create($data);
                return response()->json(['success' => 'Berhasil mengupdate sosial media!']);
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Sosmed $sosmed)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sosmed $sosmed)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sosmed $sosmed)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sosmed $sosmed)
    {
        //
    }

    public function dataTables(Request $request)
    {
        $query = Sosmed::all();
        return DataTables::of($query)->addColumn('action', function ($row) {
            $actionBtn =
                '
                <button class="btn btn-rounded btn-sm btn-warning text-dark edit-button" title="Edit Data" data-unique="' . $row->unique . '"><i class="fas fa-edit"></i></button>
                <button class="btn btn-rounded btn-sm btn-danger text-white delete-button" title="Hapus Data" data-unique="' . $row->unique . '" data-token="' . csrf_token() . '"><i class="fas fa-trash-alt"></i></button>';
            return $actionBtn;
        })->make(true);
    }

    public function render_sosmed()
    {
        $cek = Sosmed::first();
        if ($cek) {
            return response()->json(['data' => $cek]);
        } else {
            return response()->json(['kosong' => '']);
        }
    }
}
