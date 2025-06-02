<div>
    @auth

        @if (Auth::user()->likesKoumnit($koumnit))
            <form action="{{ route('koumnits.unlike', $koumnit->id) }}" method="POST">
                @csrf
                <button type="submit" class="fw-light nav-link fs-6"> <span class="fas fa-heart me-1">
                    </span> {{ $koumnit->likes()->count() }} </button>
            </form>
        @else
            <form action="{{ route('koumnits.like', $koumnit->id) }}" method="POST">
                @csrf
                <button type="submit" class="fw-light nav-link fs-6"> <span class="far fa-heart me-1">
                    </span> {{ $koumnit->likes()->count() }} </button>
            </form>
        @endif
    @endauth
    @guest
        <a href="{{route('login')}}" class="fw-light nav-link fs-6"> <span class="far fa-heart me-1">
            </span> {{ $koumnit->likes()->count() }} </a>
    @endguest
</div>
