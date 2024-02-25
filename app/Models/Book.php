<?php

namespace App\Models;

use App\Models\User;
use App\Models\Laporan;
use App\Models\RentLog;
use App\Models\BooksType;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    protected $guarded =['id'];
        //MENAMPILKAN DATA
        public static function post_by($userId)
        {
        $query=DB::table('posts')
        ->select('*')
        ->where('username', $userId)
        ->get();
        return $query;
        }

        protected $fillable = [
            'title',
            'author',
            'published_date',
            'book_type', // Sesuaikan dengan nama kolom foreign key di tabel 'books'
            // Tambahkan kolom-kolom lain yang Anda butuhkan
        ];

        public function user()
        {
            return $this->belongsTo(User::class);
        }
    
        public function bookType()
        {
            return $this->belongsTo(BooksType::class, 'book_type', 'id');
        }

        public function rentLogs()
        {
            return $this->hasMany(RentLog::class);
        }

        public function laporan()
        {
            return $this->hasMany(Laporan::class);
        }

        public function categories()
        {
            return $this->belongsToMany(Category::class, 'book_category', 'category_id', 'book_id');
        }
}
