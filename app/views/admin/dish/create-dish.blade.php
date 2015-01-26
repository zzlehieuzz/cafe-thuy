@extends('master')

@section('main')
    <div class="row">
        <h1 class="page-header">Create Shop</h1>
        <div class="col-lg-12">
            @include('home._from', array('action' => 'homePost_createDetail'))
        </div>
    </div>
@endsection