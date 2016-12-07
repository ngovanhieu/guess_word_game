@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @include('layouts.includes.messages')
        @yield('subview')
    </div>
</div>
@endsection
