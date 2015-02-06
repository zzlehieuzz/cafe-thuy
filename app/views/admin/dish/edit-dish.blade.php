@extends('admin')

@section('main')
    <div class="row">
        <h1 class="page-header">Edit dish</h1>
        <div class="col-lg-12">
            @include('admin.dish._from', array('action'            => 'post-edit-dish',
                                               'listDishCategory'  => $listDishCategory,
                                               'listImageCategory' => $listImageCategory,
                                               'dish'              => $dish))
        </div>
    </div>
@endsection