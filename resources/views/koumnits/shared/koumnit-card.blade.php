<div class="card">
    <div class="px-3 pt-4 pb-2">
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <img src="{{ $koumnit->user->getImageURL() }}" alt="{{ $koumnit->user->name }}"
                    style="width: 50px; height: 50px; object-fit: cover;" class="me-2 rounded-circle" />

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
            <form action="{{ route('koumnits.update', $koumnit->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="mb-3">
                    <textarea name="content" class="form-control" id="content" rows="3">{{ $koumnit->content }}</textarea>
                    @error('content')
                        <div class="d-block fs-6 text-danger">{{ $message }}</div>
                    @enderror
                </div>
                {{-- updating image --}}
                <div class="mb-3">
                    <input type="file" name="image" class="form-control">
                    @error('image')
                        <div class="d-block fs-6 text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="">
                    <button type="submit" class="btn btn-dark mb-2 btn-sm"> Update </button>
                </div>
            </form>
        @else
            @php
                $converter = new \League\CommonMark\CommonMarkConverter([
                    'html_input' => 'strip',
                    'allow_unsafe_links' => false,
                ]);
            @endphp

            <div class="fs-5 markdown-content">
                {!! $converter->convert($koumnit->content)->getContent() !!}
            </div>



            {{-- Show the uploaded image if it exists --}}
            @if ($koumnit->image)
                <div class="d-flex justify-content-center">
                    <img src="{{ asset('storage/' . $koumnit->image) }}" alt="Koumnit Image"
                        class="img-fluid rounded mb-3" style="max-height: 400px; object-fit: contain;">
                </div>
            @endif

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
