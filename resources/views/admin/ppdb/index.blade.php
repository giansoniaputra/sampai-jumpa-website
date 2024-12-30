@extends('admin.layouts.main')
@section('container')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <form action="javascript:;" class="d-inline" id="form-ppdb-prestasi">
                    @csrf
                    <div class="row">
                        <div class="col-sm-3">
                            <label for="kegiatan">Nama Kegiatan</label>
                        </div>
                        <div class="col-sm-3">
                            <label for="tanggal">Tanggal Regular</label>
                        </div>
                        <div class="col-sm-3">
                            <label for="tanggal2">Tanggal Prestasi</label>
                        </div>
                        <div class="col-sm-3">
                            <label for=""></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <input type="text" class="form-control" name="kegiatan" id="kegiatan-prestasi" placeholder="Masukan Kegiatan">
                        </div>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" name="tanggal" id="tanggal-prestasi" placeholder="Masukan Tanggal">
                        </div>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" name="tanggal2" id="tanggal-prestasi2" placeholder="Masukan Tanggal">
                        </div>
                        <div class="col-sm-3" id="btn-action-prestasi"><button class="btn btn-primary" id="save-data-prestasi">Tambah</button></div>
                    </div>
                </form>
            </div>
            <div class="card-body table-responsive">
                <table id="table-ppdb-prestasi" class="table table-bordered table-hover dataTable dtr-inline">
                    <thead>
                        <th>No</th>
                        <th>Kegiatan</th>
                        <th>Tanggal Regular</th>
                        <th>Tanggal Prestasi</th>
                        <th>Action</th>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div id="view-link"></div>
<script src="/page-script/ppdb.js"></script>
@endsection
