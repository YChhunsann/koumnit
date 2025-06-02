<div class="card">
    <div class="px-3 pt-4 pb-2">
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <img style="width:50px" class="me-2 avatar-sm rounded-circle" src="{{ $koumnit->user->getImageURL() }}"
                    alt="{{ $koumnit->user->name }}">
                <div>
                    <h5 class="card-title mb-0"><a href="{{ route('users.show', $koumnit->user->id) }}">
                            {{ $koumnit->user->name }} </a></h5>
                </div>
            </div>
            <div class="d-flex align-items-center">
                <a href="{{ route('koumnits.show', $koumnit->id) }}" class="text-decoration-none">view</a>
                @can('koumnit.delete', $koumnit)
                    <form action="{{ route('koumnits.destroy', $koumnit->id) }}" method="post"
                        class="d-flex align-items-center me-3">
                        @csrf
                        @method('delete')
                        <a href="{{ route('koumnits.edit', $koumnit->id) }}" class="mx-2">edit</a>
                        <button type="submit" class="btn btn-danger btn-sm">x</button>
                    </form>
                @endcan
            </div>
        </div>
    </div>

    <div class="card-body">
        @if ($editing ?? false)
            <form action="{{ route('koumnits.update', $koumnit->id) }}" method="post">
                @csrf
                @method('put')
                <div class="mb-3">
                    <textarea name="content" class="form-control" id="content" rows="3">{{ $koumnit->content }}</textarea>
                    @error('content')
                        <div class="d-block fs-6 text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="">
                    <button type="submit" class="btn btn-dark mb-2 btn-sm"> Update </button>
                </div>
            </form>
        @else
            <p class="fs-6 fw-light text-muted">
                {{ $koumnit->content }}
            </p>
        @endif
        <div class="d-flex justify-content-between">
            @include('koumnits.shared.like-button')
            <div>
                <span class="fs-6 fw-light text-muted"> <span class="fas fa-clock"> </span>
                    {{ $koumnit->created_at->diffForHumans() }} </span>
            </div>
        </div>
        @include('koumnits.shared.comments-box')
    </div>

</div>
