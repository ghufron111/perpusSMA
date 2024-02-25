<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Main;
use App\Models\User;
use App\Models\Laporan;
use App\Models\RentLog;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RentController extends Controller
{
    public function pinjambuku()
    {
        $user_id = Auth::id();

        $book = DB::table('books')
            ->select('books.id', 'books.cover_path', 'books.file_path', 'books.title', 'books.author', 'books.status', 'books_types.name', 'rent_logs.id as rent_log_id', 'rent_logs.actual_return_date as rent_log_actual_return_date',
            'rent_logs.rent_date as rent_log_rent_date', 'rent_logs.return_date as rent_log_return_date')
            ->join('rent_logs', 'books.id', '=', 'rent_logs.book_id')
            ->join('books_types', 'books.book_type', '=', 'books_types.id')
            ->where('rent_logs.user_id', $user_id)
            ->get();

        $rent = DB::table('rent_logs')
            ->select('rent_logs.id', 'rent_logs.user_id', 'rent_logs.book_id', 'rent_logs.rent_date', 'rent_logs.return_date', 'rent_logs.actual_return_date')
            ->join('books', 'books.id', '=', 'rent_logs.book_id')
            ->where('rent_logs.user_id', $user_id)
            ->get();

        $tab = 'Buku Pinjam';

        // Return the result to view or process it as needed
        return view('client.buku.pinjam.pinjambuku', compact('book', 'tab', 'rent'));
    }


    public function pinjam_buku(Request $request, $id){
        $user_id = Auth::user()->id;
        $book = Book::find($id);
        
        $rent_date = Carbon::now()->format('Ymd');
        $return_date = Carbon::now()->addDays(7)->format('Ymd');

        $pinjam = 'dipinjam';
        
        $data = [
            'user_id' => $user_id,
            'book_id' => $book->id,
            'rent_date' => $rent_date,
            'return_date' => $return_date,
        ];

        $databook = [
            'status' => $pinjam,
        ];
        
        Main::Simpan('rent_logs', $data);

        $where = ['id' => $id];
        Main::Ubah('books', $databook, $where);
        return redirect('pinjambuku');
    }

    public function kembali_buku(Request $request, $id){
        
        $rentLog = RentLog::findOrFail($id);

        // Update status buku menjadi 'ready'
        $book = Book::findOrFail($rentLog->book_id);
        $book->status = 'ready';
        $book->save();

        // Mengambil data user
        $user = User::findOrFail($rentLog->user_id);

        // Mengambil tanggal pengembalian
        $returnDate = Carbon::createFromFormat('Y-m-d', $rentLog->return_date);
        $actualReturnDate = Carbon::now();

        // Jika tanggal pengembalian melewati return_date
        if ($actualReturnDate->greaterThan($returnDate)) {
            // Menyimpan keterangan pada tabel user
            $user->status = 'inactive';
            $user->keterangan = 'Anda telat mengembalikan buku.';

            // Simpan perubahan pada tabel user
            $user->save();
        }

        // Mengubah actual_return_date pada rent_log
        $rentLog->actual_return_date = $actualReturnDate->format('Ymd');
        $rentLog->save();

        return redirect('pinjambuku');
        }

        public function hapus_histori_buku(){
            try {
                // Menghapus semua data rent_logs jika actual_return_date sudah terisi
                RentLog::whereNotNull('actual_return_date')->delete();
                
                // Memberikan notifikasi bahwa histori buku yang sudah dikembalikan berhasil dihapus
                session()->flash('success', 'Berhasil menghapus histori buku yang sudah dikembalikan');
    
                // Redirect ke halaman lain, misalnya ke halaman sebelumnya atau ke halaman tertentu
                return redirect()->back();
            } catch (\Exception $e) {
                // Memberikan notifikasi jika terjadi kesalahan
                session()->flash('error', 'Gagal menghapus histori buku: ' . $e->getMessage());
    
                // Redirect ke halaman lain, misalnya ke halaman sebelumnya atau ke halaman tertentu
                return redirect()->back();
            }
        }

        public function pinjam_admin() {
            // Retrieve all users
            $users = User::all();
            
            // Retrieve all rent logs with associated user information
            $rentLogs = RentLog::with('user')->get();
            
            // Retrieve all books along with their rental information
            $books = DB::table('books')
                ->select(
                    'books.id',
                    'books.cover_path',
                    'books.file_path',
                    'books.title',
                    'books.author',
                    'books_types.name',
                    'rent_logs.id as rent_log_id'
                )
                ->leftJoin('rent_logs', 'books.id', '=', 'rent_logs.book_id')
                ->leftJoin('users', 'users.id', '=', 'rent_logs.user_id')
                ->join('books_types', 'books.book_type', '=', 'books_types.id')
                ->get();
            
            // Retrieve all rental logs with associated book and user information
            $rents = DB::table('rent_logs')
                ->select(
                    'rent_logs.id',
                    'rent_logs.user_id',
                    'rent_logs.book_id',
                    'rent_logs.rent_date',
                    'rent_logs.return_date',
                    'rent_logs.actual_return_date',
                    'books.title'
                )
                ->join('books', 'books.id', '=', 'rent_logs.book_id')
                ->join('users', 'users.id', '=', 'rent_logs.user_id')
                ->get();
            
            $tab = 'Buku Pinjam';
            
            // Return the result to the view
            return view('admin.buku.pinjam.pinjambuku', compact('books', 'tab', 'rents', 'users', 'rentLogs'));
        }
        
        public function pinjam_buku_tambah(){
            $user = User::all()->where('role_id','2');
            $book = Book::all()->where('status','ready');

            $tab = 'Buku Pinjam Baru';
            
            // Return the result to the view
            return view('admin.buku.pinjam.tambahpinjambuku', compact('book', 'tab', 'user'));
        }

        public function pinjam_buku_tambah_baru(Request $request) {
            $user_id = $request->input('user_id');
            $book_id = $request->input('book_id');

            $rent_date = Carbon::now();
            $return_date = $rent_date->copy()->addDays(7);

            $pinjam = 'dipinjam';
            
            // Create a new entry in the rent_logs table
            $rentLog = new RentLog();
            $rentLog->user_id = $user_id;
            $rentLog->book_id = $book_id;
            $rentLog->rent_date = $rent_date;
            $rentLog->return_date = $return_date;
            $rentLog->save();

            // Update the status of the book
            $book = Book::findOrFail($book_id);
            $book->status = $pinjam;
            $book->save();
            
            return redirect('pinjam');
        }

        public function admin_kembali_buku($id){
            $rentLog = RentLog::findOrFail($id);

            // Update status buku menjadi 'ready'
            $book = Book::findOrFail($rentLog->book_id);
            $book->status = 'ready';
            $book->save();

            // Mengambil data user
            $user = User::findOrFail($rentLog->user_id);

            // Mengambil tanggal pengembalian
            $returnDate = Carbon::createFromFormat('Y-m-d', $rentLog->return_date);
            $actualReturnDate = Carbon::now();

            // Jika tanggal pengembalian melewati return_date
            if ($actualReturnDate->greaterThan($returnDate)) {
                // Menyimpan keterangan pada tabel user
                $user->status = 'inactive';
                $user->keterangan = 'Anda telat mengembalikan buku.';

                // Simpan perubahan pada tabel user
                $user->save();
            }

            // Mengubah actual_return_date pada rent_log
            $rentLog->actual_return_date = $actualReturnDate->format('Ymd');
            $rentLog->save();

            return redirect('pinjam');
        }

        public function admin_pinjam_hapus($id){
            try {
                // Menghapus data rent_logs berdasarkan id
                RentLog::where('id', $id)->delete();
                
                // Memberikan notifikasi bahwa histori buku berhasil dihapus
                session()->flash('success', 'Berhasil menghapus histori buku');
                
                // Redirect ke halaman lain, misalnya ke halaman sebelumnya atau ke halaman tertentu
                return redirect()->back();
            } catch (\Exception $e) {
                // Memberikan notifikasi jika terjadi kesalahan
                session()->flash('error', 'Gagal menghapus histori buku: ' . $e->getMessage());
                
                // Redirect ke halaman lain, misalnya ke halaman sebelumnya atau ke halaman tertentu
                return redirect()->back();
            }
        }
        
        public function laporan_cetak() {
            // Retrieve all rental logs with associated book and user information
            $rents = Laporan::with('user', 'book')->orderBy('rent_logs_id')->get();
        
            $tab = 'Cetak Laporan';
            
            // Return the result to the view
            return view('admin.laporan.cetaklaporan', compact('rents', 'tab'));
        }
        
        public function laporan() {
            // Retrieve all rental logs with associated book and user information
            $rents = Laporan::with('user', 'book')->orderBy('rent_logs_id')->get();
        
            $tab = 'Laporan';
            
            // Return the result to the view
            return view('admin.laporan.laporan', compact('rents', 'tab'));
        }
        
        public function laporan_filter_cetak(Request $request) {
            // Retrieve all rental logs with associated book and user information within the specified date range
                $rents = Laporan::with('user', 'book')
                ->whereBetween('rent_date', [$request->tgl_mulai, $request->tgl_selesai])
                ->orderBy('rent_logs_id')
                ->get();

            $tab = 'Laporan';

            // Return the result to the view
            return view('admin.laporan.cetaklaporanfilter', compact('rents', 'tab'));
        }
        
        public function laporan_filter(Request $request) {
            // Validate the form input
            $request->validate([
                'tgl_mulai' => 'required|date',
                'tgl_selesai' => 'required|date|after_or_equal:tgl_mulai',
            ]);

            // Retrieve all rental logs with associated book and user information within the specified date range
            $rents = Laporan::with('user', 'book')
                            ->whereBetween('rent_date', [$request->tgl_mulai, $request->tgl_selesai])
                            ->orderBy('rent_logs_id')
                            ->get();
        
            $tab = 'Laporan';
            
            // Return the result to the view
            return view('admin.laporan.laporanfilter', compact('rents', 'tab'));
        }
        
}
