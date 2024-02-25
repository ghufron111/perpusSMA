
@extends('partials.main')

@section('container')
<div class="container-fluid" style="margin-top: 1.5rem;">
  <div>
    <a href="/buku/tambah/baru" class="btn btn-primary mb-3">Tambahkan Buku Baru</a>
    <a href="/buku/tambah/genre" class="btn btn-primary mb-3">Tambahkan Genre Buku</a>
  </div>
  <h3 class="text-center" style="background-color: #55595c; color: #ffffff; height: 3rem; padding: 5px;">Daftar Buku Perpustakaan SMA NU AL MA'RUF</h3>
  <div class="row">
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
            <th class="text-center">No</th>
            <th class="text-center">Kode Buku</th>
            <th class="text-center">Judul Buku</th>
            <th class="text-center">Penulis</th>
            <th class="text-center">Penerbit</th>
            <th class="text-center">Tahun Terbit</th>
            <!-- <th class="text-center">File EBook</th>
            <th class="text-center">File Cover</th> -->
            <th class="text-center">Tipe Buku</th>
            <th class="text-center">Actions</th>
            </tr>
          </thead>
          <tbody>
            
          @foreach ($book as $books)

            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $books->book_code }}</td>
              <td style="width: 20rem;">{{ $books->title}}</td>
              <td style="width: 15rem;">{!! nl2br(e($books->author)) !!}</td>
              <td>{{ $books->publisher}}</td>
              <td class="text-center">{{ $books->year}}</td>
              <!-- <td>{{ $books->file_path}}</td>
              <td>{{ $books->cover_path }}</td> -->
              <td>{{ $books->bookType->name }}</td>
              <td class="text-center">
                <div class="icon-container" style="justify-content: center; align-items: center;">
                    <a href="/buku/ubah/{{ $books->id }}">
                      <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24" id="edit">
                          <rect width="24" height="24" fill="#005eff"/>
                          <path fill="none" d="M0 0h24v24H0V0z"/>
                          <path d="M3 17.46v3.04c0 .28.22.5.50.5h3.04c.13 0 .26-.05.35-.15L17.81 9.94l-3.75-3.75L3.15 17.10c-.10.10-.15.22-.15.36zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z" fill="#ffffff"/>
                      </svg>
                    </a>

                    <a href="/buku/hapus/{{ $books->id }}">
                      <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 512 512" id="trash">
                        <rect width="512" height="512" fill="#ff0000"/>    
                        <path d="M413.7 133.4c-2.4-9-4-14-4-14-2.6-9.3-9.2-9.3-19-10.9l-53.1-6.7c-6.6-1.1-6.6-1.1-9.2-6.8-8.7-19.6-11.4-31-20.9-31h-103c-9.5 0-12.1 11.4-20.8 31.1-2.6 5.6-2.6 5.6-9.2 6.8l-53.2 6.7c-9.7 1.6-16.7 2.5-19.3 11.8 0 0-1.2 4.1-3.7 13-3.2 11.9-4.5 10.6 6.5 10.6h302.4c11 .1 9.8 1.3 6.5-10.6zM379.4 176H132.6c-16.6 0-17.4 2.2-16.4 14.7l18.7 242.6c1.6 12.3 2.8 14.8 17.5 14.8h207.2c14.7 0 15.9-2.5 17.5-14.8l18.7-242.6c1-12.6.2-14.7-16.4-14.7z" fill="#ffffff"></path>
                      </svg>
                    </a>
                </div>
              </td>
              
            </tr>
            
            @endforeach

          </tbody>
        </table>
    </div>
</div>

@endsection