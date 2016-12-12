@extends('admin.master')

@section('sub-view')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3>{{ trans('admin/users/show.labels.show-user') }}</h3>
        </div>
        <div class="panel-body">
            <ul class="nav nav-pills">
                <li class="active">
                    <a data-toggle="pill" href="#details">{{ trans('admin/users/show.labels.details') }}</a>
                </li>
                <li>
                    <a data-toggle="pill" href="#history">{{ trans('admin/users/show.labels.history') }}</a>
                </li>
            </ul>
            <div class="tab-content">
            <hr>
                <div id="details" class="tab-pane fade in active">
                    <form class="form-horizontal">
                    <div class="form-group">
                            <label class="col-sm-2 control-label"></label>
                            <div class="col-md-4">
                                <img src="{{ $user->avatar ? asset(($user->avatar_url)) : asset(config('user.default-avatar')) }}"
                                    class="avatar">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">
                                {{ trans('admin/users/show.labels.name') }}:
                            </label>
                            <div class="col-sm-10">
                                <p class="form-control-static">{{ $user->name }}</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">
                                {{ trans('admin/users/show.labels.email-address') }}:
                            </label>
                            <div class="col-sm-10">
                                <p class="form-control-static">{{ $user->email }}</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">
                                {{ trans('admin/users/show.labels.role') }}:
                            </label>
                            <div class="col-sm-10">
                                <p class="form-control-static">{{ trans('options.role.' . $user->role) }}</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">
                                {{ trans('admin/users/show.labels.joined-at') }}:
                            </label>
                            <div class="col-sm-10">
                                <p class="form-control-static">{{ date_format($user->created_at, "Y/m/d - h:i") }}</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">
                                {{ trans('admin/users/show.labels.updated-at') }}:
                            </label>
                            <div class="col-sm-10">
                                <p class="form-control-static">{{ date_format($user->updated_at, "Y/m/d - h:i") }}</p>
                            </div>
                        </div>
                        @if ($user->isMember())
                        <div class="form-group">
                            <div class="col-sm-10">
                                <a href="{{ action('Admin\UsersController@edit', ['id' => $user->id]) }}" class="btn btn-success">  
                                    {{ trans('admin/users/show.buttons.update') }}
                                </a>
                            </div>
                        </div>
                        @endif
                    </form>
                </div>
                <div id="history" class="tab-pane fade">
                    <h3>{{ trans('admin/users/show.labels.history') }}</h3>
                </div>
            </div>
        </div>
    </div>
@endsection
