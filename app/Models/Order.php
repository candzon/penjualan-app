<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;
    protected $tables = 'customers';

    public function getOrders()
    {
        $orders = DB::table('orders as a')
            ->join('customers as b', 'a.customer_id', '=', 'b.id')
            ->join('users as c', 'a.user_id', '=', 'c.id')
            ->orderBy('a.id', 'desc')
            ->get();
        return $orders;
    }

    public function getOrder()
    {
        $order = DB::table('orders as a')
            ->select('a.id as id_order', 'a.invoice', 'a.total', 'a.user_id', 'a.customer_id')
            ->get();
        return $order;
    }
}
