<?php

use App\Models\Color;
use App\Models\Mapel;
use App\Models\Siswa;
use App\Models\Sosmed;
use App\Models\Comment;
use App\Models\SubMapel;
use App\Models\JenisMapel;
use App\Models\TahunAjaran;

function renderKelas($tahun_ajaran, $kelas)
{
    return Siswa::where('tahun_ajaran_uuid', $tahun_ajaran)->where('kelas', $kelas)->get();
}
function renderMapel($jenis_mapel_uuid, $kurikulum)
{
    return Mapel::where('jenis_mapel_uuid', $jenis_mapel_uuid)->where('kelas', $kurikulum)->get();
}

function distinctMapel($uuid)
{
    $result = Mapel::select('jenis_mapel_uuid', 'jenis_mapels.jenis_mapel', 'mapels.kelas', 'jenis_mapels.jumlah_jam', 'jenis_mapels.jumlah_jam_2')
        ->distinct()
        ->join('jenis_mapels', 'mapels.jenis_mapel_uuid', '=', 'jenis_mapels.uuid')
        ->where('mapels.kelas', $uuid)
        ->get();
    return $result;
}

function renderSubMapel($mapel_uuid)
{
    return SubMapel::where('mapel_uuid', $mapel_uuid)->get();
}

function numberToLetter($number)
{
    // Pastikan nomor berada dalam rentang 1-26
    $number = max(1, min(26, $number));

    // Ubah nomor menjadi huruf dengan ASCII
    return chr(64 + $number);
}
function numberToLetterLower($number)
{
    // Pastikan nomor berada dalam rentang 1-26
    $number = max(1, min(26, $number));

    // Ubah nomor menjadi huruf dengan ASCII
    return strtolower(chr(64 + $number)) . '. ';
}
function tanggal_hari($tanggal, $cetak_hari = false)
{
    $hari = array(
        1 =>    'Senin',
        'Selasa',
        'Rabu',
        'Kamis',
        'Jumat',
        'Sabtu',
        'Minggu'
    );

    $bulan = array(
        1 =>   'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );
    $split       = explode('-', $tanggal);
    $tgl_indo = $split[2] . ' ' . $bulan[(int)$split[1]] . ' ' . $split[0];

    if ($cetak_hari) {
        $num = date('N', strtotime($tanggal));
        return $hari[$num] . ', ' . $tgl_indo;
    }
    return $tgl_indo;
}

function tahun_aktif()
{
    $data = TahunAjaran::where('status', 1)->first();
    return "$data->tahun_awal - $data->tahun_akhir";
}

function data_sosmed()
{
    return Sosmed::first();
}

function commnet_count($post_id)
{
    return Comment::where('post_id', $post_id)->count('id');
}

function color()
{
    $data = Color::first();
    if ($data) {
        return $data->color;
    } else {
        return 'rgb(255, 234, 167)';
    }
}

function getKelasKurikulum($uuid)
{
    return Mapel::where('kelas', $uuid)->get();
}


function kurikulum()
{
    //     <div class="row">
    //     {{-- JIKA KURIKULUM ADA --}}
    //     @if(isset($kurikulum))
    //     @foreach ($kurikulum as $kur)
    //     <h2>{{ $kur->kelas }}</h2>
    //     {{-- JIKA BUkAN KURTILAS --}}
    //     @if($kur->kurikulum == 0)
    //     @php
    //     $jenis_mapels = distinctMapel($kur->uuid);
    //     // dd($jenis_mapels)
    //     @endphp
    //     <table class="table table-bordered">
    //         <thead class="bg-dark">
    //             <tr>
    //                 <th class="text-center" rowspan="2">NO</th>
    //                 <th class="text-center" rowspan="2">Komponen</th>
    //                 <th class="text-center" colspan="2">Pertahun</th>
    //             </tr>
    //             <tr>
    //                 <th class="text-center">Regular</th>
    //                 <th class="text-center">Proyek PPPP</th>
    //             </tr>
    //         </thead>
    //         <tbody class="bg-light">
    //             {{-- JPERULANGAN JENIS MATA PELAJARAN --}}
    //             @foreach ($jenis_mapels as $jenis_mapel)
    //             <tr>
    //                 <td></td>
    //                 <td><b>{{ $jenis_mapel->jenis_mapel }}</b></td>
    //                 <td class="text-center">{{ $jenis_mapel->jumlah_jam }}</td>
    //                 <td class="text-center">{{ $jenis_mapel->jumlah_jam_2 }}</td>
    //             </tr>
    //             @php
    //             $mapels = renderMapel($jenis_mapel->jenis_mapel_uuid, $kur->uuid);
    //             @endphp
    //             {{-- RENDER MAPEL --}}
    //             @foreach($mapels as $mapel)
    //             {{-- JIKA MEMILIKI SUB MATA PELAJARAN --}}
    //             @if($mapel->is_parent == 1)
    //             <tr>
    //                 <td>{{ $loop->iteration }}</td>
    //                 <td>{{ $mapel->nama_mapel }}</td>
    //                 <td class="text-center">{{ $mapel->jumlah_jam }}</td>
    //                 <td class="text-center">{{ $mapel->jumlah_jam_2 }}</td>
    //             </tr>
    //             @php
    //             $subMapel = renderSubMapel($mapel->uuid);
    //             @endphp
    //             {{-- PERILANGAN SUB MAPEL --}}
    //             @foreach($subMapel as $sub)
    //             <tr>
    //                 <td></td>
    //                 <td>{{ numberToLetterLower($loop->iteration) }}{{ $sub->sub_mapel }}</td>
    //                 <td class="text-center">{{ $sub->jumlah_jam }}</td>
    //                 <td class="text-center">{{ $sub->jumlah_jam_2 }}</td>
    //             </tr>
    //             {{--AKHIR PERILANGAN SUB MAPEL --}}
    //             @endforeach
    //             {{-- JIKA TIDAK MEMILIKI SUB MATA PELAJARAN --}}
    //             @else
    //             <tr>
    //                 <td>{{ $loop->iteration }}</td>
    //                 <td>{{ $mapel->nama_mapel }}</td>
    //                 <td class="text-center">{{ $mapel->jumlah_jam }}</td>
    //                 <td class="text-center">{{ $mapel->jumlah_jam_2 }}</td>
    //             </tr>
    //             {{-- AKHIR JIKA MEMILIKI SUB MATA PELAJARAN --}}
    //             @endif
    //             {{--AKHIR RENDER MAPEL --}}
    //             @endforeach
    //             @endforeach
    //             {{-- AKHIR JPERULANGAN JENIS MATA PELAJARAN --}}
    //         </tbody>
    //     </table>
    //     {{-- JIKA KURTILAS --}}
    //     @else
    //     @php
    //     $jenis_mapels = distinctMapel($kur->uuid);
    //     // dd($jenis_mapels)
    //     @endphp
    //     <table class=" table table-bordered">
    //         <thead class="bg-dark">
    //             <tr>
    //                 <th class="text-center" rowspan="2">NO</th>
    //                 <th class="text-center" rowspan="2">Komponen</th>
    //                 <th class="text-center" colspan="2">Alokasi Waktu</th>
    //             </tr>
    //             <tr>
    //                 <th class="text-center">Semester 1</th>
    //                 <th class="text-center">Semester 2</th>
    //             </tr>
    //         </thead>
    //         <tbody class="bg-light">
    //             {{-- JPERULANGAN JENIS MATA PELAJARAN --}}
    //             @foreach ($jenis_mapels as $jenis_mapel)
    //             <tr>
    //                 <td></td>
    //                 <td><b>{{ $jenis_mapel->jenis_mapel }}</b></td>
    //                 <td>{{ $jenis_mapel->jumlah_jam }}</td>
    //                 <td>{{ $jenis_mapel->jumlah_jam_2 }}</td>
    //             </tr>
    //             @php
    //             $mapels = renderMapel($jenis_mapel->jenis_mapel_uuid, $kur->uuid);
    //             @endphp
    //             {{-- RENDER MAPEL --}}
    //             @foreach($mapels as $mapel)
    //             {{-- JIKA MEMILIKI SUB MATA PELAJARAN --}}
    //             @if($mapel->is_parent == 1)
    //             <tr>
    //                 <td>{{ $loop->iteration }}</td>
    //                 <td>{{ $mapel->nama_mapel }}</td>
    //                 <td class="text-center">{{ $mapel->jumlah_jam }}</td>
    //                 <td class="text-center">{{ $mapel->jumlah_jam_2 }}</td>
    //             </tr>
    //             @php
    //             $subMapel = renderSubMapel($mapel->uuid);
    //             @endphp
    //             {{-- PERILANGAN SUB MAPEL --}}
    //             @foreach($subMapel as $sub)
    //             <tr>
    //                 <td></td>
    //                 <td>{{ numberToLetterLower($loop->iteration) }}{{ $sub->sub_mapel }}</td>
    //                 <td class="text-center">{{ $sub->jumlah_jam }}</td>
    //                 <td class="text-center">{{ $sub->jumlah_jam_2 }}</td>
    //             </tr>
    //             {{--AKHIR PERILANGAN SUB MAPEL --}}
    //             @endforeach
    //             {{-- JIKA TIDAK MEMILIKI SUB MATA PELAJARAN --}}
    //             @else
    //             <tr>
    //                 <td>{{ $loop->iteration }}</td>
    //                 <td>{{ $mapel->nama_mapel }}</td>
    //                 <td class="text-center">{{ $mapel->jumlah_jam }}</td>
    //                 <td class="text-center">{{ $mapel->jumlah_jam_2 }}</td>
    //             </tr>
    //             {{-- AKHIR JIKA MEMILIKI SUB MATA PELAJARAN --}}
    //             @endif
    //             {{--AKHIR RENDER MAPEL --}}
    //             @endforeach
    //             @endforeach
    //             {{-- AKHIR JPERULANGAN JENIS MATA PELAJARAN --}}
    //         </tbody>
    //     </table>
    //     {{--JIKA JIKA BUKAN KURTILAS --}}
    //     @endif
    //     @endforeach
    //     {{--JIKA KURIKULUM TIDAK ADA --}}
    //     @else
    //     <tr>
    //         <td colspan="3" class="text-center">Belum Ada Data!</td>
    //     </tr>
    //     {{--AKHIR JIKA KURIKULUM ADA --}}
    //     @endif
    // </div>
}
