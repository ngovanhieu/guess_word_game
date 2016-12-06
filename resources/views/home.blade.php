@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('front-end/home.labels.dashboard') }}</div>

                <div class="panel-body">
                    {{ trans('front-end/home.labels.loged-in') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
