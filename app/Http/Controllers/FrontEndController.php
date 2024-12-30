<?php

namespace App\Http\Controllers;

use App\Models\Home;
use App\Models\Post;
use App\Models\PPDB;
use App\Models\Siswa;
use App\Models\Lokasi;
use App\Models\Profil;
use App\Models\Sampul;
use App\Models\Sarana;
use App\Models\Sosmed;
use App\Models\Gallery;
use App\Models\Pegawai;
use App\Models\Category;
use App\Models\Komponen;
use App\Models\Prestasi;
use App\Models\Sambutan;
use App\Models\Fasilitas;
use App\Models\Kurikulum;
use App\Models\JenisMapel;
use App\Models\Information;
use App\Models\TahunAjaran;
use App\Models\Kepemimpinan;
use Illuminate\Http\Request;
use App\Models\IntegrityZone;
use Illuminate\Support\Facades\DB;

class FrontEndController extends Controller
{
    public $post;
    public function __construct()
    {
        $this->post = new Post();
    }
    public function index()
    {
        $data = [
            'pesan' => Pegawai::latest()->get()
        ];
        return view('front-end.index', $data);
    }

    public function sarana()
    {
        $data = [
            'sub_judul' => 'Sarana dan Prasarana',
            'fasilitas' => Fasilitas::all()
        ];
        $sampul = Sampul::first();
        if ($sampul && $sampul->sarana != null) {
            $data['sampul'] = $sampul->sarana;
        }
        return view("front-end.sarana", $data);
    }

    public function humas()
    {
        $data = [
            'sub_judul' => 'Humas',
        ];
        $sosmed = Sosmed::first();
        if ($sosmed) {
            $data['sosmed'] = $sosmed;
        }
        $sampul = Sampul::first();
        if ($sampul && $sampul->humas != null) {
            $data['sampul'] = $sampul->humas;
        }
        return view("front-end.humas", $data);
    }

    public function profil()
    {
        $home = Home::first();
        $profil = Profil::first();
        $sambutan = Sambutan::first();
        $informasi = Information::first();
        $sarana = Sarana::first();
        $komponen = Komponen::all();
        $kepemimpinan = Kepemimpinan::all();
        $lokasi = Lokasi::first();
        $sampul = Sampul::first();
        $tahun = TahunAjaran::where('status', 1)->first();
        $data = [
            'sub_judul' => 'Profil'
        ];
        if ($sampul && $sampul->profil != null) {
            $data['sampul'] = $sampul->profil;
        }
        if ($tahun) {
            $data['tahun'] = $tahun->tahun_awal . ' - ' . $tahun->tahun_akhir;
        }
        if ($home) {
            $data['home'] = $home;
        }
        if ($profil) {
            $data['visi'] = $profil->visi;
            $data['misi'] = $profil->misi;
            $data['tujuan'] = $profil->tujuan;
            $data['strategi'] = $profil->strategi;
            $data['photo'] = $profil->photo;
        }
        if ($sambutan) {
            $data['sambutan'] = $sambutan->sambutan;
            $data['sejarah'] = $sambutan->sejarah;
        }
        if ($informasi) {
            $data['informasi'] = $informasi;
        }
        if ($sarana) {
            $fasilitas = Fasilitas::where('fasilitas_uuid', $sarana->fasilitas_uuid)->get();
            $data['sarana'] = $sarana;
            $data['fasilitas'] = $fasilitas;
        }
        if (count($komponen) > 0) {
            $data['komponen'] = $komponen;
        }
        if (count($kepemimpinan) > 0) {
            $data['kepemimpinan'] = $kepemimpinan;
        }
        if ($lokasi) {
            $data['lokasi'] = $lokasi->lokasi;
        }
        return view('front-end.profil', $data);
    }

    public function gallery()
    {
        $gallery = Gallery::latest()->paginate(20);
        $data = [
            'sub_judul' => 'Gallery'
        ];
        $sampul = Sampul::first();
        if ($sampul && $sampul->gallery != null) {
            $data['sampul'] = $sampul->gallery;
        }
        if (count($gallery) > 0) {
            $data['gallery'] = $gallery;
        }
        return view('front-end.gallery', $data);
    }

