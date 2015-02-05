@extends('admin')

@section('main')
    <div class="row">
        <h1 class="page-header">Create dish</h1>
        <div class="col-lg-12">
            @include('admin.dish._from', array('action' => 'post-create-dish'))
        </div>
    </div>
@endsection