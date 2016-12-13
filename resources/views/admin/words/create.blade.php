@extends('admin.master')

@section('sub-view')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3>{{ trans('admin/words/create.labels.create-word') }}</h3>
        </div>
        <div class="panel-body">
            {!! Form::open(['action' => ['Admin\WordsController@store', 'method' => 'POST'], 'class' => 'form-horizontal']) !!}
                <div class="form-group">
                    {!! Form::label('content', trans('admin/words/create.labels.content'), ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-10">
                        {!! Form::text('content', old('content'), ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('status', trans('admin/words/create.labels.status'), ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-10">
                        {!! Form::select('status', getOptions('options.word-status'), null, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        {!! Form::submit(trans('admin/words/create.buttons.create'), ['class' => 'btn btn-success']) !!}
                        {!! Form::reset(trans('admin/words/create.buttons.reset'), ['class' => 'btn btn-default']) !!}
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
