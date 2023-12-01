<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produk extends Model
{
    use HasFactory;
    protected $table = 'produks';

    public function getProduks()
    {
        $produks = DB::table('produks as a')
            ->join('categories as b', 'a.category_id', '=', 'b.id')
            ->select('a.*', 'b.nama_kategori')
            ->orderBy('id', 'desc')
            ->get()->toArray();

        return $produks;
    }
}
