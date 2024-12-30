@extends('front-end.layouts.main')
@section('container')
<section class="module" id="news">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
                <h2 class="module-title font-alt"><u>EVIDENCE ZONA INTEGRITAS</u></h2>
            </div>
        </div>
        @if (isset($integrity))
        <div class="row" style="display: flex;justify-content: center">
            <div class="card mb-3 border-rounded" style="margin-bottom:50px;max-width: 540px; background-color: rgba(255, 255, 255, 0.5) !important">
                <div class="row g-0">
                    <div class="col-md-4">
                        <a href="{{ $integrity->file }}" target="_blank"><img src="/storage/{{ $integrity->icon }}" class="img-fluid rounded-start" style="margin: 5px;width: 150px; height: 150px; object-fit: cover;" alt="..."></a>
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h3 class="card-title"><a href="{{ $integrity->file }}" target="_blank">{{ $integrity->title }}</a></h3>
                            <p class="card-text">{{ $integrity->deskripsi }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        <div class="row multi-columns-row post-columns g-4">
            @foreach ($integritys as $integrity2)
            <div class="col-sm-4">
                <div class="card border-rounded" style="max-width: 540px; margin-bottom: 25px; background-color: rgba(255, 255, 255, 0.5) !important">
                    <div class="row g-0" style="display: flex;justify-content: center; align-items: center">
                        <div class="col-md-4">
                            <a href="{{ $integrity2->file }}" target="_blank"><img src="/storage/{{ $integrity2->icon }}" class="img-fluid rounded" style="margin-left: 10px; width: 100px; height: 100px; object-fit: cover;" alt="..."></a>
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h3 class="card-title"><a href="{{ $integrity2->file }}" target="_blank">{{ $integrity2->title }}</a></h3>
                                <p class="card-text">{{ $integrity2->deskripsi }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<section style="background-color: white;">
    <div class="conteiner">
        <div class="row">
            <div class="col-sm-12">
                <img class="center-block"  src="/storage/{{ $home->profile }}" alt="">
            </div>
        </div>
    </div>
    {{-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
        <path fill="#FFEAA7" fill-opacity="1" d="M0,160L40,186.7C80,213,160,267,240,266.7C320,267,400,213,480,202.7C560,192,640,224,720,245.3C800,267,880,277,960,250.7C1040,224,1120,160,1200,149.3C1280,139,1360,181,1400,202.7L1440,224L1440,320L1400,320C1360,320,1280,320,1200,320C1120,320,1040,320,960,320C880,320,800,320,720,320C640,320,560,320,480,320C400,320,320,320,240,320C160,320,80,320,40,320L0,320Z"></path>
    </svg> --}}
</section>
<section id="visi-misi" style="margin-top:100px">
    <div class="container">
        <div class="row" style="background-color: rgba(255, 255, 255, 0.5) !important">
            <div class="col-sm-6">
                @if(isset($visi))
                <h2 class="font-alt">Visi</h2>
                <?= $visi; ?>
                @else
                <h2 class="font-alt">Visi</h2>
                <ul>
                    <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod</li>
                    <li>Quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</li>
                    <li>Duis aute irure dolor in reprehenderit in voluptate velit esse</li>
                    <li>Proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</li>
                </ul>
                @endif
            </div>
            <div class="col-sm-6">
                @if(isset($visi))
                <h2 class="font-alt">Misi</h2>
                <?= $misi; ?>
                @else
                <h2 class="font-alt">Misi</h2>
                <ul>
                    <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod</li>
                    <li>Quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</li>
                    <li>Duis aute irure dolor in reprehenderit in voluptate velit esse</li>
                    <li>Proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</li>
                </ul>
                @endif
            </div>
        </div>
    </div>
</section>
<section style="margin-top:100px">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h2 class="module-title "><u class="font-alt">DATA STATISTIK</u> <br> Berikut Data Statistik Tahun Pelajaran {{ $tahun_ajaran->tahun_awal }} / {{ $tahun_ajaran->tahun_akhir }}</h2>
                <h4 class="module-title"></h4>
            </div>
        </div>
        <div class="row" style="display: flex; justify-content: center;">
            <div class="col-sm-4" style="display: flex; justify-content: center">
                <div class="card" style=" display: flex; align-items: center; flex-direction: column; padding-top: 10px;background-color: rgba(255, 255, 255, 0.5) !important">
                    <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="currentColor" class="bi bi-backpack-fill" viewBox="0 0 16 16">
                        <path d="M5 13v-3h4v.5a.5.5 0 0 0 1 0V10h1v3z"/>
                        <path d="M6 2v.341C3.67 3.165 2 5.388 2 8v5.5A2.5 2.5 0 0 0 4.5 16h7a2.5 2.5 0 0 0 2.5-2.5V8a6 6 0 0 0-4-5.659V2a2 2 0 1 0-4 0m2-1a1 1 0 0 1 1 1v.083a6 6 0 0 0-2 0V2a1 1 0 0 1 1-1m0 3a4 4 0 0 1 3.96 3.43.5.5 0 1 1-.99.14 3 3 0 0 0-5.94 0 .5.5 0 1 1-.99-.14A4 4 0 0 1 8 4M4.5 9h7a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5v-4a.5.5 0 0 1 .5-.5"/>
                      </svg>
                    <div class="card-body" style="width: 18rem; display: flex; align-items: center; flex-direction: column">
                        <h3 class="text-center">{{ $siswa }}<br>Peserta Didik</h3>
                    </div>
                </div>
            </div>
            <div class="col-sm-4" style="display: flex; justify-content: center">
                <div class="card" style=" display: flex; align-items: center; flex-direction: column;background-color: rgba(255, 255, 255, 0.5) !important">
                    <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
                        <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5" />
                    </svg>
                    <div class="card-body" style="width: 18rem; display: flex; align-items: center; flex-direction: column">
                        <h3 class="text-center">{{ $guru }}<br>Pendik & Kependidikan</h3>
                    </div>
                </div>
            </div>

            <div class="col-sm-4" style="display: flex; justify-content: center">
                <div class="card" style=" display: flex; align-items: center; flex-direction: column; padding-top: 10px; background-color: rgba(255, 255, 255, 0.5) !important">
                    <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="currentColor" class="bi bi-buildings" viewBox="0 0 16 16">
                        <path d="M14.763.075A.5.5 0 0 1 15 .5v15a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5V14h-1v1.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V10a.5.5 0 0 1 .342-.474L6 7.64V4.5a.5.5 0 0 1 .276-.447l8-4a.5.5 0 0 1 .487.022M6 8.694 1 10.36V15h5zM7 15h2v-1.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5V15h2V1.309l-7 3.5z"/>
                        <path d="M2 11h1v1H2zm2 0h1v1H4zm-2 2h1v1H2zm2 0h1v1H4zm4-4h1v1H8zm2 0h1v1h-1zm-2 2h1v1H8zm2 0h1v1h-1zm2-2h1v1h-1zm0 2h1v1h-1zM8 7h1v1H8zm2 0h1v1h-1zm2 0h1v1h-1zM8 5h1v1H8zm2 0h1v1h-1zm2 0h1v1h-1zm0-2h1v1h-1z"/>
                      </svg>
                    <div class="card-body" style="width: 18rem; display: flex; align-items: center; flex-direction: column">
                        <h3 class="text-center">{{ $rombel }}<br>Rombongan Belajar</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="container">
        <div class="row" style="margin-top:50px">
            <div class="col-sm-6 col-sm-offset-3">
                <h2 class="module-title font-alt">Lokasi man 2 kota Tasikmlaya</h2>
            </div>
            <div class="col-sm-12">
                <div class="video-box">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.2451106847375!2d108.20376231061431!3d-7.326343192651397!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6f57312c81d6c9%3A0xe87160a1968d2d1!2sMAN%202%20Kota%20Tasikmalaya!5e0!3m2!1sid!2sid!4v1715189921676!5m2!1sid!2sid" width="100%" height="500px" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
