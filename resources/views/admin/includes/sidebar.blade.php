<ul class="nav nav-pills nav-stacked panel panel-default sidebar">
    <li role="presentation">
        <a href="#"><strong>{{ trans('admin/home.labels.user-management') }}</strong></a>
        <ul class="nav nav-pills nav-stacked fa-ul">
            <li class="{!! set_active(['admin/users/create']) !!}">
                <a href="{!! action('Admin\UsersController@create') !!}">
                    <i class="fa-li fa fa-caret-right"></i>{{ trans('admin/home.buttons.create') }}
                </a>
            </li>
            <li class="{!! set_active(['admin/users']) !!}">
                <a href="{!! action('Admin\UsersController@index') !!}">
                    <i class="fa-li fa fa-caret-right"></i>{{ trans('admin/home.buttons.list') }}
                </a>
            </li>
        </ul>
    </li>
    <li role="presentation">
        <a href="#"><strong>{{ trans('admin/home.labels.word-management') }}</strong></a>
        <ul class="nav nav-pills nav-stacked fa-ul">
            <li class="{!! set_active(['admin/words/create']) !!}">
                <a href="{!! action('Admin\WordsController@create') !!}">
                    <i class="fa-li fa fa-caret-right"></i>{{ trans('admin/home.buttons.create') }}
                </a>
            </li>
            <li class="{!! set_active(['admin/words']) !!}">
                <a href="{!! action('Admin\WordsController@index') !!}">
                    <i class="fa-li fa fa-caret-right"></i>{{ trans('admin/home.buttons.list') }}
                </a>
            </li>
        </ul>
    </li>
</ul>
