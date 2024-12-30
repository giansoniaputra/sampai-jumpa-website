@extends('admin.layouts.main')
@section('container')
<div class="row">
    <div class="col-sm-12">
        <button type="button" class="btn btn-info" id="btn-add-data">
            <i class="ri-add-box-line"></i>&nbsp;<span>Masukan Informasi</span>
        </button>
    </div>
</div>
<div class="row mt-2">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
            </div>
            <div class="card-body table-responsive">
                <table id="table-komponen" class="table table-bordered table-hover dataTable dtr-inline">
                    <thead>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Jabatan</th>
                        <th>Action</th>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@include('admin.komponen.modal-komponen')
<script src="/page-script/komponen.js"></script>
@endsection
