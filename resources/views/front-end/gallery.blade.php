@extends('front-end.layouts.main')
@section('container')
<section class="module">
    <div class="container">
        <div class="row multi-columns-row">
            <div class="col-sm-6 col-sm-offset-3">
                <h2 class="module-title font-alt">Galerry</h2>
            </div>
        </div>
        <div class="row multi-columns-row">
            @if(isset($gallery))
            @foreach($gallery as $index => $row)
            <?= ($loop->iteration % 4 == 1) ? '<div class="row">' : ''; ?>
            <div class="col-sm-3">
                <div class="shop-item">
                    <div class="shop-item-image"><img src="storage/{{ $row->photo }}" alt="Accessories Pack" />
                    </div>
                </div>
            </div>
            <?= ($loop->iteration % 4 == 0) ? '</div>' : ''; ?>
            @endforeach
            @else
            <div class="shop-item">
                <div class="shop-item-image"><img src="assets/images/shop/product-7.jpg" alt="Accessories Pack" />
                    <div class="shop-item-detail"><a class="btn btn-round btn-b"><span class="icon-basket">Add To Cart</span></a></div>
                </div>
                <h4 class="shop-item-title font-alt"><a href="#">Accessories Pack</a></h4>£9.00
            </div>
            @endif
            </>
            {{ $gallery->links() }}
        </div>
</section>
@endsection
