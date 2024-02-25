@extends('partials.main')

@section('container')
<div class="container-fluid" style="margin-top: 1.5rem;">
  <div class="p-4 p-md-6 mb-4 text-white d-flex align-items-center rounded" style="background-color: #55595c; border-color: #55595c;">
      <div class="flex-grow-1 me-5" style="margin-left: 50px;">
          <h1 class="display-0 fst-italic">{{ $books->title }}</h1>
          <p class="lead my-1">{{ $books->author }}</p>
          <p class="lead my-1">{{ $books->year }} | {{ $books->publisher }}</p>
          <p class="lead my-1 category">Genre :
            @foreach ($categories as $category)
                <p class="lead my-1 category">{{ $category->name }} |</p>
            @endforeach
        </p>
            @if($books->status == 'ready')
                <div>
                    <form method="post" action="/buku/pinjam/{{ $books->id }}">
                        @csrf
                        @method('POST')
                        <button type="submit" class="btn btn-primary mb-3 rounded" style="font-weight: bold; font-size: 1.3rem; height: 3rem; width: 10rem;">PINJAM</button>
                    </form>
                </div>
            @else
                <span class="lead my-1 rounded" style="color: #ff0000; font-size: 14px; background: #000000; padding: .25rem;">Buku ini sedang dipinjam Siswa lain</span>
            @endif

      </div>
      <div class="flex-shrink-0" style="margin-right: 50px;">
          <img src="{{ $books->cover_path }}" alt="Deskripsi Gambar" class="img-fluid image-with-shadow" style="border-radius: 5%; height: 250px; width: 200px;">
      </div>
  </div>

  <div class="row mb-2">
    <div class="col-md-6">
        <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm position-relative rounded" style="height: 600px;">
            <div class="p-4 d-flex flex-column position-static">
                <h2 class="display-0 fst-italic" style="margin: 1.5rem;">SINOPSIS</h2>
                <p class="lead my-1" style="font-size: 1.2rem; padding: 1.5rem;">{{ $books->sinopsis }}</p>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm position-relative" style="height: 300px;">
            <div class="p-4 d-flex flex-column position-static">
                <h2 class="display-0 fst-italic">Informasi Peminjaman</h2>
                <p class="lead my-1"><strong>Durasi Peminjaman :</strong> <br>Buku ini dapat dipinjam selama 2 minggu</p>
                <p class="lead my-1"><strong>Aturan Pengembalian :</strong> <br>Buku harus dikembalikan dalam kondisi baik dan tepat waktu. Jika terlambat, akan dikenakan denda sesuai dengan kebijakan perpustakaan</p>
            </div>
        </div>
        <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm position-relative" style="height: 275px;">
            <div class="p-4 d-flex flex-column position-static">
                <h2 class="mb-0 display-0 fst-italic">Ketersediaan Buku</h2>
                <p class="lead my-1"><strong>Status Peminjaman :</strong> <br>
                <span style="color:{{ $books->status == 'ready' ? '#0000ff' : ($books->status == 'dipinjam' ? 'red' : 'black') }}; font-weight:bold; text-transform: capitalize;">{{ $books->status }}</span></p>
            </div>
        </div>
    </div>
</div>


  </div>
</div>



@endsection

<style>
    .category {
        display: inline-block;
        margin-right: 10px; /* Spasi antara setiap kategori */
    }
</style>
