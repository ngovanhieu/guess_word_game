@extends('admin.master')

@section('sub-view')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3>{{ trans('admin/users/edit.labels.edit-user') }}</h3>
        </div>
        <div class="panel-body">
            {!! Form::open(['action' => ['Admin\UsersController@update', $user->id], 'method' => 'PUT',
                'files' => true, 'class' => 'form-horizontal']) !!}
                <div class="form-group">
                    <label class="col-sm-2 control-label"></label>
                    <div class="col-sm-10">
                        <img src="{{ $user->avatar ? asset(($user->avatar_url)) : asset(config('user.default-avatar')) }}"
                            class="avatar">
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('avatar', trans('admin/users/edit.labels.avatar'), ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-10">
                        {!! Form::file('avatar', ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('name', trans('admin/users/edit.labels.name'), ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-10">
                        {!! Form::text('name', $user->name, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('email', trans('admin/users/edit.labels.email-address'), ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-10">
                        {!! Form::email('email', $user->email, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('role', trans('admin/users/edit.labels.role'), ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-10">
                        {!! Form::select('role', getOptions('options.role'), null, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        {!! Form::submit(trans('admin/users/edit.buttons.update'), ['class' => 'btn btn-success']) !!}
                        {!! Form::reset(trans('admin/users/edit.buttons.reset'), ['class' => 'btn btn-default']) !!}
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
