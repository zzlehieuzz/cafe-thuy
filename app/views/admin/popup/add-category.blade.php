@extends('popup')

@section('main')
    <h1 class="page-header">List Category</h1>

    <div class="col-lg-6">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="form-group">
                    <label>Root category ( * )</label>
                    {{ Form::select('root_category_id', $optionRootCategory , Input::old('root_category_id'),
                                    ['id'     => 'root_category_id',
                                     'class'  => 'form-control',
                                     'action' => URL('home/loadCategoryById') ]) }}
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="list-shop-category">
                        <thead>
                            <tr>
                                <th class="center" width="50">. . .</th>
                                <th class="center">Category</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($optionCategory) && count($optionCategory) > 0)
                                @foreach ($optionCategory as $key => $categoryItem)
                                    <tr class="odd gradeA rows_{{$categoryItem['id']}}">
                                        <td class="center">
                                            {{ Form::checkbox('cat_' . $categoryItem['id'], $categoryItem['id'], false, ['catname' => $categoryItem['name'], 'class' => 'return-data']) }}
                                        </td>
                                        <td>
                                            {{$categoryItem['name']}}
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
                    {{ Form::button('Add data', ['class' => 'btn btn-warning popup-return-category']) }}
                </div>
                <div style="clear: both;"></div>
            </div>
        </div>
    </div>
@endsection

