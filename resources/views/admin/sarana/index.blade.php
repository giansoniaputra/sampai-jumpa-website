@extends('admin.layouts.main')
@section('container')
<div class="row">
    <div class="col-sm-12">
        <button type="button" class="btn btn-info" id="btn-add-data">
            <i class="ri-add-box-line"></i>&nbsp;<span>Masukan Sarana dan Prasarana</span>
        </button>
    </div>
</div>
<div class="row mt-2">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
            </div>
            <div class="card-body table-responsive">
                <table id="table-sarana" class="table table-bordered table-hover dataTable dtr-inline">
                    <thead>
                        <th>Status Tanah dan Bangunan</th>
                        <th>Luas Tanah</th>
                        <th>Alamat</th>
                        <th>Fasilitas</th>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@include('admin.sarana.modal-sarana')
@include('admin.sarana.modal-fasilitas')
@include('admin.sarana.modal-photo')
@include('admin.sarana.modal-cropper')
<script src="/page-script/sarana.js"></script>
@endsection
