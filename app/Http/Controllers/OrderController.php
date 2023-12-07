<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\User;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $title = 'Order';
        $orders = (new Order())->getOrders();
        $order2 = (new Order())->getOrder();
        $customers = (new Customer())->getCustomers();
        $users = DB::table('users')->get();
        return view('order.index', compact(['order2', 'customers', 'users', 'orders', 'title']));
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

        try {
            // $this->validate($request, [
            //     'id_customer' => 'required',
            //     'id_user' => 'required',
            //     'total' => 'required',
            // ]);

            $order = new Order();
            $order->invoice = $this->generateInvoiceNumber();
            $order->customer_id = $request->id_customer;
            $order->user_id = $request->id_user;
            $order->total = intval(preg_replace('/[^0-9]/', '', $request->total));
            $order->save();
            return redirect()->route('order.index')->with('success', 'Order berhasil ditambahkan.');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->route('order.index')->with('error', 'Order gagal ditambahkan');
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

            $order = Order::find($id);
            $order->customer_id = $request->id_customer;
            $order->user_id = $request->id_user;
            $order->total = intval(preg_replace('/[^0-9]/', '', $request->total));
            $order->updated_at = now();
            $order->save();

            return redirect()->route('order.index')->with('success', 'Order berhasil diupdate.');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->route('order.index')->with('error', 'Order gagal diupdate');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $order = Order::find($id);
        $order->delete();

        return redirect()->route('order.index')->with('success', 'Order berhasil dihapus.');
    }


    private function generateInvoiceNumber()
    {
        $lastInvoice = Order::orderBy('id', 'desc')->first();
        $currentYear = date('Y');
        $newInvoiceCount = 1;

        if ($lastInvoice) {
            $lastInvoiceNumber = $lastInvoice->invoice;
            $lastInvoiceNumberParts = explode('-', $lastInvoiceNumber);
            $lastInvoiceYear = $lastInvoiceNumberParts[1];
            $lastInvoiceCount = intval($lastInvoiceNumberParts[2]);

            if ($lastInvoiceYear == $currentYear) {
                $newInvoiceCount = $lastInvoiceCount + 1;
            }
        }

        $invoiceNumber = 'INV-' . $currentYear . '-' . str_pad($newInvoiceCount, 4, '0', STR_PAD_LEFT);
        return $invoiceNumber;
    }
}
