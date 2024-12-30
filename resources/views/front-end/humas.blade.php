@extends('front-end.layouts.main')
@section('container')
<style>
    .card-header {
        display: flex;
        justify-content: center;
        /* Horizontal alignment */
        align-items: center;
    }

    .card-img-top {
        width: 30%;
        object-fit: contain;
        align-self: center;
    }

</style>
<div class="container">
    <div class="row" style="margin-top:50px">
        <div class="col-sm-6 col-sm-offset-3">
            <h2 class="module-title font-alt">Sosial Media</h2>
        </div>
    </div>
    <div class="row">
        @if(isset($sosmed))
        <div class="col-sm-3" style="display:flex; justify-content:center; margin-bottom:10px">
            <div class="card bg-light" style="width: 18rem;border:1px solid rgba(99, 110, 114, 0.6); padding:10px; border-radius:10px">
                {{-- <img src="/storage/{{ $row->photo }}" class="card-img-top" style="border-radius:50%" alt="..."> --}}
                <div class="card-header">
                    <img class="card-img-top" src="/img/WA.png" alt="Title" />
                </div>
                <div class="card-body">
                    <div class="card-body">
                        <h4 class="card-text text-center fw-bold">WhatsApp</h4>
                        <p class="card-text text-center m-0"><a target="_blank" href="https://wa.me/{{ $sosmed->wa }}">Click Here >></a></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-3" style="display:flex; justify-content:center; margin-bottom:10px">
            <div class="card bg-light" style="width: 18rem;border:1px solid rgba(99, 110, 114, 0.6); padding:10px; border-radius:10px">
                {{-- <img src="/storage/{{ $row->photo }}" class="card-img-top" style="border-radius:50%" alt="..."> --}}
                <div class="card-header">

                    <img class="card-img-top" src="/img/YT.png" alt="Title" />
                </div>
                <div class="card-body">
                    <div class="card-body">
                        <h4 class="card-text text-center fw-bold">Youtube</h4>
                        <p class="card-text text-center m-0"><a target="_blank" href="{{ $sosmed->yt }}">Click Here >></a></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-3" style="display:flex; justify-content:center; margin-bottom:10px">
            <div class="card bg-light" style="width: 18rem;border:1px solid rgba(99, 110, 114, 0.6); padding:10px; border-radius:10px">
                {{-- <img src="/storage/{{ $row->photo }}" class="card-img-top" style="border-radius:50%" alt="..."> --}}
                <div class="card-header">

                    <img class="card-img-top" src="/img/IG.png" alt="Title" />
                </div>
                <div class="card-body">
                    <div class="card-body">
                        <h4 class="card-text text-center fw-bold">Instagram</h4>
                        <p class="card-text text-center m-0"><a target="_blank" href="{{ $sosmed->ig }}">Click Here >></a></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-3" style="display:flex; justify-content:center; margin-bottom:10px">
            <div class="card bg-light" style="width: 18rem;border:1px solid rgba(99, 110, 114, 0.6); padding:10px; border-radius:10px">
                {{-- <img src="/storage/{{ $row->photo }}" class="card-img-top" style="border-radius:50%" alt="..."> --}}
                <div class="card-header">

                    <img class="card-img-top" src="/img/FB.png" alt="Title" />
                </div>
                <div class="card-body">
                    <div class="card-body">
                        <h4 class="card-text text-center fw-bold">Facebook</h4>
                        <p class="card-text text-center m-0"><a target="_blank" href="{{ $sosmed->fb }}">Click Here >></a></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-3" style="display:flex; justify-content:center; margin-bottom:10px">
            <div class="card bg-light" style="width: 18rem;border:1px solid rgba(99, 110, 114, 0.6); padding:10px; border-radius:10px">
                {{-- <img src="/storage/{{ $row->photo }}" class="card-img-top" style="border-radius:50%" alt="..."> --}}
                <div class="card-header">

                    <img class="card-img-top" src="/img/X.png" alt="Title" />
                </div>
                <div class="card-body">
                    <div class="card-body">
                        <h4 class="card-text text-center fw-bold">Twitter</h4>
                        <p class="card-text text-center m-0"><a target="_blank" href="{{ $sosmed->x }}">Click Here >></a></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-3" style="display:flex; justify-content:center; margin-bottom:10px">
            <div class="card bg-light" style="width: 18rem;border:1px solid rgba(99, 110, 114, 0.6); padding:10px; border-radius:10px">
                {{-- <img src="/storage/{{ $row->photo }}" class="card-img-top" style="border-radius:50%" alt="..."> --}}
                <div class="card-header">

                    <img class="card-img-top" src="/img/TT.png" alt="Title" />
                </div>
                <div class="card-body">
                    <div class="card-body">
                        <h4 class="card-text text-center fw-bold">Tiktok</h4>
                        <p class="card-text text-center m-0"><a target="_blank" href="{{ $sosmed->tt }}">Click Here >></a></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-3" style="display:flex; justify-content:center; margin-bottom:10px">
            <div class="card bg-light" style="width: 18rem;border:1px solid rgba(99, 110, 114, 0.6); padding:10px; border-radius:10px">
                {{-- <img src="/storage/{{ $row->photo }}" class="card-img-top" style="border-radius:50%" alt="..."> --}}
                <div class="card-body">
                    <div class="card-header">

                        <img class="card-img-top" src="/img/EMAIL.png" alt="Title" />
                    </div>
                    <div class="card-body">
                        <h4 class="card-text text-center fw-bold">Email</h4>
                        <p class="card-text text-center m-0"><a href="https://mail.google.com/mail/u/0/?view=cm&tf=1&fs=1&to={{ $sosmed->gmail }}" target="_blank" rel="nofollow noopener" title="Send email with Gmail">Click Here >></a></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-3" style="display:flex; justify-content:center; margin-bottom:10px">
            <div class="card bg-light" style="width: 18rem;border:1px solid rgba(99, 110, 114, 0.6); padding:10px; border-radius:10px">
                {{-- <img src="/storage/{{ $row->photo }}" class="card-img-top" style="border-radius:50%" alt="..."> --}}
                <div class="card-header">

                    <img class="card-img-top" src="/img/PPDB.png" alt="Title" />
                </div>
                <div class="card-body">
                    <div class="card-body">
                        <h4 class="card-text text-center fw-bold">LINK PPDB</h4>
                        <p class="card-text text-center m-0"><a target="_blank" href="{{ $sosmed->ppdb }}">Click Here >></a></p>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
