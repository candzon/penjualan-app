<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Order_detail;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class OrderDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $title = 'Order Detail';
        $order = (new Order)->getOrder();
        $orderDetail = (new Order_detail)->getOrderDetail();
        $orderDetail2 = (new Order_detail)->getOrderDetail2();
        $produk = (new Produk)->getProduks();
        $produk2 = DB::table('produks')->get();
        return view('orderdetail.index', compact(['orderDetail2','produk', 'produk2','order','orderDetail', 'title']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $invoice = $request->id_order;
        $id_produk = $request->id_produk;
        $qty = $request->qty;
        $price = $request->price;

        $orderDetail = new Order_detail();
        $orderDetail->order_id = $invoice;
        $orderDetail->product_id = $id_produk;
        $orderDetail->qty = $qty;
        $orderDetail->price = $price;
        $orderDetail->save();

        return redirect()->route('orderdetail.index')->with('success', 'Order Detail berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $orderDetail = Order_detail::findOrFail($id);
        $orderDetail->order_id= $request->id_order;
        $orderDetail->product_id = $request->id_produk;
        $orderDetail->qty = $request->qty;
        $orderDetail->price = $request->price;
        $orderDetail->save();

        return redirect()->route('orderdetail.index')->with('success', 'Order Detail berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $orderDetail = Order_detail::findOrFail($id);
        $orderDetail->delete();

        return redirect()->route('orderdetail.index')->with('success', 'Order Detail berhasil dihapus');
    }
}