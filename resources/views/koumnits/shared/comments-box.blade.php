<div>
    <form method="POST" action="{{ route('koumnits.comments.store', $koumnit->id) }}">
        @csrf
        <div class="mb-3">
            <textarea name="content" class="fs-6 form-control" rows="1"></textarea>
        </div>
        <div>
            <button type="submit" class="btn btn-primary btn-sm"> Post Comment </button>
        </div>
    </form>
    <hr>
    @forelse ($koumnit->comments as $comment)
        <div class="d-flex align-items-start mb-3">
            <img style="width: 35px; height: 35px; object-fit: cover;" class="me-2 rounded-circle"
                src="{{ $comment->user->getImageURL() }}" alt="{{ $comment->user->name }}">
            <div class="w-100">
                <div class="d-flex justify-content-between">
                    <h6 class="mb-0">{{ $comment->user->name }}</h6>
                    <small class="fs-6 fw-light text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                </div>
                <p class="fs-6 mt-2 fw-light mb-0">
                    {{ $comment->content }}
                </p>
            </div>
        </div>
    @empty
        <p class="text-center mt-4">No comments found.</p>
    @endforelse
</div>
