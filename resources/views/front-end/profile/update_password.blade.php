@extends('front-end.master')

@section('subview')
    <div class="col-md-4">
        <div class="panel panel-default profile-box">
            <h3>{{ trans('front-end/profile/update_password.labels.profile') }}</h3>
            <div class="well">
                <div>
                    <img src="{{ Auth::user()->avatar ? asset((Auth::user()->avatar_url)) : asset(config('user.default-avatar')) }}" 
                        class="avatar">
                </div>
                <br>
                <div>
                    <label>{{ trans('front-end/profile/update_password.labels.name') }}:
                        <i>{{ Auth::user()->name }}</i>
                    </label>
                </div>
                <div>
                    <label>{{ trans('front-end/profile/update_password.labels.email') }}:
                        <i>{{ Auth::user()->email }}</i>
                    </label>
                </div>
                <div>
                    <label>{{ trans('front-end/profile/update_password.labels.time-joined') }}:
                        <i>{{ date_format(Auth::user()->created_at, "Y/m/d") }}</i>
                    </label>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="panel panel-default">
            <h3>{{ trans('front-end/profile/update_password.labels.update-password') }}</h3>
            <hr>
            {!! Form::open(['action' => ['Web\UsersController@updatePassword'], 'method' => 'put']) !!}
                <div class="form-group">
                    {!! Form::label(trans('front-end/profile/update_password.labels.new-password')) !!}
                    {!! Form::password('password', ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label(trans('front-end/profile/update_password.labels.confirm-password')) !!}
                    {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label(trans('front-end/profile/update_password.labels.current-password')) !!}
                    {!! Form::password('current_password', ['class' => 'form-control']) !!}
                </div>
                {!! Form::submit(trans('front-end/profile/update_password.buttons.update'), ['class' => 'btn btn-success']) !!}
                {!! Form::reset(trans('front-end/profile/update_password.buttons.reset'), ['class' => 'btn btn-info']) !!}
                <a href="{{ action('Web\UsersController@show', ['id' => Auth::user()->id]) }}" class="btn btn-default">
                <strong>{{ trans('front-end/profile/update_password.buttons.back') }}</strong></a>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
