<?php

namespace App\Models;

use App\Models\Book;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BooksType extends Model
{
    protected $table = 'books_types'; // Sesuaikan dengan nama tabel yang sesuai

    protected $fillable = [
        'name',
        // Tambahkan kolom-kolom lain yang Anda butuhkan
    ];

    public function books()
    {
        return $this->hasMany(Book::class, 'book_type'); // Sesuaikan dengan nama kolom foreign key di tabel 'books'
    }
}
