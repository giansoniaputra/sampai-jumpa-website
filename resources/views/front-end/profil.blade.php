@extends('front-end.layouts.main')
@section('container')
<section id="visi-misi">
    <div class="container">
        <div class="row landing-image-text">
            <div class="col-sm-6">
                @if(isset($visi))
                <h2 class="font-alt">Visi</h2>
                <?= $visi; ?>
                <h2 class="font-alt">Misi</h2>
                <?= $misi; ?>
                @else
                <h2 class="font-alt">Visi</h2>
                <ul>
                    <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod</li>
                    <li>Quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</li>
                    <li>Duis aute irure dolor in reprehenderit in voluptate velit esse</li>
                    <li>Proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</li>
                </ul>
                <h2 class="font-alt">Misi</h2>
                <ul>
                    <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod</li>
                    <li>Quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</li>
                    <li>Duis aute irure dolor in reprehenderit in voluptate velit esse</li>
                    <li>Proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</li>
                </ul>
                @endif
            </div>
            @if(isset($visi))
            <div class="col-sm-6"><img class="center-block" src="/storage/{{ $photo }}" alt=""></div>
            @else
            <div class="col-sm-6"><img class="center-block" src="https://source.unsplash.com/random/700x700/?leader" alt=""></div>
            @endif
        </div>
    </div>
</section>
<section id="tujuan">
    <div class="container">
        <div class="row landing-image-text">
            <div class="col-sm-6 col-sm-offset-3">

            </div>
            <div class="col-sm-12" id="strategi">
                @if(isset($tujuan) && $tujuan != null)
                <h2 class="font-alt">Tujuan</h2>
                <?= $tujuan; ?>
                <h2 class="font-alt">Strategi</h2>
                <?= $strategi; ?>
                @else
                <h2 class="font-alt">Tujuan</h2>
                <ol>
                    <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod</li>
                    <li>Quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</li>
                    <li>Duis aute irure dolor in reprehenderit in voluptate velit esse</li>
                    <li>Proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</li>
                </ol>
                <h2 class="font-alt" id="strategi">Strategi</h2>
                <ol>
                    <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod</li>
                    <li>Quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</li>
                    <li>Duis aute irure dolor in reprehenderit in voluptate velit esse</li>
                    <li>Proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</li>
                </ol>
                @endif
            </div>
        </div>
    </div>
</section>

{{-- <section>
    <div class="container">
        <div class="row multi-columns-row">
            <div class="col-sm-6 col-sm-offset-3" style="display: flex; align-items: center; flex-direction: column">
                <h2 class="module-title font-alt">Sambutan kepala madrasah</h2>
                <img src="{{ (isset($home)) ? "/storage/$home->photo": "/assets/img/user.png" }}" style="width: 300px; height:300px;" alt="">
</div>
</div>
<div class="col-sm-12">
    <h2 class="font-alt">Selamat datang di Man 2 Kota Tasikmalaya</h2>
    @if(isset($sambutan))
    <p></p>
    @else
    <p>
        Silahkan Input Sambutan
    </p>
    @endif
</div>
</div>
</section> --}}
<section id="sejarah">
    <div class="container">
        <div class="col-sm-12">
            <h2 class="font-alt" id="sejarah" style="margin-left:-21px">Sejarah</h2>
            @if(isset($sejarah))
            <span><?= $sejarah; ?></span>
            @else
            <p>
                Silahkan Input Sejarah
            </p>
            @endif
        </div>
    </div>
