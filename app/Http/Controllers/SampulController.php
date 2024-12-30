<?php

namespace App\Http\Controllers;

use App\Models\Sampul;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SampulController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("admin.sampul.index", [
            'title' => 'Sampul Halaman'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }


    public function store_home(Request $request)
    {
        $rules = [
            'photo_home' => 'image|max:5500',
        ];
        $pesan = [
            'photo_home.image' => 'Photo tidak valid!',
            'photo_home.max' => 'Ukuran Photo max 5MB!',
        ];
        $validator = Validator::make($request->all(), $rules, $pesan);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()])->setStatusCode(400);
        } else {
            $cek = Sampul::first();
            if ($cek) {
                $data = [
                    'home' => $request->file('photo_home')->store('sampul')
                ];
                if ($cek->home != null) {
                    Storage::delete($cek->home);
                }
                Sampul::where('uuid', $cek->uuid)->update($data);
                return response()->json(['success' => 'Sampul Berhasil Diupdate']);
            } else {
                $data = [
                    'uuid' => Str::orderedUuid(),
                    'home' => $request->file('photo_home')->store('sampul')
                ];
                Sampul::create($data);
                return response()->json(['success' => 'Sampul Berhasil Diupdate']);
            }
        }
    }

    public function store_gallery(Request $request)
    {
        $rules = [
            'photo_gallery' => 'image|max:5500',
        ];
        $pesan = [
            'photo_gallery.image' => 'Photo tidak valid!',
            'photo_gallery.max' => 'Ukuran Photo max 5MB!',
        ];
        $validator = Validator::make($request->all(), $rules, $pesan);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()])->setStatusCode(400);
        } else {
            $cek = Sampul::first();
            if ($cek) {
                $data = [
                    'gallery' => $request->file('photo_gallery')->store('sampul')
                ];
                if ($cek->gallery != null) {
                    Storage::delete($cek->gallery);
                }
                Sampul::where('uuid', $cek->uuid)->update($data);
                return response()->json(['success' => 'Sampul Berhasil Diupdate']);
            } else {
                $data = [
                    'uuid' => Str::orderedUuid(),
                    'gallery' => $request->file('photo_gallery')->store('sampul')
                ];
                Sampul::create($data);
                return response()->json(['success' => 'Sampul Berhasil Diupdate']);
            }
        }
    }

    public function store_profil(Request $request)
    {
        $rules = [
            'photo_profil' => 'image|max:5500',
        ];
        $pesan = [
            'photo_profil.image' => 'Photo tidak valid!',
            'photo_profil.max' => 'Ukuran Photo max 5MB!',
        ];
        $validator = Validator::make($request->all(), $rules, $pesan);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()])->setStatusCode(400);
        } else {

            $cek = Sampul::first();
            if ($cek) {
                if ($cek->profil != null) {
                    Storage::delete($cek->profil);
                }
                $data = [
                    'profil' => $request->file('photo_profil')->store('sampul')
                ];
                Sampul::where('uuid', $cek->uuid)->update($data);
                return response()->json(['success' => 'Sampul Berhasil Diupdate']);
            } else {
                $data = [
                    'uuid' => Str::orderedUuid(),
                    'profil' => $request->file('photo_profil')->store('sampul')
                ];
                Sampul::create($data);
                return response()->json(['success' => 'Sampul Berhasil Diupdate']);
            }
        }
    }

    public function store_guru(Request $request)
    {
        $rules = [
            'photo_guru' => 'image|max:5500',
        ];
        $pesan = [
            'photo_guru.image' => 'Photo tidak valid!',
            'photo_guru.max' => 'Ukuran Photo max 5MB!',
        ];
        $validator = Validator::make($request->all(), $rules, $pesan);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()])->setStatusCode(400);
        } else {
            $cek = Sampul::first();
            if ($cek) {
                $data = [
                    'guru' => $request->file('photo_guru')->store('sampul')
                ];
                if ($cek->guru != null) {
                    Storage::delete($cek->guru);
                }
                Sampul::where('uuid', $cek->uuid)->update($data);
                return response()->json(['success' => 'Sampul Berhasil Diupdate']);
            } else {
                $data = [
                    'uuid' => Str::orderedUuid(),
                    'guru' => $request->file('photo_guru')->store('sampul')
                ];
                Sampul::create($data);
                return response()->json(['success' => 'Sampul Berhasil Diupdate']);
            }
        }
    }
    public function store_kurikulum(Request $request)
    {
        $rules = [
            'photo_kurikulum' => 'image|max:5500',
        ];
        $pesan = [
            'photo_kurikulum.image' => 'Photo tidak valid!',
            'photo_kurikulum.max' => 'Ukuran Photo max 5MB!',
        ];
        $validator = Validator::make($request->all(), $rules, $pesan);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()])->setStatusCode(400);
        } else {
            $cek = Sampul::first();
            if ($cek) {
                $data = [
                    'kurikulum' => $request->file('photo_kurikulum')->store('sampul')
                ];
                if ($cek->kurikulum != null) {
                    Storage::delete($cek->kurikulum);
                }
                Sampul::where('uuid', $cek->uuid)->update($data);
                return response()->json(['success' => 'Sampul Berhasil Diupdate']);
            } else {
                $data = [
                    'uuid' => Str::orderedUuid(),
                    'kurikulum' => $request->file('photo_kurikulum')->store('sampul')
                ];
                Sampul::create($data);
                return response()->json(['success' => 'Sampul Berhasil Diupdate']);
            }
        }
    }
    public function store_siswa(Request $request)
    {
        $rules = [
            'photo_siswa' => 'image|max:5500',
        ];
        $pesan = [
            'photo_siswa.image' => 'Photo tidak valid!',
            'photo_siswa.max' => 'Ukuran Photo max 5MB!',
        ];
        $validator = Validator::make($request->all(), $rules, $pesan);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()])->setStatusCode(400);
        } else {

            $cek = Sampul::first();
            if ($cek) {
                $data = [
                    'siswa' => $request->file('photo_siswa')->store('sampul')
                ];
                if ($cek->siswa != null) {
                    Storage::delete($cek->siswa);
                }
                Sampul::where('uuid', $cek->uuid)->update($data);
                return response()->json(['success' => 'Sampul Berhasil Diupdate']);
            } else {
                $data = [
                    'uuid' => Str::orderedUuid(),
                    'siswa' => $request->file('photo_siswa')->store('sampul')
                ];
                Sampul::create($data);
                return response()->json(['success' => 'Sampul Berhasil Diupdate']);
            }
        }
    }
    public function store_prestasi(Request $request)
    {
        $rules = [
            'photo_prestasi' => 'image|max:5500',
        ];
        $pesan = [
            'photo_prestasi.image' => 'Photo tidak valid!',
            'photo_prestasi.max' => 'Ukuran Photo max 5MB!',
        ];
        $validator = Validator::make($request->all(), $rules, $pesan);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()])->setStatusCode(400);
        } else {
            $cek = Sampul::first();
            if ($cek) {
                $data = [
                    'prestasi' => $request->file('photo_prestasi')->store('sampul')
                ];
                if ($cek->prestasi != null) {
                    Storage::delete($cek->prestasi);
                }
                Sampul::where('uuid', $cek->uuid)->update($data);
                return response()->json(['success' => 'Sampul Berhasil Diupdate']);
            } else {
                $data = [
                    'uuid' => Str::orderedUuid(),
                    'prestasi' => $request->file('photo_prestasi')->store('sampul')
                ];
                Sampul::create($data);
                return response()->json(['success' => 'Sampul Berhasil Diupdate']);
            }
        }
    }
    public function store_ppdb(Request $request)
    {
        $rules = [
            'photo_ppdb' => 'image|max:5500',
        ];
        $pesan = [
            'photo_ppdb.image' => 'Photo tidak valid!',
            'photo_ppdb.max' => 'Ukuran Photo max 5MB!',
        ];
        $validator = Validator::make($request->all(), $rules, $pesan);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()])->setStatusCode(400);
        } else {

            $cek = Sampul::first();
            if ($cek) {
                $data = [
                    'ppdb' => $request->file('photo_ppdb')->store('sampul')
                ];
                if ($cek->ppdb != null) {
                    Storage::delete($cek->ppdb);
                }
                Sampul::where('uuid', $cek->uuid)->update($data);
                return response()->json(['success' => 'Sampul Berhasil Diupdate']);
            } else {
                $data = [
                    'uuid' => Str::orderedUuid(),
                    'ppdb' => $request->file('photo_ppdb')->store('sampul')
                ];
                Sampul::create($data);
                return response()->json(['success' => 'Sampul Berhasil Diupdate']);
            }
        }
    }
    public function store_link_bawah(Request $request)
    {
        $rules = [
            'link_ppdb_bawah' => 'required|image|max:5500',
        ];
        $pesan = [
            'link_ppdb_bawah.image' => 'Photo tidak valid!',
            'link_ppdb_bawah.max' => 'Ukuran Photo max 5MB!',
        ];
        $validator = Validator::make($request->all(), $rules, $pesan);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()])->setStatusCode(400);
        } else {

            $cek = Sampul::first();
            if ($cek) {
                $data = [
                    'link_ppdb_bawah' => $request->file('link_ppdb_bawah')->store('sampul')
                ];
                if ($cek->link_ppdb_bawah != null) {
                    Storage::delete($cek->link_ppdb_bawah);
                }
                Sampul::where('uuid', $cek->uuid)->update($data);
                return response()->json(['success' => 'Sampul Berhasil Diupdate']);
            } else {
                $data = [
                    'uuid' => Str::orderedUuid(),
                    'link_ppdb_bawah' => $request->file('link_ppdb_bawah')->store('sampul')
                ];
                Sampul::create($data);
                return response()->json(['success' => 'Sampul Berhasil Diupdate']);
            }
        }
    }
    public function store_link(Request $request)
    {
        $rules = [
            'link_ppdb' => 'required|image|max:5500',
        ];
        $pesan = [
            'link_ppdb.image' => 'Photo tidak valid!',
            'link_ppdb.max' => 'Ukuran Photo max 5MB!',
        ];
        $validator = Validator::make($request->all(), $rules, $pesan);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()])->setStatusCode(400);
        } else {

            $cek = Sampul::first();
            if ($cek) {
                $data = [
                    'link_ppdb' => $request->file('link_ppdb')->store('sampul')
                ];
                if ($cek->link_ppdb != null) {
                    Storage::delete($cek->link_ppdb);
                }
                Sampul::where('uuid', $cek->uuid)->update($data);
                return response()->json(['success' => 'Sampul Berhasil Diupdate']);
            } else {
                $data = [
                    'uuid' => Str::orderedUuid(),
                    'link_ppdb' => $request->file('link_ppdb')->store('sampul')
                ];
                Sampul::create($data);
                return response()->json(['success' => 'Sampul Berhasil Diupdate']);
            }
        }
    }
    public function store_berita(Request $request)
    {
        $rules = [
            'photo_berita' => 'image|max:5500',
        ];
        $pesan = [
            'photo_berita.image' => 'Photo tidak valid!',
            'photo_berita.max' => 'Ukuran Photo max 5MB!',
        ];
        $validator = Validator::make($request->all(), $rules, $pesan);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()])->setStatusCode(400);
        } else {
            $cek = Sampul::first();
            if ($cek) {
                $data = [
                    'berita' => $request->file('photo_berita')->store('sampul')
                ];
                if ($cek->berita != null) {
                    Storage::delete($cek->berita);
                }
                Sampul::where('uuid', $cek->uuid)->update($data);
                return response()->json(['success' => 'Sampul Berhasil Diupdate']);
            } else {
                $data = [
                    'uuid' => Str::orderedUuid(),
                    'berita' => $request->file('photo_berita')->store('sampul')
                ];
                Sampul::create($data);
                return response()->json(['success' => 'Sampul Berhasil Diupdate']);
            }
        }
    }
    public function store_sarana(Request $request)
    {
        $rules = [
            'photo_sarana' => 'image|max:5500',
        ];
        $pesan = [
            'photo_sarana.image' => 'Photo tidak valid!',
            'photo_sarana.max' => 'Ukuran Photo max 5MB!',
        ];
        $validator = Validator::make($request->all(), $rules, $pesan);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()])->setStatusCode(400);
        } else {
            $cek = Sampul::first();
            if ($cek) {
                $data = [
                    'sarana' => $request->file('photo_sarana')->store('sampul')
                ];
                if ($cek->sarana != null) {
                    Storage::delete($cek->sarana);
                }
                Sampul::where('uuid', $cek->uuid)->update($data);
                return response()->json(['success' => 'Sampul Berhasil Diupdate']);
            } else {
                $data = [
                    'uuid' => Str::orderedUuid(),
                    'sarana' => $request->file('photo_sarana')->store('sampul')
                ];
                Sampul::create($data);
                return response()->json(['success' => 'Sampul Berhasil Diupdate']);
            }
        }
    }

    public function store_humas(Request $request)
    {
        $rules = [
            'photo_humas' => 'image|max:5500',
        ];
        $pesan = [
            'photo_humas.image' => 'Photo tidak valid!',
            'photo_humas.max' => 'Ukuran Photo max 5MB!',
        ];
        $validator = Validator::make($request->all(), $rules, $pesan);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()])->setStatusCode(400);
        } else {
            $cek = Sampul::first();
            if ($cek) {
                $data = [
                    'humas' => $request->file('photo_humas')->store('sampul')
                ];
                if ($cek->humas != null) {
                    Storage::delete($cek->humas);
                }
                Sampul::where('uuid', $cek->uuid)->update($data);
                return response()->json(['success' => 'Sampul Berhasil Diupdate']);
            } else {
                $data = [
                    'uuid' => Str::orderedUuid(),
                    'humas' => $request->file('photo_humas')->store('sampul')
                ];
                Sampul::create($data);
                return response()->json(['success' => 'Sampul Berhasil Diupdate']);
            }
        }
    }
    public function store_integrity(Request $request)
    {
        $rules = [
            'photo_integrity' => 'image|max:5500',
        ];
        $pesan = [
            'photo_integrity.image' => 'Photo tidak valid!',
            'photo_integrity.max' => 'Ukuran Photo max 5MB!',
        ];
        $validator = Validator::make($request->all(), $rules, $pesan);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()])->setStatusCode(400);
        } else {
            $cek = Sampul::first();
            if ($cek) {
                $data = [
                    'integrity' => $request->file('photo_integrity')->store('sampul')
                ];
                if ($cek->integrity != null) {
                    Storage::delete($cek->integrity);
                }
                Sampul::where('uuid', $cek->uuid)->update($data);
                return response()->json(['success' => 'Sampul Berhasil Diupdate']);
            } else {
                $data = [
                    'uuid' => Str::orderedUuid(),
                    'integrity' => $request->file('photo_integrity')->store('sampul')
                ];
                Sampul::create($data);
                return response()->json(['success' => 'Sampul Berhasil Diupdate']);
            }
        }
    }
    public function store_layanan(Request $request)
    {
        $rules = [
            'photo_layanan' => 'image|max:5500',
        ];
        $pesan = [
            'photo_layanan.image' => 'Photo tidak valid!',
            'photo_layanan.max' => 'Ukuran Photo max 5MB!',
        ];
        $validator = Validator::make($request->all(), $rules, $pesan);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()])->setStatusCode(400);
        } else {
            $cek = Sampul::first();
            if ($cek) {
                $data = [
                    'layanan' => $request->file('photo_layanan')->store('sampul')
                ];
                if ($cek->layanan != null) {
                    Storage::delete($cek->layanan);
                }
                Sampul::where('uuid', $cek->uuid)->update($data);
                return response()->json(['success' => 'Sampul Berhasil Diupdate']);
            } else {
                $data = [
                    'uuid' => Str::orderedUuid(),
                    'layanan' => $request->file('photo_layanan')->store('sampul')
                ];
                Sampul::create($data);
                return response()->json(['success' => 'Sampul Berhasil Diupdate']);
            }
        }
    }

    public function render_sampul()
    {
        $cek = Sampul::first();
        if ($cek) {
            return response()->json(['data' => $cek]);
        } else {
            return response()->json(['kosong' => '']);
        }
    }

    public function store(Request $request) {}

    /**
     * Display the specified resource.
     */
    public function show(Sampul $sampul)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sampul $sampul)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sampul $sampul)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sampul $sampul)
    {
        //
    }
}
