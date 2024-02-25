@extends('partials.main')

@section('container')

<div class="container-fluid" style="margin-top: 1.5rem;">
    <div class="row">
        <form action="/laporan/filter" method="post">
            @csrf <!-- Tambahkan ini untuk melindungi formulir dari serangan CSRF -->
            <div class="d-flex">
                <h3 class="col-7"></h3>
                <div class="col-3" style="padding-right: 15px; width: 10rem;">
                    <input type="date" name="tgl_mulai" class="form-control btn-sm btn-outline-secondary" required>
                    <small><p>Tanggal Mulai</p></small>
                </div>
                <div class="col-3" style="padding-right: 15px; width: 10rem;">
                    <input type="date" name="tgl_selesai" class="form-control btn-sm btn-outline-secondary" required>
                    <small><p>Tanggal Selesai</p></small>
                </div>
                <div style="padding-right: 15px;">
                    <button type="submit" class="btn btn-sm btn-outline-secondary">Tampilkan</button>
                </div>
                <div style="padding-right: 15px;">
                    <button type="button" class="btn btn-sm btn-outline-secondary" onclick="cetakLaporan()">Cetak</button>
                </div>
            </div>
        </form>

        <h3 class="text-center" style="background-color: #55595c; color: #ffffff; height: 3rem; padding: 5px;">Laporan Peminjaman Buku Perpustakaan SMA NU AL MA'RUF</h3>
        <div class="table-responsive">
            <table class="table table-striped table-sm">
            <thead>
                <tr>
                <th class="text-center">No</th>
                <th class="text-center">ID Pinjam</th>
                <th class="text-center">Nama Peminjam</th>
                <th class="text-center">Buku Yang Dipinjam</th>
                <th class="text-center">Tanggal Peminjaman</th>
                <th class="text-center">Lama Peminjaman</th>
                <th class="text-center">Tanggal Pengembalian</th>
                </tr>
            </thead>
            <tbody>
                
                @foreach ($rents as $index => $rent)
                    <tr class="table-row">
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td style="width: 5rem;">{{ $rent->rent_logs_id }}</td>
                        <td style="width: 15rem;">{{ $rent->user->name }}</td>
                        <td style="width: 20rem;">{{ $rent->book->title }}</td>
                        <td class="text-center">{{ $rent->rent_date }}</td>
                        <td class="text-center">{{ $rent->return_date }}</td>
                        <td class="text-center">{{ $rent->actual_return_date }}</td>
                    </tr>
                @endforeach

            </tbody>
            </table>
        </div>
    </div>
</div>


@endsection

<script>
    function cetakLaporan() {
        // Redirect ke URL cetak tanpa menyertakan tanggal mulai dan tanggal selesai
        window.location.href = "/laporan/cetak";
    }
    
</script>