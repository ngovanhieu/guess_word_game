@extends('admin.master')

@section('sub-view')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3>{{ trans('admin/users/create.labels.create-user') }}</h3>
        </div>

        <div class="panel-body">
            
            {!! Form::open(['action' => ['Admin\UsersController@store', 'method' => 'POST'], 'class' => 'form-horizontal']) !!}
                <div class="form-group">
                    {!! Form::label('name', trans('admin/users/create.labels.name'), ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-10">
                        {!! Form::text('name', old('name'), ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('email', trans('admin/users/create.labels.email-address'), ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-10">
                        {!! Form::email('email', old('email'), ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('role', trans('admin/users/create.labels.role'), ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-10">
                        {!! Form::select('role', getOptions('options.role'), null, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        {!! Form::submit(trans('admin/users/create.buttons.create'), ['class' => 'btn btn-success']) !!}
                        {!! Form::reset(trans('admin/users/create.buttons.reset'), ['class' => 'btn btn-default']) !!}
                    </div>
                </div>
            {!! Form::close() !!}

        </div>
    </div>
@endsection
