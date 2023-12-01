<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order_detail extends Model
{
    use HasFactory;

    public function getOrderDetail()
    {
        $orderDetail = DB::table('order_details as a')
            ->join('produks as b', 'a.product_id', '=', 'b.id')
            ->join('orders as c', 'a.order_id', '=', 'c.id')
            ->select('a.id as id_order_detail', 'a.order_id', 'a.product_id', 'a.qty', 'a.price', 'b.nama_produk', 'c.invoice')
            ->get();
        return $orderDetail;
    }

    public function getOrderDetail2()
    {
        $orderDetail = DB::table('order_details as a')
            ->select('a.id as id_order_detail', 'a.order_id', 'a.product_id', 'a.qty', 'a.price')
            ->get();
        return $orderDetail;
    }


}
