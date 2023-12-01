<?php

namespace App\Models;


use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';

    public function getCategories()
    {
        $categories = DB::table('categories as a')
            ->select('a.*')
            ->orderBy('id', 'desc')
            ->get()->toArray();

        return $categories;
    }
}
