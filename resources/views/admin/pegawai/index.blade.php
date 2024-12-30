@extends('admin.layouts.main')
@section('container')
<div class="row mb-2">
    <div class="col-sm-12">
        <button class="btn btn-primary" id="btn-add-data">Tambah Data</button>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="card card-primary card-outline card-tabs">
            <div class="card-body">
                <div class="tab-content" id="custom-tabs-three-tabContent">
                    <div class="tab-pane fade show active" id="custom-tabs-three-home" role="tabpanel"
                        aria-labelledby="custom-tabs-three-home-tab">
                        <div class="card">
                            <div class="card-header">
                                <h2>Pesan</h2>
                            </div>
                            <div class="card-body table-responsive">
                                <table id="table-guru" class="table table-bordered table-hover dataTable dtr-inline">
                                    <thead>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Pesan</th>
                                        <th>Photo</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('admin.pegawai.modal-photo')
@include('admin.pegawai.modal-pegawai')
@include('admin.pegawai.modal-cropper')
<script src="/page-script/pegawai.js"></script>
@endsection
