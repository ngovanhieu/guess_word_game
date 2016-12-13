@extends('admin.master')

@section('sub-view')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3>{{ trans('admin/words/show.labels.show-word') }}</h3>
        </div>
        <div class="panel-body">
            <ul class="nav nav-pills">
                <li class="active">
                    <a data-toggle="pill" href="#details">{{ trans('admin/words/show.labels.details') }}</a>
                </li>
                <li>
                    <a data-toggle="pill" href="#history">{{ trans('admin/words/show.labels.history') }}</a>
                </li>
            </ul>
            <div class="tab-content">
            <hr>
                <div id="details" class="tab-pane fade in active">
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">
                                {{ trans('admin/words/show.labels.content') }}:
                            </label>
                            <div class="col-sm-10">
                                <p class="form-control-static">{{ $word->content }}</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">
                                {{ trans('admin/words/show.labels.status') }}:
                            </label>
                            <div class="col-sm-10">
                                <p class="form-control-static">
                                    {{ trans('admin/words/show.status.' . $word->status) }}
                                </p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">
                                {{ trans('admin/words/show.labels.created_at') }}:
                            </label>
                             <div class="col-sm-10">
                                <p class="form-control-static">{{ $word->created_at }}</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">
                                {{ trans('admin/words/show.labels.updated_at') }}:
                            </label>
                            <div class="col-sm-10">
                                <p class="form-control-static">{{ $word->updated_at }}</p>
                            </div>
                        </div>
                    </form>
                </div>
                <div id="history" class="tab-pane fade">
                    <h3>{{ trans('admin/words/show.labels.history') }}</h3>
                </div>
            </div>
        </div>
    </div>
@endsection
