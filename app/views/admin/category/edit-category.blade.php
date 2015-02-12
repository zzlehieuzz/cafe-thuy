@extends('admin')

@section('main')
    <div class="row">
        <h1 class="page-header">Edit category</h1>
        <div class="col-lg-12">
            @include('admin.category._from', array('action'   => 'post-edit-category',
                                                   'category' => $category))
        </div>
    </div>
@endsection