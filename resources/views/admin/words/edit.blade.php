@extends('admin.master')

@section('sub-view')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3>{{ trans('admin/words/edit.labels.edit-word') }}</h3>
        </div>
        <div class="panel-body">
            {!! Form::open(['action' => ['Admin\WordsController@update', $word->id], 'method' => 'PUT',
                'class' => 'form-horizontal']) !!}
                <div class="form-group">
                    {!! Form::label('content', trans('admin/words/edit.labels.content'), ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-10">
                        {!! Form::text('content', $word->content, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        {!! Form::submit(trans('admin/words/edit.buttons.update'), ['class' => 'btn btn-success']) !!}
                        {!! Form::reset(trans('admin/words/edit.buttons.reset'), ['class' => 'btn btn-default']) !!}
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
