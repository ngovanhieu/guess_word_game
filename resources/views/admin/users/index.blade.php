@extends('admin.master')

@section('sub-view')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3>{{ trans('admin/users/index.labels.list-user') }}</h3>
            {!! Form::open(['action' => ['Admin\UsersController@index'], 'method' =>  'GET']) !!}
                <div class="col-sm-5">
                    {!! Form::text('key-word', $keyWord, ['class' => 'form-control',
                        'placeholder' => trans('admin/users/index.placeholder.search')]) !!}
                </div>
                {!! Form::submit(trans('admin/users/index.buttons.search'), ['class' => 'btn btn-success']) !!} 
            {!! Form::close() !!}
        </div>
        <div class="panel-body">
            @if (count($users))
            <table class="table table-bordered">
                <tr>
                    <td>
                        @sortablelink('id', trans('admin/users/index.labels.id'))
                    </td>
                    <td>
                        @sortablelink('name', trans('admin/users/index.labels.name'))
                    </td>
                    <td>
                        {{ trans('admin/users/index.labels.email-address') }}
                    </td>
                    <td>
                        @sortablelink('role', trans('admin/users/index.labels.role'))
                    </td>
                    <td>{{ trans('admin/users/index.labels.action') }}</td>
                </tr>
                @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>
                        <a href="{{ action('Admin\UsersController@show', ['id' => $user->id]) }}">
                            {{ $user->name }}
                        </a>
                    </td>
                    <td>{{ $user->email }}</td>
                    <td>{{ trans('options.role.' . $user->role) }}</td>
                    <td>
                    @if ($user->isMember())
                        {!! Form::open(['action' => ['Admin\UsersController@destroy', $user->id], 'method' =>  'DELETE']) !!}
                        <div class="btn-group-sm">
                            <a href="{{ action('Admin\UsersController@edit', ['id' => $user->id]) }}" class="btn btn-warning">
                                {{ trans('admin/users/index.buttons.edit') }}
                            </a>
                            {!! Form::submit(trans('admin/users/index.buttons.delete'), ['class' => 'btn btn-danger confirm']) !!}
                        </div>
                        {!! Form::close() !!}
                    @endif
                    </td>
                </tr>
                @endforeach
            </table>
            {!! $users->appends(request()->input())->links() !!}
            @else
            <div class="alert alert-warning" role="alert">
                {{ trans('admin/users/index.labels.empty-list') }}
            </div>    
            @endif
        </div>
    </div>
@endsection
@push('script')
    <script type="text/javascript">
        var confirmation = "{{trans('admin/users/index.delete.confirm')}}";
    </script>
@endpush
