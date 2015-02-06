@extends('admin')

@section('main')
    @if ($public = Config::get('app.view')) @endif
    <div class="row">
        <h1 class="page-header">List Shop</h1>
        {{ Form::open(['route' => ['list-dish', $page], 'method' => 'GET', 'role' => 'form', 'id' => 'list-dish']) }}
        <div class="panel panel-primary">
            <div class="panel-body">
                <div class="col-lg-4">
                    <label>Title</label>
                    {{ Form::text('title', $input['title'], ['placeholder'=>'Enter Title here', 'class' => 'form-control']) }}
                </div>
            </div>
            <div class="panel-footer">
                <div class="float-right">
                    {{ Form::submit('Search', ['class' => 'btn btn-primary']) }}
                </div>
                <div class="clear-both"></div>
            </div>
        </div>
        {{ Form::close() }}

        <div class="col-lg-12">
            @if(Session::get('success'))
                <div class="alert alert-success">
                    {{ '<div>' . Session::get('success') . '</div>' }}
                </div>
            @endif

            @include('include._paging', array('data'       => $dish,
                                              'page'       => $page,
                                              'url'        => 'dish/listDish/',
                                              'totalItems' => $totalItems,
                                              'totalPage'  => $totalPage,
                                              'forForm'    => 'list-dish'))

            <div class="panel panel-default">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                        <tr>
                            <th class="center">Title</th>
                            <th class="center" width="150">Category</th>
                            <th class="center" width="150">Price</th>
                            <th class="center" width="90">View</th>
                            <th class="center" width="120">Count Image</th>
                            <th class="center" width="90">Image</th>
                            <th class="center" width="85">. . .</th>
                        </tr>
                        </thead>
                        <tbody>
                            @if(count($dish) > 0)
                                @foreach ($dish as $key => $dishItem)
                                    <tr class="odd gradeA">
                                        <td>{{{$dishItem['title']}}}</td>
                                        <td>
                                            @if(count($dishItem['list_category']) > 0)
                                                {{ html_entity_decode(implode('<br>', $dishItem['list_category'])) }}
                                            @endif
                                        </td>
                                        <td class="right">
                                            @if($dishItem['price'])
                                                {{ number_format($dishItem['price']) }} - VND
                                            @endif
                                        </td>
                                        <td class="right">
                                            @if($dishItem['view_num'])
                                                {{$dishItem['view_num']}}
                                            @endif
                                        </td>
                                        <td class="right">
                                            @if($dishItem['count_image'])
                                                {{$dishItem['count_image']}}
                                            @endif
                                        </td>
                                        <td class="center">
                                            @if($dishItem['image_url'])
                                                {{ HTML::image($dishItem['image_url'], 'no-image', scaleImageHeight($dishItem['image_url'], 50)) }}
                                            @else
                                                no-image
                                            @endif
                                        </td>
                                        <td>
                                            <button title="Edit" class="btn btn-info btn-circle action"
                                                    action="{{ URL('dish/editDish/' . $dishItem['id']) }}">
                                                <i class="fa fa-check"></i>
                                            </button>
                                            <button title="Delete" class="btn btn-warning btn-circle action"
                                                    action="{{ URL('dish/deleteDish/' . $dishItem['id']) }}">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr class="odd gradeA">
                                    <td colspan="7">
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