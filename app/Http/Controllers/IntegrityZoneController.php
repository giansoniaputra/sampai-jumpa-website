<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\IntegrityZone;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class IntegrityZoneController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Zona Integritas'
        ];
        // $this->authorize('admin');
        return view('admin.integrity-zone.index', $data);
    }

    public function store(Request $request)
    {
        $rules = [
            'title' => 'required',
            'deskripsi' => 'required',
            'file' => 'required',
            'icon' => 'required|file|image|max:2048',
        ];
        $pesan = [
            'title.required' => 'Judul tidak boleh kosong!',
            'deskripsi.required' => 'Deskripsi tidak boleh kosong!',
            'file.required' => 'Link tidak boleh kosong!',
            'icon.required' => 'Icon tidak boleh kosong!',
            'icon.image' => 'Icon tidak boleh kosong!',
            'icon.max' => 'ukuran maximal adal 2MB!'
        ];
        $validator = Validator::make($request->all(), $rules, $pesan);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()])->setStatusCode(400);
        } else {
            $integrity = new IntegrityZone($request->all());
            $integrity->uuid = Str::orderedUuid();
            $integrity->icon = $request->file('icon')->store('icon-integrity');
            $cek = IntegrityZone::where('status', 1)->first();
            if (!$cek) {
                $integrity->status = 1;
            } else {
                $integrity->status = 0;
            }
            $integrity->save();
            return response()->json(['success' => 'File Berhasil Di Tambahkan']);
        }
    }

    public function edit(IntegrityZone $integrity_zone)
    {
        return response()->json(['data' => $integrity_zone]);
    }

    public function update(Request $request, IntegrityZone $integrity_zone)
    {
        $rules = [
            'title' => 'required',
            'deskripsi' => 'required',
            'file' => 'required',
        ];
        $pesan = [
            'title.required' => 'Judul tidak boleh kosong!',
            'deskripsi.required' => 'Deskripsi tidak boleh kosong!',
            'file.required' => 'Link tidak boleh kosong!',
        ];
        if ($request->file('icon')) {
            $rules['icon'] = 'file|image|max:2048';
            $pesan['icon.image'] = 'Icon tidak boleh kosong!';
            $pesan['icon.max'] = 'ukuran maximal adal 2MB!';
        }
        $validator = Validator::make($request->all(), $rules, $pesan);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()])->setStatusCode(400);
        } else {
            $integrity_zone->fill($request->all());
            if ($request->file('icon')) {
                Storage::delete($integrity_zone->icon);
                $integrity_zone->icon = $request->file('icon')->store('icon-integrity');
            }
            $integrity_zone->save();
            return response()->json(['success' => 'File Berhasil Di Ubah']);
        }
    }

    public function destroy(IntegrityZone $integrity_zone)
    {
        Storage::delete($integrity_zone->icon);
        IntegrityZone::destroy($integrity_zone->id);
        return response()->json(['success' => 'File Berhasil Di Hapus']);
    }

    public function dataTables(Request $request)
    {
        $query = IntegrityZone::orderBy('status', 'desc')->get();
        return DataTables::of($query)->addColumn('action', function ($row) {
            $actionBtn =
                '
    <div class="d-flex justify-content-center">
    <button class="btn btn-rounded btn-sm btn-warning text-dark edit-button" title="Edit Data" data-uuid="' . $row->uuid . '"><i class="fas fa-edit"></i></button>
    <button class="btn btn-rounded btn-sm btn-danger text-white delete-button" title="Hapus Data" data-uuid="' . $row->uuid . '" data-token="' . csrf_token() . '"><i class="fas fa-trash-alt"></i></button>
    </div>';
            return $actionBtn;
        })->make(true);
    }

    public function ubah_status(IntegrityZone $integrity_zone)
    {
        IntegrityZone::where('status', 1)->update(['status' => 0]);
        IntegrityZone::where('uuid', $integrity_zone->uuid)->update(['status' => 1]);
        return response()->json(['success' => 'Status Berhasil Di Ubah']);
    }
}
