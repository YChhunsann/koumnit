@auth
    <h4> Share yours ideas </h4>
    <div class="row">
        <form action="{{ route('koumnits.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <textarea name="content" class="form-control" id="content" rows="8"></textarea>
                @error('content')
                    <div class="d-block fs-6 text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <input type="file" name="image" class="form-control">
                @error('image')
                    <div class="d-block fs-6 text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <button type="submit" class="btn btn-dark">Share</button>
            </div>
        </form>
    </div>
@endauth
@guest
    <h4>Login To Share Your Koumnit</h4>
@endguest
