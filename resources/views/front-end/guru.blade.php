@extends('front-end.layouts.main')
@section('container')
<style>
    .card-header {
        display: flex;
        justify-content: center;
        /* Horizontal alignment */
        align-items: center;
    }

</style>
<div class="container">
    <div class="row" style="margin-top:50px">
        <div class="col-sm-6 col-sm-offset-3">
            <h2 class="module-title font-alt">Guru man 2 kota Tasikmlaya</h2>
        </div>
    </div>
    @if(isset($guru))
    @foreach ($guru as $row)
    <?=  ($loop->iteration % 4 == 1 ) ? '<div class="row">' :'' ?>
    <div class="col-sm-3" style="display:flex; justify-content:center; margin-bottom:10px">
        <div class="card bg-light" style="border:1px solid rgba(99, 110, 114, 0.6); padding:10px; border-radius:10px">
            <div class="card-header">

                <img src="/storage/{{ $row->photo }}" class="card-img-top" style="border-radius:50%; width:35vw" alt="...">
            </div>
            <div class="card-body">
                <h4 class="card-text text-center fw-bold"><b>{{ strtoupper($row->nama) }}</b></h4>
                <p class="card-text text-center m-0">Status Kepegawaian: {{ $row->status }}</p>
                <p class="card-text text-center m-0">Jabatan: {{ $row->jabatan }}</p>
                <p class="card-text text-center m-0">{{ $row->lulusan }}</p>
                <p class="card-text text-center m-0">Ampuan: {{ $row->ampuan }}</p>
            </div>
        </div>
    </div>
    <?=  ($loop->iteration % 4 == 0) ? '</div>' :'' ?>
    @endforeach
    @endif
    <div class="row" style="margin-top:50px">
        <div class="col-sm-6 col-sm-offset-3">
            <h2 class="module-title font-alt">Staff man 2 kota Tasikmlaya</h2>
        </div>
    </div>
    @if(isset($staff))
    @foreach ($staff as $row)
    <?=  ($loop->iteration % 4 == 1 ) ? '<div class="row">' :'' ?>
    <div class="col-sm-3" style="display:flex; justify-content:center; margin-bottom:10px">
        <div class="card bg-light" style="border:1px solid rgba(99, 110, 114, 0.6); padding:10px; border-radius:10px">
            <div class="card-header">
                <img src="/storage/{{ $row->photo }}" class="card-img-top" style="border-radius:50%; width:35vw" alt="...">
            </div>
            <div class="card-body">
                <h4 class="card-text text-center fw-bold"><b>{{ strtoupper($row->nama) }}</b></h4>
                <p class="card-text text-center m-0">Status Kepegawaian: {{ $row->status }}</p>
                <p class="card-text text-center m-0">Jabatan: {{ $row->jabatan }}</p>
                <p class="card-text text-center m-0">{{ $row->lulusan }}</p>
            </div>
        </div>
    </div>
    <?= ($loop->iteration % 4 == 0) ? '</div>' :'' ?>
    @endforeach
    @endif
    @endsection
