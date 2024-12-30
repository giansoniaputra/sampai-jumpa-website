@extends('front-end.layouts.main')
@section('container')
<style>
    .card-background {
        background-color: white;
        border-radius: 3px;
        padding: 5px
    }

</style>
<section>
    <div class="container" style="margin-top:100px">
        <div class="row">
            <div class="col-sm-12">
                <h2 class="font-alt text-center">{{ $sub_judul }}</h2>
            </div>
        </div>
        @foreach ($fasilitas as $row)
        @if($loop->iteration % 3 ==1)
        <div class="row" style="margin-top:50px; margin-bottom:100px">
            @endif
            <div class="col-sm-4" style="margin-bottom:10px">
                <div class="card mb-3 card-background">
                    <img src="{{ ($row->photo != null) ? '/storage/'. $row->photo : '/assets/img/photo1.png' }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h3 class="font-alt text-center card-title">{{ strtoupper($row->fasilitas) }}</h3>
                    </div>
                </div>
            </div>
            @if($loop->iteration % 3 == 0)
        </div>
        @endif
        @endforeach
    </div>
</section>
@endsection
