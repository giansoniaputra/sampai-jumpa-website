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
            </div>
            <div class="card-body table-responsive">
                <table id="table-prestasi" class="table table-bordered table-hover dataTable dtr-inline">
                    <thead>
                        <th>No</th>
                        <th>Jenis Prestasi</th>
                        <th>Even</th>
                        <th>Penyelenggara</th>
                        <th>Tanggal</th>
                        <th>Prestasi</th>
                        <th>Action</th>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@include('admin.prestasi.modal-prestasi')
<script src="/page-script/prestasi.js"></script>
@endsection
