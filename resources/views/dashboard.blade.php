@extends('layout.layout')
@section('content')
    <div class="row">
        <div class="col-3">
            @include('shared.left-sidebar')
        </div>
        <div class="col-6">
            @include('shared.success-message')
            @include('koumnits.shared.submit-koumnit')
            <hr>
            @forelse ($koumnits as $koumnit)
                <div class="mt-3">
                    @include('koumnits.shared.koumnit-card')
                </div>
            @empty
                <p class="text-center my-3">No Result Found.</p>
            @endforelse
            <div class="mt-3">
                {{ $koumnits->withQueryString()->links() }}
            </div>

        </div>
        <div class="col-3">
            @include('shared.search-bar')
            @include('shared.follow-box')

        </div>
    </div>
@endsection('content')
