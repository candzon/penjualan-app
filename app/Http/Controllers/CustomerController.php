<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $title = 'Customer';
        $customers = (new Customer())->getCustomers();
        return view('customer.index', compact(['customers','title']));
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
        $nama_customer = $request->input('nama_customer');
        $email = $request->input('email');
        $address = $request->input('address');
        $phone = $request->input('phone');
      
        $customer = new Customer;
        $customer->nama_customer = $nama_customer;
        $customer->email = $email;
        $customer->address = $address;
        $customer->phone = $phone;
        $customer->save();

        return redirect()->route('customer.index')->with('success', 'Customer berhasil ditambahkan');
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
        $nama_customer = $request->input('nama_customer');
        $email = $request->input('email');
        $address = $request->input('address');
        $phone = $request->input('phone');

        $customer = Customer::find($id);
        $customer->nama_customer = $nama_customer;
        $customer->email = $email;
        $customer->address = $address;
        $customer->phone = $phone;
        $customer->save();

        return redirect()->route('customer.index')->with('success', 'Customer berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $customer = Customer::find($id);
        $customer->delete();

        return redirect()->route('customer.index')->with('success', 'Customer berhasil dihapus');
    }
}
