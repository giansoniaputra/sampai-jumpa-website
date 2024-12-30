@extends('admin.layouts.main')
@section('container')
<div class="row">
    <div class="col-sm-12">
        <button type="button" class="btn btn-info" id="btn-add-data">
            <i class="ri-add-box-line"></i>&nbsp;<span>Update Sosial Media</span>
        </button>
    </div>
</div>
<div class="row mt-2">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
            </div>
            <div class="card-body table-responsive">
                <table id="table-sosmed" class="table table-bordered table-hover dataTable dtr-inline">
                    <thead>
                        <th>Whatsapp</th>
                        <th>IG</th>
                        <th>YT</th>
                        <th>FB</th>
                        <th>Twitter</th>
                        <th>Tiktok</th>
                        <th>Gmail</th>
                        <th>Website</th>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@include('admin.sosmed.modal-sosmed')
<script src="/page-script/sosmed.js"></script>
@endsection
