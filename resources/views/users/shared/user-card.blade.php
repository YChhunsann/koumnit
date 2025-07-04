<div class="card">
    <div class="px-3 pt-4 pb-2">
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <img style="width: 50px; height: 50px; object-fit: cover;" class="me-2 rounded-circle"
                    src="{{ $user->getImageURL() }}" alt="{{ $user->name }}">
                <div>

                    <h3 class="card-title mb-0"><a href="#"> {{ $user->name }}
                        </a></h3>
                    <span class="fs-6 text-muted">{{ $user->email }}</span>

                </div>
            </div>
            <div>
                @can('profile.update', $user)
                    <a href="{{ route('users.edit', $user->id) }}"> Edit </a>
                @endcan
            </div>
        </div>
        <div class="px-2 mt-4">
            <h5 class="fs-5"> Bio : </h5>

            <p class="fs-6 fw-light">
                {{ $user->bio }}
            </p>
            @include('users.shared.user-stats')
            @auth
                @if (Auth::id() !== $user->id)
                    <div class="mt-3">
                        @if (Auth::user()->follows($user))
                            <form method="POST" action="{{ route('users.unfollow', $user->id) }}">
                                @csrf
                                <button class="btn btn-danger btn-sm" type="submit"> Unfollow </button>
                            </form>
                        @else
                            <form method="POST" action="{{ route('users.follow', $user->id) }}">
                                @csrf
                                <button class="btn btn-primary btn-sm" type="submit"> Follow </button>
                            </form>
                        @endif
                    </div>
                @endif
            @endauth
        </div>
    </div>
</div>
