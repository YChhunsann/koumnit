@auth
    <h4> Share yours ideas </h4>
    <div class="row">
        <form action="{{ route('koumnits.store') }}" method="post">
            @csrf
            <div class="mb-3">
                <textarea name="content" class="form-control" id="content" rows="3"></textarea>
                @error('content')
                    <div class="d-block fs-6 text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="">
                <button type="submit" class="btn btn-dark"> Share </button>
            </div>
        </form>
    </div>
@endauth
@guest
    <h4>Login To Share Your Koumnit</h4>
@endguest