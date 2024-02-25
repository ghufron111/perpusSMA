<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Main extends Model
{
    public static function Simpan($table, $data)
    {
        return DB::table($table)->insert($data);;
    }
    public static function Ubah($table, $data, $where)
    {
        return DB::table($table)->where($where)->update($data);;
    }
    public static function Hapus($table, $where)
    {
        return DB::table($table)->where($where)->delete();
    }

}
