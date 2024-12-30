@extends('front-end.layouts.main')
@section('container')
<section class="module">
    <div class="container">
        <div class="row" style="margin-top:50px">
            <div class="col-sm-6 col-sm-offset-3">
                <h2 class="module-title font-alt">Prestasi Man 2 Kota Tasikmalaya</h2>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-sm-12">
                <h3>PRESTASI LEMBAGA</h3>
            </div>
        </div>
        <div class="row">
            <table class="table table-bordered">
                <thead class="bg-dark">
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Even</th>
                        <th class="text-center">Penyelenggara</th>
                        <th class="text-center">Tanggal</th>
                        <th class="text-center">Prestasi</th>
                    </tr>
                </thead>
                <tbody style="background-color: white">
                    @if(isset($prestasi_lembaga))
                    @foreach ($prestasi_lembaga as $row)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td class="text-center">{{ $row->even }}</td>
                        <td class="text-center">{{ $row->penyelenggara }}</td>
                        <td class="text-center">{{ tanggal_hari($row->tanggal) }}</td>
                        <td class="text-center">{{ $row->prestasi }}</td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="5" class="text-center">Belum Ada Prestasi!</td>
                    </tr>
                    @endif
                </tbody style="background-color: white">
            </table>
        </div>
        <div class="row mb-3">
            <div class="col-sm-12">
                <h3>PRESTASI PENDIDIK & KEPENDIDIKAN</h3>
            </div>
        </div>
        <div class="row">
            <table class="table table-bordered">
                <thead class="bg-dark">
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Even</th>
                        <th class="text-center">Penyelenggara</th>
                        <th class="text-center">Tanggal</th>
                        <th class="text-center">Prestasi</th>
                    </tr>
                </thead>
                <tbody style="background-color: white">
                    @if(isset($prestasi_pendidik))
                    @foreach ($prestasi_pendidik as $row)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td class="text-center">{{ $row->even }}</td>
                        <td class="text-center">{{ $row->penyelenggara }}</td>
                        <td class="text-center">{{ tanggal_hari($row->tanggal) }}</td>
                        <td class="text-center">{{ $row->prestasi }}</td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="5" class="text-center">Belum Ada Prestasi!</td>
                    </tr>
                    @endif
                </tbody style="background-color: white">
            </table>
        </div>
        <div class="row mb-3">
            <div class="col-sm-12">
                <h3>PRESTASI AKADEMIK PESERTA DIDIK</h3>
            </div>
        </div>
        <div class="row">
            <table class="table table-bordered">
                <thead class="bg-dark">
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Even</th>
                        <th class="text-center">Penyelenggara</th>
                        <th class="text-center">Tanggal</th>
                        <th class="text-center">Prestasi</th>
                    </tr>
                </thead>
                <tbody style="background-color: white">
                    @if(isset($prestasi_pendidikan))
                    @foreach ($prestasi_pendidikan as $row)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td class="text-center">{{ $row->even }}</td>
                        <td class="text-center">{{ $row->penyelenggara }}</td>
                        <td class="text-center">{{ tanggal_hari($row->tanggal) }}</td>
                        <td class="text-center">{{ $row->prestasi }}</td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="5" class="text-center">Belum Ada Prestasi!</td>
                    </tr>
                    @endif
                </tbody style="background-color: white">
            </table>
        </div>
        <div class="row mb-3">
            <div class="col-sm-12">
                <h3>PRESTASI NON AKADEMIK PESERTA DIDIK</h3>
            </div>
        </div>
        <div class="row">
            <table class="table table-bordered">
                <thead class="bg-dark">
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Even</th>
                        <th class="text-center">Penyelenggara</th>
                        <th class="text-center">Tanggal</th>
                        <th class="text-center">Prestasi</th>
                    </tr>
                </thead>
                <tbody style="background-color: white">
                    @if(isset($prestasi_no_pendidikan))
                    @foreach ($prestasi_no_pendidikan as $row)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td class="text-center">{{ $row->even }}</td>
                        <td class="text-center">{{ $row->penyelenggara }}</td>
                        <td class="text-center">{{ tanggal_hari($row->tanggal) }}</td>
                        <td class="text-center">{{ $row->prestasi }}</td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="5" class="text-center">Belum Ada Prestasi!</td>
                    </tr>
                    @endif
                </tbody style="background-color: white">
            </table>
        </div>
    </div>
</section>
@endsection
