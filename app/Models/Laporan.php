<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $table = 'laporan'; // Nama tabel dalam database

    protected $fillable = [
        'id','rent_logs_id','user_id','book_id','rent_date','return_date','actual_return_date','created_at','updated_at'
    ];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function rentLog()
    {
        return $this->hasMany(RentLog::class);
    }
}
