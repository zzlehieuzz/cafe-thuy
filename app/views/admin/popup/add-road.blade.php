@extends('popup')

@section('main')
    <h1 class="page-header">List Road</h1>

    <div class="col-lg-6">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="form-group">
                    <label>Root road ( * )</label>
                    {{ Form::select('root_road_id', $optionRootRoad , Input::old('root_road_id'),
                                    ['id'     => 'root_road_id',
                                     'class'  => 'form-control',
                                     'action' => URL('home/loadRoadById') ]) }}
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="list-shop-road">
                        <thead>
                        <tr>
                            <th class="center" width="50">. . .</th>
                            <th class="center">Road</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($optionRoad) && count($optionRoad) > 0)
                            @foreach ($optionRoad as $key => $roadItem)
                                <tr class="odd gradeA rows_{{$roadItem['id']}}">
                                    <td class="center">
                                        {{ Form::checkbox('cat_' . $roadItem['id'], $roadItem['id'], false, ['catname' => $roadItem['name'], 'class' => 'return-data']) }}
                                    </td>
                                    <td>
                                        {{ $roadItem['name'] }}
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr class="tr-footer">
                                <td colspan="2">No data</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="panel-footer">
                <div style="float: right;">
                    {{ Form::button('Add data', ['class' => 'btn btn-warning popup-return-road']) }}
                </div>
                <div style="clear: both;"></div>
            </div>
        </div>
    </div>
@endsection