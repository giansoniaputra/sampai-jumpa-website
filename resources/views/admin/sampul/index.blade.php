@extends('admin.layouts.main')
@section('container')
<div class="row">
    <div class="col-sm-12">
        <button type="button" class="btn btn-primary" id="btn-add-data">
            <i class="fas fa-image"></i>&nbsp;<span>Masukan Sampul</span>
        </button>
    </div>
</div>
<div class="row mt-2">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4>Sampul Home</h4>
            </div>
            <div class="card-body" id="card-home"></div>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4>Sampul Profil</h4>
            </div>
            <div class="card-body" id="card-profil"></div>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4>Sampul Guru</h4>
            </div>
            <div class="card-body" id="card-guru"></div>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4>Sampul Kurikulum</h4>
            </div>
            <div class="card-body" id="card-kurikulum"></div>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4>Sampul Siswa</h4>
            </div>
            <div class="card-body" id="card-siswa"></div>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4>Sampul Prestasi</h4>
            </div>
            <div class="card-body" id="card-prestasi"></div>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4>Sampul PPDB</h4>
            </div>
            <div class="card-body" id="card-ppdb"></div>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4>Sampul Berita</h4>
            </div>
            <div class="card-body" id="card-berita"></div>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4>Sampul Sarana</h4>
            </div>
            <div class="card-body" id="card-sarana"></div>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4>Sampul Humas</h4>
            </div>
            <div class="card-body" id="card-humas"></div>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4>Sampul Layanan</h4>
            </div>
            <div class="card-body" id="card-layanan"></div>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4>Sampul Gallery</h4>
            </div>
            <div class="card-body" id="card-gallery"></div>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4>Sampul Zona Integritas</h4>
            </div>
            <div class="card-body" id="card-integrity"></div>
        </div>
    </div>
</div>
@include('admin.sampul.modal-sampul')
<script src="/page-script/sampul.js"></script>
@endsection
