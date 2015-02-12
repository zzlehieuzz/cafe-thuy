@if(isset($category))
    {{ Form::model($category, ['route' => [$action, $category->id], 'method' => 'POST', 'role' => 'form']) }}
@else
    {{ Form::open(['route' => $action, 'method' => 'POST', 'role' => 'form', 'files' => true]) }}
@endif
    <div class="panel panel-primary">
        <div class="panel-header">
            <div style="float: right;">
                @if(empty($category))
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
                    <label>Name ( * )</label>
                    {{ Form::text('name', Input::old('name'), ['placeholder'=>'Enter here', 'class' => 'form-control']) }}
                </div>
            </div>
        </div>

        <div class="panel-footer">
            <div style="float: right;">
                @if(empty($category))
                    {{ Form::reset('Reset', ['class' => 'btn btn-warning']) }}
                @endif
                {{ Form::submit('Save', ['class' => 'btn btn-primary']) }}
            </div>
            <div style="clear: both"></div>
        </div>
    </div>
{{ Form::close() }}