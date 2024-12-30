@extends('admin.layouts.main')
@section('container')
<div class="row">
    <div class="col-sm-12">
        <button type="button" class="btn btn-info" id="btn-add-data">
            <i class="ri-add-box-line"></i>&nbsp;<span>Masukan Data Baru</span>
        </button>
    </div>
</div>
<div class="row mt-2">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="mb-3">
                            <label for="" class="form-label">Tahun Ajaran</label>
                            <select class="form-control" id="tahun-ajaran-uuid">
                                @foreach ($tahun_ajaran as $row)
                                <option value="{{ $row->uuid }}">{{ $row->tahun_awal }} - {{ $row->tahun_akhir }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="mb-3">
                            <label for="" class="form-label">Kelas</label>
                            <select class="form-control" id="select-kelas">
                                <option value="Kelas X">Kelas X</option>
                                <option value="Kelas XI">Kelas XI</option>
                                <option value="Kelas XII">Kelas XII</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body table-responsive">
                <table id="table-siswa" class="table table-bordered table-hover dataTable dtr-inline">
                    <thead>
                        <th>No</th>
                        <th>Nama Kelas</th>
                        <th>Jumlah Laki-Laki</th>
                        <th>Jumlah Perempuan</th>
                        <th>Jumlah Siswa</th>
                        <th>Action</th>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@include('admin.siswa.modal-siswa')
<script src="/page-script/siswa.js"></script>
@endsection
