<?php

namespace App\Http\Controllers;

use App\Models\Sarana;
use App\Models\Fasilitas;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class SaranaController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Sarana dan Prasarana'
        ];
        return view('admin.sarana.index', $data);
    }

    public function dataTables(Request $request)
    {
        $query = Sarana::all();
        return DataTables::of($query)->make(true);
    }

    public function dataTablesFasilitas(Request $request)
    {
        $query = Fasilitas::where('fasilitas_uuid', $request->fasilitas_uuid)->get();
        return DataTables::of($query)->addColumn('action', function ($row) {
            $actionBtn =
                '
    <button class="btn btn-rounded btn-sm btn-info text-white photo-button" title="Photo Fasilitas" data-fasilitas="' . $row->fasilitas . '" data-uuid="' . $row->uuid . '"><i class="fas fa-image"></i></button>
    <button class="btn btn-rounded btn-sm btn-warning text-dark edit-button" title="Edit Data" data-fasilitas="' . $row->fasilitas . '" data-uuid="' . $row->uuid . '"><i class="fas fa-edit"></i></button>
    <button class="btn btn-rounded btn-sm btn-danger text-white delete-button" title="Hapus Data" data-uuid="' . $row->uuid . '" data-token="' . csrf_token() . '"><i class="fas fa-trash-alt"></i></button>';
            return $actionBtn;
        })->make(true);
    }

    public function store_photo(Fasilitas $fasilitas, Request $request)
    {
        $rules = [
            'photo' => 'required|image|max:5500',
        ];
        $pesan = [
            'photo.required' => 'Photo tidak boleh kosong!',
            'photo.image' => 'Photo tidak valid!',
            'photo.max' => 'Ukuran Photo max 5MB!',
        ];
        $validator = Validator::make($request->all(), $rules, $pesan);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        } else {
            $data = [
                'photo' => $request->file('photo')->store('photo-fasilitas')
            ];
            if ($fasilitas->photo != null) {
                Storage::delete($fasilitas->photo);
            }
            Fasilitas::where('uuid', $fasilitas->uuid)->update($data);
            return response()->json(['success' => "Gambar Berhasil Diupload"]);
        }
    }

    public function render_sarana()
    {
        $sarana = Sarana::first();
        if ($sarana) {
            return response()->json(['data' => $sarana]);
        } else {
            return response()->json(['kosong' => '']);
        }
    }


    public function update(Request $request)
    {
        $sarana = Sarana::first();
        if ($sarana) {
            $rules = [
                'status' => 'required',
                'luas' => 'required',
                'alamat' => 'required',
            ];
            $pesan = [
                'status.required' => 'Tidak boleh kosong!',
                'luas.required' => 'Tidak boleh kosong!',
                'alamat.required' => 'Tidak boleh kosong!',
            ];
            $validator = Validator::make($request->all(), $rules, $pesan);
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()])->setStatusCode(400);
            } else {
                $data = $request->all();
                unset($data['_token']);
                unset($data['current_uuid']);
                Sarana::where('uuid', $sarana->uuid)->update($data);
                return response()->json(['success' => 'Data Sarana dan Prasarana Berhasil Diupdate!']);
            }
        } else {
            $rules = [
                'status' => 'required',
                'luas' => 'required',
                'alamat' => 'required',
            ];
            $pesan = [
                'status.required' => 'Tidak boleh kosong!',
                'luas.required' => 'Tidak boleh kosong!',
                'alamat.required' => 'Tidak boleh kosong!',
            ];
            $validator = Validator::make($request->all(), $rules, $pesan);
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()])->setStatusCode(400);
            } else {
                $data = $request->all();
                $data['uuid'] = Str::orderedUuid();
                $data['fasilitas_uuid'] = Str::orderedUuid();
                unset($data['_token']);
                Sarana::create($data);
                return response()->json(['success' => 'Data Sarana dan Prasarana Berhasil Diupdate!']);
            }
        }
    }
    public function render_photo_fasilitas(Fasilitas $fasilitas)
    {
        $data = Fasilitas::where('uuid', $fasilitas->uuid)->first();
        return response()->json(['data' => $data]);
    }

    public function add_fasilitas(Request $request)
    {
        $data = [
            'uuid' => Str::orderedUuid(),
            'fasilitas_uuid' => $request->current_uuid_fasilitas,
            'fasilitas' => $request->fasilitas,
        ];

        Fasilitas::create($data);
        return response()->json(['success' => 'Fasilitas Berhasil Ditambahkan']);
    }

    public function delete_fasilitas(Fasilitas $fasilitas)
    {
        Fasilitas::destroy($fasilitas->id);
        return response()->json(['success' => 'Fasilitas Berhasil Dihapus']);
    }

    public function update_fasilitas(Fasilitas $fasilitas, Request $request)
    {
        Fasilitas::where('uuid', $fasilitas->uuid)->update(['fasilitas' => $request->fasilitas]);
        return response()->json(['success' => 'Fasilitas Berhasil Diubah']);
    }
}
