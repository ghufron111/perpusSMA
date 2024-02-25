<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Main;
use App\Models\Category;
use App\Models\BookCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    public function index(){
        $books = Book::with('bookType')->get();

        return view('admin.buku.manajemenbuku', [
            'book' => $books,
            'tab' => 'Manajemen Buku'
        ]);
    }

    public function form_tambah(){
        return view ('admin.buku.tambahbuku', [
            'tab' => 'Tambah Buku'
        ]);
    }

    public function tambahBuku(Request $request)
    {
        $request->validate([
            'kode_buku' => 'required',
            'judul_buku' => 'required',
            'deskripsi_buku' => 'required',
            'penulis' => 'required',
            'penerbit' => 'required',
            'tahun_terbit' => 'required',
            'model_buku' => 'required',
            'jenis_buku' => 'required|in:1,2',
            'file' => 'required_if:jenis_buku,1|mimes:pdf',
            'fileImage' => 'required_if:jenis_buku,1|image|mimes:jpeg,jpg,png,gif',
        ]);

        $jenisBuku = $request->jenis_buku;
        $status = 'ready';

        $data = [
            'title' => $request->judul_buku,
            'author' => $request->penulis,
            'publisher' => $request->penerbit,
            'year' => $request->tahun_terbit,
            'book_model' => $request->model_buku,
            'status' => $status,
            'book_code' => $request->kode_buku,
            'sinopsis' => $request->deskripsi_buku,
            'book_type' => $jenisBuku,
        ];

        // Save data based on jenis_buku value
        if ($jenisBuku == 1) {
            // Digital
            $data['file_path'] = $this->handleDigitalUpload($request->file('file'));
            $data['cover_path'] = $this->handleFisikUpload($request->file('fileImage'));
        } elseif ($jenisBuku == 2) {
            // Fisik
            if ($request->hasFile('fileImage')) {
                $data['cover_path'] = $this->handleFisikUpload($request->file('fileImage'));
            }
        }

        Main::Simpan('books', $data);

        return redirect('/buku');
    }

    public function form_genre(){
        $books = Book::with('bookType')->get();

        return view('admin.buku.genre', [
            'book' => $books,
            'tab' => 'Genre Buku'
        ]);
    }

    public function tambah_genre(Request $request)
    {
        $request->validate([
            'genre' => 'required|array',
            'genre.*' => 'required|string', // Memastikan setiap item di dalam array genre adalah string
            'books' => 'required|array',
            'books.*' => 'integer|exists:books,id', // Memastikan setiap item di dalam array books adalah integer yang merujuk ke id buku yang ada
        ]);
    
        foreach ($request->genre as $genreName) {
            $genre = Category::firstOrCreate(['name' => $genreName]); // Mencari atau membuat kategori baru jika belum ada
    
            // Memasukkan kategori ke setiap buku yang dipilih
            foreach ($request->books as $bookId) {
                $bookCategory = new BookCategory();
                $bookCategory->book_id = $bookId;
                $bookCategory->category_id = $genre->id;
                $bookCategory->save();
            }
        }

        return redirect ('/buku');
    }


    private function handleDigitalUpload($file)
    {
        // Handle digital file upload logic (e.g., store in public/assets/images/books/digital)
        $path = $file->store('books/digital', 'public');

        // Return the file path or URL
        return asset('storage/' . $path);
    }

    private function handleFisikUpload($file)
    {
        // Handle fisik file upload logic (e.g., store in public/assets/images/books/physic)
        $path = $file->store('books/physic', 'public');

        // Return the file path or URL
        return asset('storage/' . $path);
    }
    
    public function novel(){
            // Periksa apakah pengguna adalah siswa dan statusnya aktif
        if (Auth::check() && Auth::user()->status == 'inactive') {
            // Jika status 'inactive', redirect ke halaman dashboard
            return redirect()->route('client.dashboard');
        }

        // Ambil data buku dengan model 'novel'
        $books = Book::with('bookType')->where('book_model', 'novel')->get();

        // Kirim data buku ke tampilan
        return view('client.buku.novel', [
            'book' => $books,
            'tab' => 'Katalog Novel'
        ]);
    }

    public function majalah(){
        // Periksa apakah pengguna adalah siswa dan statusnya aktif
        if (Auth::check() && Auth::user()->status == 'inactive') {
            // Jika status 'inactive', redirect ke halaman dashboard
            return redirect()->route('client.dashboard');
        }

        $books = Book::with('bookType')->where('book_model', 'majalah')->get();

        return view('client.buku.majalah', [
            'book' => $books,
            'tab' => 'Katalog Majalah'
        ]);
    }

    public function paket(){
        // Periksa apakah pengguna adalah siswa dan statusnya aktif
        if (Auth::check() && Auth::user()->status == 'inactive') {
            // Jika status 'inactive', redirect ke halaman dashboard
            return redirect()->route('client.dashboard');
        }

        $books = Book::with('bookType')->where('book_model', 'paket')->get();

        return view('client.buku.paket', [
            'book' => $books,
            'tab' => 'Katalog Paket'
        ]);
    }

    public function preview($id){
        
        // Menggunakan Query Builder manual untuk mendapatkan data buku dan kategorinya
        $books = Book::with('bookType')->findOrFail($id);
        
        // Menggunakan Query Builder manual untuk mendapatkan kategori buku
        $categories = DB::table('book_categories')
                        ->join('categories', 'book_categories.category_id', '=', 'categories.id')
                        ->where('book_categories.book_id', $id)
                        ->select('categories.*')
                        ->get();

        $tab = 'Preview Buku';

        return view('client.buku.preview.preview', compact('books', 'categories', 'tab'));
    }

    public function hapus($id){
        $result = Main::Hapus('books', array('id'=>$id));

        if ($result =1){
            return redirect('/buku');
        }
    }

    public function ubah($id)
    {
        $books = DB::table('books')->where('id', $id)->first();
        $tab = 'Ubah Buku';
        $isEditMode = true;

        return view('admin.buku.ubahbuku', compact('books', 'tab', 'isEditMode'));
    }

    public function edit(Request $request, $id){
        $request->validate([
            'judul_buku' => 'required',
            'deskripsi_buku' => 'required',
            'penulis' => 'required',
            'penerbit' => 'required',
            'tahun_terbit' => 'required',
        ]);

        $jenisBuku = $request->jenis_buku;

        $book = Book::find($id); // Gantilah $bookId dengan id buku yang sesuai
        if ($book) {
            $jenisBuku = $book->book_type;
        }
    
        $data = [
            'title' => $request->judul_buku,
            'author' => $request->penulis,
            'publisher' => $request->penerbit,
            'year' => $request->tahun_terbit,
            'sinopsis' => $request->deskripsi_buku,
        ];

        // Menangani upload file digital
        if ($jenisBuku == 1 && $request->hasFile('file')) {
            $data['file_path'] = $this->handleDigitalUpload($request->file('file'));
            $data['cover_path'] = $this->handleFisikUpload($request->file('fileImage'));
        }

        // Menangani upload file fisik
        if ($jenisBuku == 2 && $request->hasFile('fileImage')) {
            $data['cover_path'] = $this->handleFisikUpload($request->file('fileImage'));
        }
    
        $where = ['id' => $id];
        Main::Ubah('books', $data, $where);
        return redirect('buku');
    }

}
