@extends('admin.master')

@section('sub-view')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3>{{ trans('admin/words/index.labels.list-word') }}</h3>
        </div>
        <div class="panel-body">
            @if (count($words))
            <table class="table table-bordered">
                <tr class="success">
                    <td>{{ trans('admin/words/index.labels.id') }}</td>
                    <td>{{ trans('admin/words/index.labels.content') }}</td>
                    <td>{{ trans('admin/words/index.labels.status') }}</td>
                    <td>{{ trans('admin/words/index.labels.created_at') }}</td>
                    <td>{{ trans('admin/words/index.labels.updated_at') }}</td>
                    <td>{{ trans('admin/words/index.labels.action') }}</td>
                </tr>
                @foreach ($words as $word)
                {!! Form::open(['action' => ['Admin\WordsController@update', $word->id], 'method' =>  'PATCH']) !!}
                <tr>
                    <td>{{ $word->id }}</td>
                    <td>
                        <a href="{{ action('Admin\WordsController@show', ['id' => $word->id]) }}">
                            {{ $word->content }}
                        </a>
                    </td>
                    <td>{!! Form::select('status', getOptions('options.word-status'), $word->status,
                        ['class' => 'form-control']) !!}</td>
                    <td>{{ $word->created_at }}</td>
                    <td>{{ $word->updated_at }}</td>
                    <td>
                        <div class="btn-group-sm">
                            {!! Form::submit(trans('admin/words/index.buttons.update'), ['class' => 'btn btn-primary']) !!}
                        </div>
                    </td>
                </tr>
                {!! Form::close() !!}
                @endforeach
            </table>
            {!! $words->links() !!}
            @else
            <div class="alert alert-warning" role="alert">
                {{ trans('admin/words/index.labels.empty-list') }}
            </div>    
            @endif
        </div>
    </div>
@endsection
