@extends('errors')

@section('main')
    <h1 class="page-header">Errors</h1>
    @if(isset($message))
        <ul class="alert alert-danger">
            {{$message}}
        </ul>
    @endif
@endsection