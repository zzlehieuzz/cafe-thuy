@extends('master')

@section('main')
    @if ($public = Config::get('app.view')) @endif
    <div class="row">
        <h1 class="page-header">List Shop</h1>
        {{ Form::open(['route' => ['admin_detail', $page], 'method' => 'GET', 'role' => 'form', 'id' => 'admin_detail']) }}
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
                <ul class="alert alert-success">
                    {{ Session::get('success') }}
                </ul>
            @endif

            @if(Session::get('success'))
                <div class="alert alert-success">
                    {{ '<div>' . Session::get('success') . '</div>' }}
                </div>
            @endif

            @include('include._paging', array('detail'     => $detail,
                                              'page'       => $page,
                                              'totalItems' => $totalItems,
                                              'totalPage'  => $totalPage,
                                              'forForm'    => 'admin_detail'))

            <div class="panel panel-default">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th class="center" width="120">Title</th>
                                <th class="center" width="120">Phone</th>
                                <th class="center">Address</th>
                                <th class="center" width="100">Image Am't </th>
                                <th class="center" width="55">Image</th>
                                <th class="center" width="90">. . .</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($detail) > 0)
                                @foreach ($detail as $key => $detailItem)
                                    @if($key%2)
                                        <tr class="odd gradeA">
                                    @else
                                        <tr class="even gradeA">
                                    @endif
                                        <td>{{{$detailItem['title']}}}</td>
                                        <td>{{{$detailItem['phone']}}}</td>
                                        <td>{{{$detailItem['address']}}}</td>
                                        <td class="right">
                                            @if(count($detailItem['detail_images']) > 0)
                                                {{{count($detailItem['detail_images'])}}}
                                            @endif
                                        </td>
                                        <td class="center">
                                            @if(count($detailItem['detail_images']) > 0)
                                                {{ HTML::image($public . '/detail-image/thumps/thumps_' . $detailItem['thump_image'], 'no-image') }}
                                            @else
                                                no-image
                                            @endif
                                        </td>
                                        <td>
                                            <button title="Edit" class="btn btn-info btn-circle action"
                                                    action="{{ URL('admin/editDetail/' . $detailItem['id']) }}">
                                                <i class="fa fa-check"></i>
                                            </button>
                                            <button title="Delete" class="btn btn-warning btn-circle action"
                                                    action="{{ URL('admin/deleteDetail/' . $detailItem['id']) }}">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr class="odd gradeA">
                                    <td colspan="6">
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