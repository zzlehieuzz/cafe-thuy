@extends('admin')

@section('main')
    <div class="row">
        <h1 class="page-header">Create category</h1>
        <div class="col-lg-12">
            @include('admin.category._from', array('action' => 'post-create-category'))
        </div>
    </div>
@endsection