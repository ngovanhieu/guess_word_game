@extends('front-end.master')

@section('subview')
    <div class="col-md-4">
        <div class="panel panel-default profile-box">
            <h3>{{ trans('front-end/profile/update.labels.profile') }}</h3>
            <div class="well">
                <div>
                    <img src="{{ $user->avatar ? asset(($user->avatar_url)) : asset(config('user.default-avatar')) }}"
                        class="avatar">
                </div>
                <br>
                <div>
                    <label>{{ trans('front-end/profile/update.labels.name') }}:
                        <i>{{ $user->name }}</i>
                    </label>
                </div>
                <div>
                    <label>{{ trans('front-end/profile/update.labels.email') }}:
                        <i>{{ $user->email }}</i>
                    </label>
                </div>
                <div>
                    <label>{{ trans('front-end/profile/update.labels.time-joined') }}:
                        <i>{{ date_format($user->created_at, "Y/m/d") }}</i>
                    </label>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="panel panel-default">
            <h3>{{ trans('front-end/profile/update.labels.update-profile') }}</h3>
            <hr>
            {!! Form::open(['action' => ['Web\UsersController@update', $user->id], 'method' => 'PUT', 'files' => true]) !!}
                <div class="form-group">
                    {!! Form::label('name', trans('front-end/profile/update.labels.name')) !!}
                    {!! Form::text('name', $user->name, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('email', trans('front-end/profile/update.labels.email')) !!}
                    {!! Form::email('email', $user->email, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('avatar', trans('front-end/profile/update.labels.avatar')) !!}
                    {!! Form::file('image', ['class' => 'form-control']) !!}
                </div>
                {!! Form::submit(trans('front-end/profile/update.buttons.update'), ['class' => 'btn btn-success']) !!}
                {!! Form::reset(trans('front-end/profile/update.buttons.reset'), ['class' => 'btn btn-warning']) !!}
                <a href="{{ action('Web\UsersController@show', ['id' => Auth::user()->id]) }}" class="btn btn-default">
                <strong>{{ trans('front-end/profile/update.buttons.back') }}</strong></a>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
