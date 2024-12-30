@extends('admin.layouts.main')
@section('container')
<div class="row">
    <div class="col-sm-12">
        <button type="button" class="btn btn-info" id="btn-add-data">
            <i class="ri-add-box-line"></i>&nbsp;<span>Masukan Jenis Mapel</span>
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
                            <label for="" class="form-label">Kelas</label>
                            <select class="form-control" id="option-kelas">
                                @foreach ($kelas as $row)
                                <option value="{{ $row->uuid }}&-&{{ $row->kurikulum }}">{{ $row->kelas }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body table-responsive">
                <table id="table-mapel" class="table table-bordered table-hover dataTable dtr-inline">
                    <thead>
                        <th>No</th>
                        <th>Jenis Mata Pelajaran</th>
                        <th>Nama Mata Pelajaran</th>
                        <th id="jam1">Regular</th>
                        <th id="jam2">Proyek PPPP</th>
                        <th>Action</th>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@include('admin.mapel.modal-mapel')
@include('admin.mapel.modal-sub-mapel')
<script src="/page-script/mapel.js"></script>
<script src="/page-script/sub-mapel.js"></script>
@endsection
