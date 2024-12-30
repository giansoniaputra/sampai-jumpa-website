@extends('admin.layouts.main')
@section('container')
<div class="row">
    <div class="col-sm-12">
        <button type="button" class="btn btn-info" id="btn-add-data">
            <i class="ri-add-box-line"></i>&nbsp;<span>Masukan Visi Misi</span>
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
<div class="row mt-2 mb-2">
    <div class="col-sm-12">
        <button type="button" class="btn btn-info" id="btn-add-data-tujuan">
            <i class="ri-add-box-line"></i>&nbsp;<span>Masukan Strategi & Tujuan</span>
        </button>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">

            </div>
            <div class="card-body">
                <div class="card mb-3" id="card2">
                </div>
            </div>
        </div>
    </div>
</div>
@include('admin.profil.modal-profil')
@include('admin.profil.modal-tujuan')
@include('admin.profil.modal-cropper')
<script src="/page-script/profil.js"></script>
@endsection
