@extends('admin.layouts.main')
@section('container')
<div class="row mt-2">
    <div class="col-sm-4">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-12">
                        <label for="photo" class="form-label">Masukan Photo</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-8">
                        <div class="col-sm-12">
                            <form action="javascript:;" id="form-gallery" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <input type="file" class="form-control" name="photo" id="photo">
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <button type="button" class="btn btn-success" id="save-gambar">
                            <i class="ri-add-box-line"></i>&nbsp;<span>Upload</span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        <img src="/assets/img/user.png" alt="" id="photo-preview" style="width: 300px; height:300px" class="img-thumbnail">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="card">
            <div class="card-header">
                <h2>Gallery</h2>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <div class="row mt-2" id="card"></div>
                </div>
            </div>
            <div class="card-footer">
                <button id="btn-previous" class="btn btn-primary">Previous</button>
                <button id="btn-next" class="btn btn-primary">Next</button>
            </div>
        </div>
    </div>
</div>
@include('admin.gallery.modal-cropper')
<script src="/page-script/gallery.js"></script>
@endsection
