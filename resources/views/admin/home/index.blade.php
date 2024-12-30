@extends('admin.layouts.main')
@section('container')
<div class="row">
    <div class="col-sm-12">
        <button type="button" class="btn btn-info" id="btn-add-data">
            <i class="ri-add-box-line"></i>&nbsp;<span>Masukan Deskripsi</span>
        </button>
    </div>
</div>
<div class="row mt-2">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
            </div>
            <div class="card-body">
                <div class="card mb-3" id="card">
                </div>
            </div>
        </div>
    </div>
</div>
@include('admin.home.modal-home')
@include('admin.home.modal-cropper')
<script src="/page-script/home.js"></script>
@endsection
