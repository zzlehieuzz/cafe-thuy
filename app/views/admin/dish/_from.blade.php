@if ($public = Config::get('app.view')) @endif
{{ HTML::script($public . 'common/js/page/dish.js') }}

@if(isset($photo))
    {{ Form::model($photo, ['route' => [$action, $photo->id], 'method' => 'POST', 'role' => 'form', 'files' => true]) }}
@else
    {{ Form::open(['route' => $action, 'method' => 'POST', 'role' => 'form', 'files' => true]) }}
@endif
    <div class="panel panel-primary">
        <div class="panel-header">
            <div style="float: right;">
                @if(empty($photo))
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
                <div class="form-group">
                    <label>Title ( * )</label>
                    {{ Form::text('title', Input::old('title'), ['placeholder'=>'Enter here', 'class' => 'form-control']) }}
                </div>

                <div class="form-group">
                    <label>Price ( * )</label>
                    {{ Form::input('number', 'price', (Input::old('price')) ? Input::old('price') : 0 , ['placeholder'=>'Enter here', 'class' => 'form-control']) }}
                </div>

                <div class="form-group">
                    <label>Description</label>
                    {{ Form::textarea('description', Input::old('description'), ['placeholder'=>'Enter here','rows' => '5', 'class' => 'form-control']) }}
                </div>

                <div class="form-group">
                    @if(isset($photo))
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <tbody>
                                <tr>
                                    <td width="130">
                                        @if($photo->image_name)
                                            {{ HTML::image($public . 'uploads/normal/normal_' . $photo->image_name, 'no-image', array('width' => 120 , 'height' => 160)) }}
                                        @else
                                            no-image
                                        @endif
                                    </td>
                                    <td>
                                        <label>Image</label>
                                        {{ Form::file('imageFiles[]', ['multiple' => true, 'accept' => 'image/*']) }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    @else
                        <label>Image</label>
                        {{ Form::file('imageFiles[]', ['multiple' => true, 'accept' => 'image/*']) }}
                    @endif
                </div>
            </div>

            <div class="col-lg-6">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="categoryTable">
                        <thead>
                            <tr>
                                <th class="center">Category</th>
                                <th class="center" width="40"> . . .</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($listPhotoCategory) && $listPhotoCategory)
                                @foreach ($listPhotoCategory as $key => $photoCategoryItem)
                                    <tr class="odd gradeA" id="category_{{$photoCategoryItem['category_id']}}">
                                        <input name="category_list[]" value="{{$photoCategoryItem['category_id']}}" type="hidden"/>
                                        <td>{{$photoCategoryItem['category_name']}}</td>
                                        <td><button type="button" title="Delete" class="btn btn-warning btn-circle" onclick="deleteCategory(this)"><i class="fa fa-times"></i></button></td>
                                    </tr>
                                @endforeach
                            @else
                                <tr class="no-data">
                                    <td colspan="2">No data</td>
                                </tr>
                            @endif
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3">
                                    <div style="float: right;">
                                        {{ Form::button('Add category',
                                        ['class'  => 'btn btn-warning openPopup',
                                         'action' => URL('dish/popupAddCategory'),
                                         'func'   => 'createRowForTable("categoryTable", data)']) }}
                                    </div>
                                    <div style="clear: both;"></div>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        <div class="panel-footer">
            <div style="float: right;">
                @if(empty($photo))
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