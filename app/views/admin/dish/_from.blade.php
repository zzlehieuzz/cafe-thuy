@if ($public = Config::get('app.view')) @endif
        <!-- tinymce -->
{{ HTML::script($public . 'tinymce/js/tinymce/tinymce.min.js') }}
{{ HTML::script($public . 'common/js/page/shop.js') }}

<script type="text/javascript">
    tinymce.init({
        selector: "textarea"
    });
</script>
    @if(isset($detail))
        {{ Form::model($detail, ['route' => [$action, $detail->id], 'method' => 'POST', 'role' => 'form', 'files' => true]) }}
    @else
        {{ Form::open(['route' => $action, 'method' => 'POST', 'role' => 'form', 'files' => true]) }}
    @endif
    <div class="panel panel-primary">
        <div class="panel-footer">
            <div style="float: right;">
                @if(empty($detail))
                    {{ Form::reset('Reset', ['class' => 'btn btn-warning']) }}
                @endif
                {{ Form::submit('Save', ['class' => 'btn btn-primary']) }}
            </div>
            <div style="clear: both"></div>
        </div>
        <div class="panel-body">
            @if($errors->has())
                <ul class="alert alert-danger">
                    {{ implode('', $errors->all('<li>:message</li>')) }}
                </ul>
            @endif

            @if(Session::get('success'))
                <div class="alert alert-success">
                    {{ '<div>' . Session::get('success') . '</div>' }}
                </div>
            @endif

            <div class="col-lg-6">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="shop-category">
                        <thead>
                            <tr>
                                <th class="center">Root category</th>
                                <th class="center">Category</th>
                                <th class="center" width="40"> . . .</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($listShopCategory) && $listShopCategory)
                                @foreach ($listShopCategory as $key => $shopCategoryItem)
                                    <tr class="odd gradeA" root_category_id="{{$shopCategoryItem['root_category_id']}}"  category_id="{{$shopCategoryItem['category_id']}}" >
                                        <input name="root_category_list[]" value="{{$shopCategoryItem['root_category_id']}}" type="hidden"/>
                                        <input name="category_list[]" value="{{$shopCategoryItem['category_id']}}" type="hidden"/>
                                        <td>{{$shopCategoryItem['root_category_name']}}</td>
                                        <td>{{$shopCategoryItem['category_name']}}</td>
                                        <td><button type="button" title="Delete" class="btn btn-warning btn-circle" onclick="deleteCategory(this)"><i class="fa fa-times"></i></button></td>
                                    </tr>
                                @endforeach
                            @else
                                <tr class="no-data">
                                    <td colspan="3">No data</td>
                                </tr>
                            @endif
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3">
                                    <div style="float: right;">
                                        {{ Form::button('Add category',
                                        ['class'  => 'btn btn-warning openPopup',
                                         'action' => URL('home/popupAddCategory'),
                                         'func'   => 'createRowForTableShop("shop-category", data)']) }}
                                    </div>
                                    <div style="clear: both;"></div>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="shop-road">
                        <thead>
                            <tr>
                                <th class="center">Root road</th>
                                <th class="center">road</th>
                                <th class="center" width="50"> . . .</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if(isset($listShopRoad) && $listShopRoad)
                            @foreach ($listShopRoad as $key => $shopRoadItem)
                                <tr class="odd gradeA" root_road_id="{{$shopRoadItem['root_road_id']}}"  road_id="{{$shopRoadItem['road_id']}}" >
                                    <input name="root_road_list[]" value="{{$shopRoadItem['root_road_id']}}" type="hidden"/>
                                    <input name="road_list[]" value="{{$shopRoadItem['road_id']}}" type="hidden"/>
                                    <td>{{$shopRoadItem['root_road_name']}}</td>
                                    <td>{{$shopRoadItem['road_name']}}</td>
                                    <td><button type="button" title="Delete" class="btn btn-warning btn-circle" onclick="deleteRoad(this)"><i class="fa fa-times"></i></button></td>
                                </tr>
                            @endforeach
                        @else
                            <tr class="no-data">
                                <td colspan="3">No data</td>
                            </tr>
                        @endif
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3">
                                    <div style="float: right;">
                                        {{ Form::button('Add road',
                                        ['class'  => 'btn btn-warning openPopup',
                                         'action' => URL('home/popupAddRoad'),
                                         'func'   => 'createRowForTableShopRoad("shop-road", data)']) }}
                                    </div>
                                    <div style="clear: both;"></div>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="form-group">
                    <label>Title ( * )</label>
                    {{ Form::text('title', Input::old('title'), ['placeholder'=>'Enter here', 'class' => 'form-control']) }}
                </div>

                <div class="form-group">
                    <label>Address</label>
                    {{ Form::text('address', Input::old('address'), ['placeholder'=>'Enter here', 'class' => 'form-control']) }}
                </div>
                <div class="form-group">
                    <label>Phone</label>
                    {{ Form::text('phone', Input::old('phone'), ['placeholder'=>'Enter here', 'class' => 'form-control']) }}
                </div>

                <div class="form-group">
                    <label>Content</label>
                    {{ Form::textarea('content', Input::old('content'), ['placeholder'=>'Enter here','rows' => '5', 'class' => 'form-control']) }}
                </div>

                <div class="form-group">
                    <label>Thump Image</label>
                    {{ Form::file('thumpImage', ['accept' => 'image/*']) }}
                </div>

                <div class="form-group">
                    <label>List image</label>
                    {{ Form::file('detailImages[]', ['multiple' => true, 'accept' => 'image/*']) }}
                </div>
            </div>

            @if(isset($detailImage) && $detailImage)
                <div class="table-responsive col-lg-2">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                        <tr>
                            <th class="center">Thump Image</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    @if($detail->thump_image)
                                        {{ HTML::image($public . '/detail-image/normal/normal_' . $detail->thump_image, 'no-image', array('width' => 120 , 'height' => 120)) }}
                                    @else
                                        no-image
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="table-responsive col-lg-10">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th class="center">List Image</th>
                                <th class="center" width="50">. . .</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($detailImage as $key => $detailImageItem)
                                @if($key%2)
                                    <tr class="odd gradeA rows_{{$detailImageItem['id']}}">
                                @else
                                    <tr class="even gradeA rows_{{$detailImageItem['id']}}">
                                @endif
                                    <td class="center">
                                        @if(count($detailImageItem['name']) > 0)
                                            {{ HTML::image($public . '/detail-image/large/large_' . $detailImageItem['name'], 'no-image', array('width' => 50 , 'height' => 50)) }}
                                        @else
                                            no-image
                                        @endif
                                    </td>
                                    <td>
                                        <button type="button" title="Delete" imageId="{{$detailImageItem['id']}}" class="btn btn-warning btn-circle detailImageId action"><i class="fa fa-times"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

        <div class="panel-footer">
            <div style="float: right;">
                @if(empty($detail))
                    {{ Form::reset('Reset', ['class' => 'btn btn-warning']) }}
                @else
                    {{ Form::hidden('removeDetailImages', '', ['id' => 'removeDetailImages']) }}
                @endif
                {{ Form::submit('Save', ['class' => 'btn btn-primary']) }}
            </div>
            <div style="clear: both"></div>
        </div>
    </div>
{{ Form::close() }}