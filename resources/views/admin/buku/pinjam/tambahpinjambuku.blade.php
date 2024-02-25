<!-- CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

<!-- JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>


@extends('partials.main')

@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Tambah Buku</h1>
</div>

<div class="row">
    <div class="col-lg-6">
        <form method="post" action="/pinjam/tambah/baru" enctype="multipart/form-data" onsubmit="return validateForm()">
            @csrf

            <div class="mb-3">
                <label for="user_id" class="form-label">Nama</label>
                <select class="form-select select2" id="user_id" name="user_id" style="width: 100%;">
                    <option value="" disabled selected>Pilih Nama Peminjam</option>
                    @foreach ($user as $users)
                    <option value="{{ $users->id }}">{{ $users->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="book_id" class="form-label">Judul Buku</label>
                <select class="form-select select2" id="book_id" name="book_id" style="width: 100%;">
                    <option value="" disabled selected>Pilih Buku</option>
                    @foreach ($book as $books)
                    <option value="{{ $books->id }}">{{ $books->title }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

</div>

<script>
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>

@endsection
