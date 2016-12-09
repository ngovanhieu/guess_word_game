<ul class="nav nav-pills nav-stacked panel panel-default sidebar">
    <li role="presentation">
        <a href="#"><strong>{{ trans('admin/home.labels.user-management') }}</strong></a>
        <ul class="nav nav-pills nav-stacked fa-ul">
            <li class="{!! set_active(['admin/subjects/create']) !!}">
                <a href="{!! action('Admin\UsersController@create') !!}">
                    <i class="fa-li fa fa-caret-right"></i>{{ trans('admin/home.buttons.create') }}
                </a>
            </li>
            <li class="{!! set_active(['admin/subjects']) !!}">
                <a href="{!! action('Admin\UsersController@index') !!}">
                    <i class="fa-li fa fa-caret-right"></i>{{ trans('admin/home.buttons.list') }}
                </a>
            </li>
        </ul>
    </li>
    <li role="presentation">
        <a href="#"><strong>{{ trans('admin/home.labels.word-management') }}</strong></a>
        <ul class="nav nav-pills nav-stacked fa-ul">
            <li class="{!! set_active(['admin/subjects/create']) !!}">
                <a href="#">
                    <i class="fa-li fa fa-caret-right"></i>{{ trans('admin/home.buttons.create') }}
                </a>
            </li>
            <li class="{!! set_active(['admin/subjects']) !!}">
                <a href="#">
                    <i class="fa-li fa fa-caret-right"></i>{{ trans('admin/home.buttons.list') }}
                </a>
            </li>
        </ul>
    </li>
</ul>
