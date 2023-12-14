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

        $getOrder = DB::table('orders as a')->select('a.id as id_order', 'a.invoice')->get();
        $produk = (new Produk)->getProduks();
        $produk2 = DB::table('produks')->get();
        if (!auth()->check()) {
            return redirect()->route('login');
        } else {
            return view('orderdetail.index', compact(['getOrder', 'orderDetail2', 'produk', 'produk2', 'order', 'orderDetail', 'title']));
        }
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
        try {
            // $this->validate($request, [
            //     'id_order' => 'required',
            //     'id_produk' => 'required',
            //     'qty' => 'required',
            //     'price' => 'required',
            // ]);

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
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->route('orderdetail.index')->with('error', 'Order Detail gagal ditambahkan');
        }
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
        try {
            $invoice = $request->id_order;
            $id_produk = $request->id_produk;
            $qty = $request->qty;
            $price = $request->price;

            $orderDetail = Order_detail::findOrFail($id);
            $orderDetail->order_id = $invoice;
            $orderDetail->product_id = $id_produk;
            $orderDetail->qty = $qty;
            $orderDetail->price = $price;
            $orderDetail->save();

            return redirect()->route('orderdetail.index')->with('success', 'Order Detail berhasil diupdate');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->route('orderdetail.index')->with('error', 'Order Detail gagal diupdate');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        try {
            $orderDetail = Order_detail::findOrFail($id);
            $orderDetail->delete();

            return redirect()->route('orderdetail.index')->with('success', 'Order Detail berhasil dihapus');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->route('orderdetail.index')->with('error', 'Order Detail gagal dihapus');
        }
    }
}