</section>
<section id="informasi">
    <div class="container">
        <div class="row multi-columns-row">
            <div class="col-sm-6 col-sm-offset-3" style="display: flex; align-items: center; flex-direction: column">
                <h2 class="font-alt">Informasi</h2>
            </div>
        </div>
        <div class="col-sm-12">
            <table class="table table-bordered">
                <thead class="bg-light">
                    <tr>
                        <th scope="col">Nama Madrasah</th>
                        @if(isset($informasi))
                        <td scope="col">{{ $informasi->nama_madrasah }}</td>
                        @else
                        <td scope="col"></td>
                        @endif
                    </tr>
                    <tr>
                        <th scope="col">NPSN</th>
                        @if(isset($informasi))
                        <td scope="col">{{ $informasi->npsn }}</td>
                        @else
                        <td scope="col"></td>
                        @endif
                    </tr>
                    <tr>
                        <th scope="col">Nomor Statistik Madrasah (NSM)</th>
                        @if(isset($informasi))
                        <td scope="col">{{ $informasi->nsm }}</td>
                        @else
                        <td scope="col"></td>
                        @endif
                    </tr>
                    <tr>
                        <th scope="col">Alamat</th>
                        @if(isset($informasi))
                        <td scope="col">{{ $informasi->alamat }}</td>
                        @else
                        <td scope="col"></td>
                        @endif
                    </tr>
                    <tr>
                        <th scope="col">Telepon</th>
                        @if(isset($informasi))
                        <td scope="col">{{ $informasi->telepon }}</td>
                        @else
                        <td scope="col"></td>
                        @endif
                    </tr>
                    <tr>
                        <th scope="col">Noomor SK Operational</th>
                        @if(isset($informasi))
                        <td scope="col">{{ $informasi->sk }}</td>
                        @else
                        <td scope="col"></td>
                        @endif
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</section>
<section id="sarana">
    <style>
        th.fasilitas {
            position: relative;
        }

        th.fasilitas:after {
            content: "Fasilitas";
            position: absolute;
            top: 40%;
            left: 40%;
        }

    </style>
    <div class="container">
        <div class="row multi-columns-row">
            <div class="col-sm-6 col-sm-offset-3" style="display: flex; align-items: center; flex-direction: column">
                <h2 class="font-alt">sarana dan prasarana</h2>
            </div>
        </div>
        <div class="col-sm-12">
            <table class="table table-bordered">
                @if(isset($sarana))
                <thead class="bg-light">
                    <tr>
                        <th scope="col">Status Tanah dan Bangunan</th>
                        <td scope="col">{{ $sarana->status }}</td>
                    </tr>
                    <tr>
                        <th scope="col">Luas Tanah</th>
                        <td scope="col">{{ $sarana->luas }}</td>
                    </tr>
                    <tr>
                        <th scope="col">Alamat Lengkap</th>
                        <td scope="col">{{ $sarana->alamat }}</td>
                    </tr>
                    @if(count($fasilitas) > 0)
                    <tr>
                        <th scope="col" rowspan="{{count($fasilitas) + 1}}" class="fasilitas"></th>
                    </tr>
                    @else
                    <tr>
                        <th scope="col">Fasilitas</th>
                    </tr>
                    @endif
                    @foreach($fasilitas as $row)
                    <tr>
                        <td>{{ $row->fasilitas }}</td>
                    </tr>
                    @endforeach
                </thead>
                @else
                <thead class="bg-light">
                    <tr>
                        <th scope="col">Status Tanah dan Bangunan</th>
                        <td scope="col"></td>
                    </tr>
                    <tr>
                        <th scope="col">Luas Tanah</th>
                        <td scope="col"></td>
                    </tr>
                    <tr>
                        <th scope="col">Alamat Lengkap</th>
                        <td scope="col"></td>
                    </tr>
                    <tr>
                        <th scope="col">Fasilitas</th>
                    </tr>
                </thead>
                @endif
            </table>
        </div>
    </div>
</section>
<section id="jabatan">
    <div class="container">
        <div class="row multi-columns-row">
            <div class="col-sm-6 col-sm-offset-3" style="display: flex; align-items: center; flex-direction: column">
                <h2 class="font-alt text-center">STRUKTUR MADRASAH<br> PERIODE {{ (isset($tahun)) ? $tahun : '' }}</h2>
            </div>
        </div>
        <div class="col-sm-12">
            <table class="table table-bordered">
                <thead class="bg-dark">
                    <tr>
                        <th scope="col" class="text-center">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col" class="text-center">Jabatan</th>
                    </tr>
                </thead>
                <tbody class="bg-light">
                    @if(isset($komponen))
                    @foreach($komponen as $row)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $row->nama }}</td>
                        <td class="text-center">{{ $row->jabatan }}</td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td class="text-center" colspan="3">Belum Ada Data!</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</section>
<section>
    <div class="container">
        <div class="row multi-columns-row">
            <div class="col-sm-6 col-sm-offset-3" style="display: flex; align-items: center; flex-direction: column">
                <h2 class="font-alt text-center">KEPALA MADRASAH</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <table class="table table-bordered">
                    <thead class="bg-dark">
                        <tr>
                            <th scope="col" class="text-center">No</th>
                            <th scope="col">Nama</th>
                            <th scope="col" class="text-center">Periode Tugas</th>
                        </tr>
                    </thead>
                    <tbody class="bg-light">
                        @if(isset($kepemimpinan))
                        @foreach($kepemimpinan as $row)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $row->nama }}</td>
                            <td class="text-center">{{ $row->tahun_awal }} - {{ $row->tahun_akhir }}</td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td class="text-center" colspan="3">Belum Ada Data!</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<section id="lokasi">
    <div class="container">
        <div class="row" style="margin-top:50px">
            <div class="col-sm-6 col-sm-offset-3">
                <h2 class="font-alt" style="text-align: center">Lokasi</h2>
            </div>
            <div class="col-sm-12">
                <div class="video-box">
                    @if(isset($lokasi))
                    <?= $lokasi; ?>
                    @else
                    <h4>Belum Ada Lokasi!</h4>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
