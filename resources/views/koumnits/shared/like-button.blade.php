<div>
    @auth
        <button class="fw-light nav-link fs-6 btn btn-link p-0 like-button" data-id="{{ $koumnit->id }}"
            data-liked="{{ Auth::user()->likesKoumnit($koumnit) ? '1' : '0' }}">
            @if (Auth::user()->likesKoumnit($koumnit))
                <span class="fas fa-heart me-1 text-danger"></span>
            @else
                <span class="far fa-heart me-1"></span>
            @endif
            <span class="like-count">{{ $koumnit->likes()->count() }}</span>
        </button>
    @endauth

    @guest
        <a href="{{ route('login') }}" class="fw-light nav-link fs-6">
            <span class="far fa-heart me-1"></span> {{ $koumnit->likes()->count() }}
        </a>
    @endguest
</div>
