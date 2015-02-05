@extends('admin')

@section('main')
    <div class="row">
        <h1 class="page-header">Edit Shop</h1>
        <div class="col-lg-12">
            @include('home._from', array('action'           => 'post-edit-dish',
                                         'detailImage'      => $detailImage,
                                         'listShopCategory' => $listShopCategory,
                                         'listShopRoad'     => $listShopRoad,
                                         'detail'           => $detail))
        </div>
    </div>
@endsection