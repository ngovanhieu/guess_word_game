@extends('admin.master')

@section('sub-view')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3>{{ trans('admin/words/index.labels.list-word') }}</h3>
        </div>
        <div class="panel-body">
            @if (count($words))
            <table class="table table-bordered">
                <tr>
                    <td>{{ trans('admin/words/index.labels.id') }}</td>
                    <td>{{ trans('admin/words/index.labels.content') }}</td>
                    <td>{{ trans('admin/words/index.labels.created_at') }}</td>
                    <td>{{ trans('admin/words/index.labels.updated_at') }}</td>
                    <td>{{ trans('admin/words/index.labels.action') }}</td>
                </tr>
                @foreach ($words as $word)
                <tr>
                    <td>{{ $word->id }}</td>
                    <td>
                        <a href="{{ action('Admin\WordsController@show', ['id' => $word->id]) }}">
                            {{ $word->content }}
                        </a>
                    </td>
                    <td>{{ $word->created_at }}</td>
                    <td>{{ $word->updated_at }}</td>
                    <td>
                        {!! Form::open(['action' => ['Admin\WordsController@destroy', $word->id], 'method' =>  'DELETE']) !!}
                        <div class="btn-group-sm">
                            <a href="{{ action('Admin\WordsController@edit', ['id' => $word->id]) }}" class="btn btn-warning">
                                {{ trans('admin/words/index.buttons.edit') }}
                            </a>
                            {!! Form::submit(trans('admin/words/index.buttons.delete'), ['class' => 'btn btn-danger']) !!}
                        </div>
                        {!! Form::close() !!}
                    </td>
                </tr>
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
