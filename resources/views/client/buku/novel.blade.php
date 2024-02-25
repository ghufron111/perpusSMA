@extends('partials.main')

@section('container')
<div class="container-fluid" style="margin-top: 1.5rem;">
    <div class="p-4 p-md-6 mb-4 text-white d-flex align-items-center rounded" style="background-color: #55595c; border-color: #55595c; margin-right: 1.5rem;">
            <div class="flex-grow-1 me-5">
                <h1 class="display-0 fst-italic">KATALOG NOVEL</h1>
                <p class="lead my-3">Selamat datang di Katalog Buku Perpustakaan SMA NU AL MA'RUF. Temukan ribuan judul dari berbagai genre buku dan mulai petualangan literatur Anda. Temukan buku terbaru, ulasan, dan rekomendasi untuk memperluas wawasan Anda. Mari bersama-sama menjelajahi dunia pengetahuan!</p>
            </div>
            
            <div class="flex-shrink-0">
                <img src="/assets/images/header_katalog_novel.jpg" alt="Deskripsi Gambar" class="img-fluid image-with-shadow" style="border-radius: 5%; height: 250px; width: 200px;">
            </div>
    </div>

    <div class="row mb-2">
        @foreach ($book as $index => $books)
            @if ($index % 2 == 0)
                <div class="row mb-2">
            @endif

                    <div class="col-md-6">
                        <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm position-relative rounded">
                            <div class="col p-4 d-flex flex-column position-static">
                                <strong class="d-inline-block mb-2 text-primary">{{ $books->bookType->name }}</strong>
                                <h6 class="mb-0">{{ $books->title }}</h6>
                                <div class="mb-1 text-muted">{{ $books->author }}</div>
                                <h6 class="mb-0">Sinopsis : </h6>
                                <p class="card-text mb-auto">
                                    {{ Str::limit($books->sinopsis, $limit = 100, $end = '...') }}
                                    @if (strlen($books->sinopsis) > 100)
                                        <a href="/buku/preview/{{ $books->id }}">Baca Selengkapnya</a>
                                    @endif
                                </p>
                            </div>
                            <div class="col-auto d-none d-lg-block">
                                <a href="/buku/preview/{{ $books->id }}">
                                    @if (Str::startsWith($books->cover_path, ['http://', 'https://']))
                                        <img src="{{ $books->cover_path }}" alt="Cover Image" width="200" height="250">
                                    @elseif (Str::startsWith($books->file_path, ['http://', 'https://']))
                                        <?php
                                            $filePath = public_path("storage/books/digital/{$books->file_path}");
                                        ?>
                                        <embed src="{{ $filePath }}" type="application/pdf" width="200" height="250">
                                    @else
                                        <svg class="bd-placeholder-img" width="200" height="250" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false">
                                            <title>Placeholder</title>
                                            <rect width="100%" height="100%" fill="#55595c"/>
                                            <text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text>
                                        </svg>
                                    @endif
                                </a>
                            </div>
                        </div>
                    </div>

            @if ($index % 2 != 0)
                </div>
            @endif

        @endforeach
    </div>
</div>
@endsection

