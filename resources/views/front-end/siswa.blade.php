@extends('front-end.layouts.main')
@section('container')
<section class="module">
    <div class="container">
        <div class="row" style="margin-top:50px">
            <div class="col-sm-6 col-sm-offset-3">
                <h2 class="module-title font-alt">Siswa Man 2 Kota Tasikmalaya</h2>
            </div>
        </div>
        @foreach($tahun_ajaran as $index => $row)
        @php
        $x = renderKelas($row->uuid, 'Kelas X');
        $xi = renderKelas($row->uuid, 'Kelas XI');
        $xii = renderKelas($row->uuid, 'Kelas XII');
        @endphp
        <div class="row" style="background-color:white; border-radius:5px">
            <div class="col-sm-12">
                <h4 class="font-alt mb-0">Tahun Ajaran {{ $row->tahun_awal }}/{{ $row->tahun_akhir }}</h4>
                <hr class="divider-w mt-10 mb-20">
                <div role="tabpanel">
                    <ul class="nav nav-tabs font-alt" role="tablist">
                        <li class="active"><a href="#kelas10{{ $index }}" data-toggle="tab"></span>Kelas X</a></li>
                        <li><a href="#kelas11{{ $index }}" data-toggle="tab"></span>Kelas XI</a></li>
                        <li><a href="#kelas12{{ $index }}" data-toggle="tab"></span>Kelas XII</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="kelas10{{ $index }}">
                            <div class="row">
                                <div class="col-sm-12">
                                    <h4 class="font-alt mb-0">kelas X</h4>
                                </div>
                            </div>
                            <div class="row" style="margin: 7px">
                                <table class="table table-bordered">
                                    <thead class="bg-dark">
                                        <tr>
                                            <th>No</th>
                                            <th>Kelas</th>
                                            <th>Laki-Laki</th>
                                            <th>Perempuan</th>
                                            <th>Jumlah</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($x as $kelas)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $kelas->nama_kelas }}</td>
                                            <td>{{ $kelas->jumlah_lk }}</td>
                                            <td>{{ $kelas->jumlah_pr }}</td>
                                            <td>{{ $kelas->jumlah_lk +  $kelas->jumlah_pr}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane" id="kelas11{{ $index }}">
                            <div class="row">
                                <div class="col-sm-12">
                                    <h4 class="font-alt mb-0">kelas XI</h4>
                                </div>
                            </div>
                            <div class="row" style="margin: 7px">
                                <table class="table table-bordered">
                                    <thead class="bg-dark">
                                        <tr>
                                            <th>No</th>
                                            <th>Kelas</th>
                                            <th>Laki-Laki</th>
                                            <th>Perempuan</th>
                                            <th>Jumlah</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($xi as $kelas)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $kelas->nama_kelas }}</td>
                                            <td>{{ $kelas->jumlah_lk }}</td>
                                            <td>{{ $kelas->jumlah_pr }}</td>
                                            <td>{{ $kelas->jumlah_lk +  $kelas->jumlah_pr}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane" id="kelas12{{ $index }}">
                            <div class="row">
                                <div class="col-sm-12">
                                    <h4 class="font-alt mb-0">kelas XII</h4>
                                </div>
                            </div>
                            <div class="row" style="margin: 7px">
                                <table class="table table-bordered">
                                    <thead class="bg-dark">
                                        <tr>
                                            <th>No</th>
                                            <th>Kelas</th>
                                            <th>Laki-Laki</th>
                                            <th>Perempuan</th>
                                            <th>Jumlah</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($xii as $kelas)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $kelas->nama_kelas }}</td>
                                            <td>{{ $kelas->jumlah_lk }}</td>
                                            <td>{{ $kelas->jumlah_pr }}</td>
                                            <td>{{ $kelas->jumlah_lk +  $kelas->jumlah_pr}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>
@endsection