    public function guru_staff()
    {
        $guru = Pegawai::where('is_guru', 1)->get();
        $staff = Pegawai::where('is_guru', 0)->get();
        $data = [
            'sub_judul' => 'Guru & Staff'
        ];
        $sampul = Sampul::first();
        if ($sampul && $sampul->guru != null) {
            $data['sampul'] = $sampul->guru;
        }
        if (count($guru) > 0) {
            $data['guru'] = $guru;
        }
        if (count($staff) > 0) {
            $data['staff'] = $staff;
        }
        return view('front-end.guru', $data);
    }

    public function kurikulum()
    {
        $data = [
            'sub_judul' => 'Kurikulum'
        ];
        $sampul = Sampul::first();
        if ($sampul && $sampul->kurikulum != null) {
            $data['sampul'] = $sampul->kurikulum;
        }
        $kurikulum = Kurikulum::all();
        if (count($kurikulum) > 0) {
            $data['kurikulum'] = $kurikulum;
        }
        return view('front-end.kurikulum', $data);
    }

    public function siswa()
    {
        $tahun_ajaran = TahunAjaran::orderBy('tahun_awal', 'desc')->get();
        $data = [
            'sub_judul' => 'Peserta Didik',
            'tahun_ajaran' => $tahun_ajaran
        ];
        $sampul = Sampul::first();
        if ($sampul && $sampul->siswa != null) {
            $data['sampul'] = $sampul->siswa;
        }
        return view('front-end.siswa', $data);
    }

    public function prestasi()
    {
        $prestasi_lembaga = Prestasi::where('jenis_prestasi', 'Lembaga')->get();
        $prestasi_pendidik = Prestasi::where('jenis_prestasi', 'Pendidik & Kependidikan')->get();
        $prestasi_pendidikan = Prestasi::where('jenis_prestasi', 'Akademik Peserta Didik')->get();
        $prestasi_no_pendidikan = Prestasi::where('jenis_prestasi', 'Non Akademik Peserta Didik')->get();
        $data = [
            'sub_judul' => 'Prestasi'
        ];
        $sampul = Sampul::first();
        if ($sampul && $sampul->prestasi != null) {
            $data['sampul'] = $sampul->prestasi;
        }
        if (count($prestasi_lembaga) > 0) {
            $data['prestasi_lembaga'] = $prestasi_lembaga;
        }
        if (count($prestasi_pendidik) > 0) {
            $data['prestasi_pendidik'] = $prestasi_pendidik;
        }
        if (count($prestasi_pendidikan) > 0) {
            $data['prestasi_pendidikan'] = $prestasi_pendidikan;
        }
        if (count($prestasi_no_pendidikan) > 0) {
            $data['prestasi_no_pendidikan'] = $prestasi_no_pendidikan;
        }
        return view('front-end.prestasi', $data);
    }

    public function ppdb()
    {
        $ppdb = PPDB::all();
        $data = [
            'sub_judul' => 'PPDB'
        ];
        $sampul = Sampul::first();
        if ($sampul && $sampul->ppdb != null) {
            $data['sampul'] = $sampul->ppdb;
        }
        if ($sampul && $sampul->link_ppdb != null) {
            $data['sampul_link'] = $sampul->link_ppdb;
        }
        if ($sampul && $sampul->link_ppdb_bawah != null) {
            $data['sampul_link_bawah'] = $sampul->link_ppdb_bawah;
        }
        if (count($ppdb) > 0) {
            $data['ppdb'] = $ppdb;
        }
        $sosmed = Sosmed::first();
        if ($sosmed) {
            $data['sosmed'] = $sosmed->ppdb;
            $data['ulang'] = $sosmed->ulang;
        }
        return view('front-end.ppdb', $data);
    }

