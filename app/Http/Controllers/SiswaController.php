<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\TahunAjaran;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("admin.siswa.index", [
            'title' => 'Data Peserta Didik',
            'tahun_ajaran' => TahunAjaran::all()
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
            'tahun_ajaran_uuid' => 'required',
            'kelas' => 'required',
            'nama_kelas' => 'required',
            'jumlah_lk' => 'required',
            'jumlah_pr' => 'required',
        ];
        $pesan = [
            'tahun_ajaran_uuid.required' => 'Tahun ajaran tidak boleh kosong!',
            'kelas.required' => 'Kelas tidak boleh kosong!',
            'nama_kelas.required' => 'Nama kelastidak boleh kosong!',
            'jumlah_lk.required' => 'Isi jumlah!',
            'jumlah_pr.required' => 'Isi jumlah!',
        ];
        $validator = Validator::make($request->all(), $rules, $pesan);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()])->setStatusCode(400);
        } else {
            $data = $request->all();
            unset($data['_token']);
            $data['uuid'] = Str::orderedUuid();
            Siswa::create($data);
            return response()->json(['success' => 'Data Siswa Berhasil Ditambahkan!']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Siswa $siswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Siswa $siswa)
    {
        return response()->json(['data' => $siswa]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Siswa $siswa)
    {
        $rules = [
            'tahun_ajaran_uuid' => 'required',
            'kelas' => 'required',
            'nama_kelas' => 'required',
            'jumlah_lk' => 'required',
            'jumlah_pr' => 'required',
        ];
        $pesan = [
            'tahun_ajaran_uuid.required' => 'Tahun ajaran tidak boleh kosong!',
            'kelas.required' => 'Kelas tidak boleh kosong!',
            'nama_kelas.required' => 'Nama kelastidak boleh kosong!',
            'jumlah_lk.required' => 'Isi jumlah!',
            'jumlah_pr.required' => 'Isi jumlah!',
        ];
        $validator = Validator::make($request->all(), $rules, $pesan);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()])->setStatusCode(400);
        } else {
            $data = $request->all();
            unset($data['_method']);
            unset($data['_token']);
            Siswa::where('uuid', $siswa->uuid)->update($data);
            return response()->json(['success' => 'Data Siswa Berhasil Diubah!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Siswa $siswa)
    {
        Siswa::destroy($siswa->id);
        return response()->json(['success' => 'Data Siswa Berhasil Dihapus!']);
    }

    public function dataTables(Request $request)
    {
        $query = DB::table('siswas as a')
            ->join('tahun_ajarans as b', 'a.tahun_ajaran_uuid', '=', 'b.uuid')
            ->select('a.*', 'b.tahun_awal', 'b.tahun_akhir')
            ->where('a.tahun_ajaran_uuid', $request->tahun_ajaran_uuid)
            ->where('a.kelas', $request->kelas)
            ->get();
        // foreach ($query as $row) {
        //     $row->tahun = "$row->tahun_awal - $row->tahun_akhir";
        // }
        return DataTables::of($query)->addColumn('action', function ($row) {
            $actionBtn =
                '
    <button class="btn btn-rounded btn-sm btn-warning text-dark edit-button" title="Edit Data" data-uuid="' . $row->uuid . '"><i class="fas fa-edit"></i></button>
    <button class="btn btn-rounded btn-sm btn-danger text-white delete-button" title="Hapus Data" data-uuid="' . $row->uuid . '" data-token="' . csrf_token() . '"><i class="fas fa-trash-alt"></i></button>';
            return $actionBtn;
        })->make(true);
    }
}
