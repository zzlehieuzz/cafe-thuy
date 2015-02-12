@extends('admin')

@section('main')
    @if ($public = Config::get('app.view')) @endif
    <div class="row">
        <h1 class="page-header">List Category</h1>

        <div class="col-lg-12">
            @if(Session::get('success'))
                <div class="alert alert-success">
                    {{ '<div>' . Session::get('success') . '</div>' }}
                </div>
            @endif

            <div class="panel panel-default">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th class="right" width="50">No</th>
                                <th class="center">Category name</th>
                                <th class="center" width="85">. . .</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($category) > 0)
                                @foreach ($category as $key => $categoryItem)
                                    <tr class="odd gradeA">
                                        <td>{{$key+=1}}</td>
                                        <td>{{$categoryItem['name']}}</td>
                                        <td>
                                            <button title="Edit" class="btn btn-info btn-circle action-blank"
                                                    action="{{ URL('category/editCategory/' . $categoryItem['id']) }}">
                                                <i class="fa fa-check"></i>
                                            </button>
                                            <button title="Delete" class="btn btn-warning btn-circle action-blank"
                                                    action="{{ URL('category/deleteCategory/' . $categoryItem['id']) }}">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr class="odd gradeA">
                                    <td colspan="3">
                                        No data
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection