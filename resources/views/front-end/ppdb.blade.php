@extends('front-end.layouts.main')
@section('container')
<div class="container">
    <div class="row" style="margin-top:50px">
        <div class="col-sm-6 col-sm-offset-3">
            <h2 class="module-title font-alt">Penerimaan Peserta Didik Baru Man 2 Kota Tasikmalaya <br> Tahun Pelajaran {{ tahun_aktif() }}</h2>
        </div>
    </div>
    @if(isset($sampul_link))
    <div class="row mb-4" style="margin-bottom: 50px">
        <div class="col-sm-12">
            <img class="img-fluid" src="/storage/{{ $sampul_link }}">
        </div>
        @if(isset($sampul_link_bawah))
        <div class="col-sm-12">
            <img class="img-fluid" src="/storage/{{ $sampul_link_bawah }}">
        </div>
        @endif
    </div>
    @endif
    <div class="row">
        <div class="col-sm-12">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="bg-dark">
                        <tr>
                            <th colspan="4" class="text-center">Pendaftaran Peserta Didik Baru</th>
                        </tr>
                        <tr>
                            <th>No</th>
                            <th>Keterangan</th>
                            <th>Gelombang Regular</th>
                            <th>Gelombang Prestasi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-light">
                        @if(isset($ppdb))
                        @foreach ($ppdb as $row)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $row->kegiatan }}&nbsp;&nbsp; </td>
                            <td>{{ $row->tanggal }} </td>
                            <td>{{ $row->tanggal2 }} </td>
                        </tr>
                        @endforeach
                        @if(isset($sosmed))
                        <tr>
                            <td colspan="2">Form Pendaftaran</td>
                            <td colspan="2"><a href="{{ $sosmed }}">{{ $sosmed }}</a></td>
                        </tr>
                        <tr>
                            <td colspan="2">Daftar Ulang</td>
                            <td colspan="2"><a href="{{ $ulang }}">{{ $ulang }}</a></td>
                        </tr>
                        @endif
                        @else
                        <tr>
                            <td colspan="4" class="text-center">Belum Ada Data!</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