    public function news()
    {
        $posts = DB::table('posts as a')
            ->join('categories as b', 'a.category_id', '=', 'b.id')
            ->select('a.*', 'b.name', 'b.uuid')
            ->where('b.name', '!=', 'Zona Integrasi')
            ->orderBy('id', 'desc');
        $judul = 'ALL POST';
        $count = count(DB::table('posts as a')
            ->join('categories as b', 'a.category_id', '=', 'b.id')
            ->select('a.*', 'b.name', 'b.uuid')
            ->where('b.name', '!=', 'Zona Integrasi')->get());
        if (request('search')) {
            $posts->where('title', 'like', '%' . request('search') . '%');
            $judul = 'HASIL PENCARIAN';
            $count = count($posts->get());
        }
        if (request('category')) {
            $posts->where('b.uuid', '=', request('category'));
            $category = Category::where('uuid', request('category'))->first();
            $postsc = Post::where('category_id', $category->id)->get();
            if ($category) {
                $judul = 'POSTINGAN ' . strtoupper($category->name);
            } else {
                $judul = 'NEWS';
            }
            $count = count($postsc);
        }
        $data = [
            'sub_judul' => 'News',
            'posts' => $posts->paginate(6),
            'judul' => $judul,
            'categories' => Category::where('name', '!=', 'Zona Integrasi')->get(),
            'populars' => Post::latest()->filter(['search', 'category'])->limit(3)->get(),
            'halaman' => ceil($count / 6)
        ];
        if (request('page')) {
            $data['page'] = request('page');
        }
        if (request('category')) {
            $data['category'] = $category->uuid;
        }
        if (request('search')) {
            $data['search'] = request('search');
        }
        $sampul = Sampul::first();
        if ($sampul && $sampul->berita != null) {
            $data['sampul'] = $sampul->berita;
        }
        return view('front-end.news', $data);
    }

    public function news_detail(Post $post)
    {
        $data = [
            'sub_judul' => 'News',
            'post' => $post,
            'categories' => Category::where('name', '!=', 'Zona Integrasi')->get(),
            'populars' => Post::latest()->limit(3)->get()
        ];
        $sampul = Sampul::first();
        if ($sampul && $sampul->berita != null) {
            $data['sampul'] = $sampul->berita;
        }
        return view('front-end.news-detail', $data);
    }
    public function layanan(Post $post)
    {
        $data = [
            'sub_judul' => 'Layanan Publik',
        ];
        $sampul = Sampul::first();
        if ($sampul && $sampul->layanan != null) {
            $data['sampul'] = $sampul->layanan;
        }
        return view('front-end.layanan', $data);
    }

    // zona integrasi
    public function zona_integrasi()
    {
        $profil = Profil::first();
        $totalSiswa = Siswa::join('tahun_ajarans', 'siswas.tahun_ajaran_uuid', '=', 'tahun_ajarans.uuid')  // Join tabel tahun_ajaran
            ->where('tahun_ajarans.status', 1)  // Filter untuk status tahun ajaran = 1
            ->select(DB::raw('SUM(siswas.jumlah_lk + siswas.jumlah_pr) as total'))
            ->first();

        $totalRombel = Siswa::join('tahun_ajarans', 'siswas.tahun_ajaran_uuid', '=', 'tahun_ajarans.uuid')  // Join tabel tahun_ajaran
            ->where('tahun_ajarans.status', 1)
            ->count('siswas.id');


        $data = [
            'sub_judul' => 'Zona Integritas',
            'integritys' => IntegrityZone::where('status', 0)->get(),
            'integrity' => IntegrityZone::where('status', 1)->first(),
            'siswa' => $totalSiswa->total,
            'guru' => Pegawai::where('is_guru', 1)->count('id'),
            'rombel' => $totalRombel,
            'tahun_ajaran' => TahunAjaran::where('status', 1)->first(),
        ];
        if ($profil) {
            $data['visi'] = $profil->visi;
            $data['misi'] = $profil->misi;
            $data['tujuan'] = $profil->tujuan;
            $data['strategi'] = $profil->strategi;
            $data['photo'] = $profil->photo;
        }
        $sampul = Sampul::first();
        if ($sampul && $sampul->integrity != null) {
            $data['sampul'] = $sampul->integrity;
        }
        $home = Home::first();
        if ($home) {
            $data['home'] = $home;
        }
        return view('front-end.zona-integritas', $data);
    }

    // public function integrasi_detail(Post $post)
    // {
    //     $data = [
    //         'sub_judul' => 'Zona Integritas',
    //         'post' => $post,
    //         'categories' => Category::where('name', '=', 'Zona Integrasi')->get(),
    //         'populars' => Post::latest()->limit(3)->get()
    //     ];
    //     $sampul = Sampul::first();
    //     if ($sampul && $sampul->berita != null) {
    //         $data['sampul'] = $sampul->berita;
    //     }
    //     return view('front-end.zona-integritas-detail', $data);
    // }
}
