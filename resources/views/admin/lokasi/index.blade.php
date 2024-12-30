@extends('admin.layouts.main')
@section('container')
<div class="row">
    <div class="col-sm-12">
        <button type="button" class="btn btn-primary" id="btn-add-data">
            <i class="ri-add-box-line"></i>&nbsp;<span>Masukan Lokasi</span>
        </button>
    </div>
</div>
<div class="row mt-2">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body" id="card"></div>
        </div>
    </div>
</div>
@include('admin.lokasi.modal-lokasi')
<script src="/page-script/lokasi.js"></script>
@endsection
