<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("admin.pegawai.index", [
            'title' => 'Pesan'
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
            'nama' => 'required',
            'status' => 'required',
            'photo' => 'required|image|max:2048',
        ];
        $pesan = [
            'nama.required' => 'Nama tidak boleh kosong',
            'status.required' => 'Pesan tidak boleh kosong',
            'photo.required' => 'Photo tidak boleh kosong!',
            'photo.image' => 'Photo tidak valid!',
            'photo.max' => 'Ukuran Photo max 2MB!',
        ];
        $validator = Validator::make($request->all(), $rules, $pesan);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()])->setStatusCode(400);
        } else {
            $data = $request->all();
            $data['photo'] = $request->file('photo')->store('guru&staff');
            unset($data['_token']);
            $data['uuid'] = Str::orderedUuid();

            Pegawai::create($data);
            return response()->json(['success' => 'Pesan Berhasil Ditambahkan']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Pegawai $pegawai)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pegawai $pegawai)
    {
        return response()->json(['data' => $pegawai]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pegawai $pegawai)
    {
        $rules = [
            'nama' => 'required',
            'status' => 'required',
        ];
        $pesan = [
            'nama.required' => 'Nama tidak boleh kosong',
            'status.required' => 'Pesan tidak boleh kosong',
        ];
        if ($request->file('photo') != '') {
            $pesan['photo'] = 'required|image|max:2048';
            $pesan['photo.requied'] = 'Photo tidak boleh kosong!';
            $pesan['photo.image'] = 'Photo tidak valid!';
            $pesan['photo.max'] = 'Ukuran Photo max 2MB!';
        }
        $validator = Validator::make($request->all(), $rules, $pesan);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()])->setStatusCode(400);
        } else {
            $data = $request->all();
            if ($request->file('photo') != null) {
                Storage::delete($pegawai->photo);
                $data['photo'] = $request->file('photo')->store('guru&staff');
            }
            unset($data['_token']);
            unset($data['_method']);

            Pegawai::where('uuid', $pegawai->uuid)->update($data);
            return response()->json(['success' => 'Pesan Berhasil Diubah']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pegawai $pegawai)
    {
        Storage::delete($pegawai->photo);
        Pegawai::destroy($pegawai->id);
        return response()->json(['success' => 'Pesan Berhasil Dihapus']);
    }

    public function dataTablesGuru(Request $request)
    {
        $query = Pegawai::all();
        return DataTables::of($query)->addColumn('action', function ($row) {
            $actionBtn =
                '
            <button class="btn btn-rounded btn-sm btn-warning text-dark edit-button" title="Edit Data" data-uuid="' . $row->uuid . '"><i class="fas fa-edit"></i></button>
            <button class="btn btn-rounded btn-sm btn-danger text-white delete-button" title="Hapus Data" data-uuid="' . $row->uuid . '" data-token="' . csrf_token() . '"><i class="fas fa-trash-alt"></i></button>';
            return $actionBtn;
        })->make(true);
    }
    public function dataTablesStaff(Request $request)
    {
        $query = Pegawai::where('is_guru', 0)->get();
        return DataTables::of($query)->addColumn('action', function ($row) {
            $actionBtn =
                '
            <button class="btn btn-rounded btn-sm btn-warning text-dark edit-button" title="Edit Data" data-uuid="' . $row->uuid . '"><i class="fas fa-edit"></i></button>
            <button class="btn btn-rounded btn-sm btn-danger text-white delete-button" title="Hapus Data" data-uuid="' . $row->uuid . '" data-token="' . csrf_token() . '"><i class="fas fa-trash-alt"></i></button>';
            return $actionBtn;
        })->make(true);
    }
}
