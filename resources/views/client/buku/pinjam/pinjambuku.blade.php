@extends('partials.main')

@section('styles')
    <style>
        /* Tambahkan CSS responsif di sini */
        .book-item {
            flex: 0 0 100%; /* Setiap buku akan menempati seluruh lebar pada layar kecil */
            max-width: 100%; /* Maksimum lebar untuk setiap buku */
        }

        .preview-container {
            position: sticky;
            top: 50px; /* Atur jarak dari bagian atas layar, disesuaikan dengan kebutuhan Anda */
            width: 250px; /* Atur lebar preview box */
            max-height: calc(100vh - 50px); /* Maksimum tinggi preview box sesuai tinggi layar, dikurangi jarak dari atas (50px) */
            overflow-y: auto; /* Aktifkan pengguliran vertikal jika konten melebihi tinggi maksimum */
            margin-left: auto; /* Membuat preview container tetap berada di samping kanan */
        }

        .preview-content img {
            max-width: 100%;
            height: auto;
        }

        .preview-container .row {
            margin-right: 0;
            margin-left: 0;
        }
    </style>
@endsection

@section('container')

<div class="container-fluid" style="margin-top: 1.5rem;">
    <div>
        <a href="/pinjambuku/hapus" class="btn btn-primary mb-3">Hapus Histori Peminjaman</a>
    </div>
    <h3 class="text-center" style="background-color: #55595c; color: #ffffff; height: 3rem; padding: 5px;">Koleksi Pinjam</h3>
    <div class="row">
        <div class="col-md-9"> <!-- Bagian kiri untuk daftar buku -->
            <div class="row mb-3">
                @foreach ($book as $index => $books)
                    <div class="col-md-3 mb-2 book-item" style="width: 270px;"> <!-- Tambahkan kelas book-item untuk setiap kotak buku -->
                        <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm position-relative rounded">
                            <div class="col p-4">
                                <a href="#" class="book-link" data-index="{{ $index }}"> <!-- Tambahkan data-index untuk mengidentifikasi buku -->
                                    @if (Str::startsWith($books->cover_path, ['http://', 'https://']))
                                        <center><img src="{{ $books->cover_path }}" alt="Cover Image" width="150" height="200"></center>
                                    @elseif (Str::startsWith($books->file_path, ['http://', 'https://']))
                                        <iframe src="https://docs.google.com/viewer?url={{ urlencode($books->file_path) }}&embedded=true" style="width:100%; height:250px;" frameborder="0"></iframe>
                                    @endif
                                </a>
                            </div>
                            <div class="col p-4" style="height: auto; padding-top: 10px;"> <!-- Mengatur padding-top untuk mengurangi jarak -->
                                <div class="d-flex flex-column position-static">
                                    <strong class="d-inline-block mb-2 text-primary">{{ $books->name }}</strong>
                                    <h6 class="mb-0">{{ $books->title }}</h6>
                                    <div class="mb-1 text-muted">{{ $books->author }}</div>
                                    <p class="mb-1 text-muted">Tanggal Peminjaman : <br />{{ $books->rent_log_rent_date }}</p> 
                                    <p class="mb-1 text-muted">Lama Peminjaman : <br />{{ $books->rent_log_return_date }}</p> 
                                    <p class="mb-1 text-muted">Tanggal Pengembalian : <br />{{ $books->rent_log_actual_return_date }}</p>
                                </div>
                            </div>
                            @if ($books->rent_log_actual_return_date == null) 
                                <div class="col p-4">
                                    @if ($books->file_path !== null)
                                        <a href="{{ $books->file_path }}" class="btn btn-sm btn-outline-secondary" style="width: 100%;">Baca</a>
                                    @endif
                                        <form method="post" action="/pinjambuku/kembali/{{ $books->rent_log_id }}">
                                            @csrf
                                            <button type="submit" style="width: 100%; margin-top: 10px;" class="btn btn-danger return-book">Kembalikan Buku</button>
                                        </form>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection
