@extends('layout.layout')
@section('content')
    <div class="row">
        <div class="col-3">
            @include('shared.left-sidebar')
        </div>
        <div class="col-6">
            <h1>Terms</h1>
            <div>
                but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the
                1960s
                with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop
                publishing
                software like Aldus PageMaker including versions of Lorem Ipsum.
            </div>
        </div>
        <div class="col-3">
            @include('shared.search-bar')
            @include('shared.follow-box')

        </div>
    </div>
@endsection('content')
