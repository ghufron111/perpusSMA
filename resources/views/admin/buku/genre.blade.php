@extends('partials.main')

@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Tambah Genre Buku</h1>
</div>

<div class="row">
    <div class="col-lg-6">
        <form method="post" action="{{ route('tambah_genre') }}">
            @csrf

            <div class="mb-3">
                <label for="genre" class="form-label">Genre</label>
                <input type="text" class="form-control" id="genre" name="genre[]" placeholder="Masukkan Genre" required>
            </div>

            <div class="mb-3">
                <label for="books" class="form-label">Pilih Buku</label><br>
                @foreach($book as $books)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="book_{{ $books->id }}" name="books[]" value="{{ $books->id }}">
                        <label class="form-check-label" for="book_{{ $books->id }}">
                            {{ $books->title }}
                        </label>
                    </div>
                @endforeach
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>

@endsection
