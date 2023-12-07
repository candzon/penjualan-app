<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\alert;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $produks = produk::orderBy('id', 'desc')->with('category')->get();
        $title = 'Dashboard';
        $produks = (new Produk)->getProduks();
        $categories = (new Category)->getCategories();

        return view('products.index', compact(['produks', 'categories', 'title']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        try {
            // $this->validate($request, [
            //     'nama_produk' => 'required',
            //     'price' => 'required',
            //     'stok' => 'required',
            //     'category_id' => 'required',
            //     'file' => 'required'
            // ]);

            $nama_produk = $request->input('nama_produk');
            $price = $request->input('price');
            $stok = $request->input('stok');
            $category_id = $request->input('category_id');
            $keterangan = $request->input('keterangan');
            $file = $request->file('file');


            $produk = new Produk;
            $produk->nama_produk = $nama_produk;
            $produk->price = $price;
            $produk->stock = $stok;
            $produk->category_id = $category_id;
            $produk->keterangan = $keterangan;
            if ($request->hasfile('file')) {
                $filename = round(microtime(true) * 1000) . '-' . str_replace(' ', '-', $file->getClientOriginalName());
                $request->file('file')->move(public_path('uploads/products'), $filename);
                $produk->file = $filename;
            } else {
                alert('error', 'File tidak ditemukan');
            }
            $produk->save();

            return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->route('products.index')->with('error', 'Produk gagal ditambahkan');
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
        $produk = Produk::find($id);
        return view('products.edit', compact('produks'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        try {
            $id_produks = $request->input('id_produks');
            $nama_produk = $request->input('nama_produk');
            $price = $request->input('price');
            $stok = $request->input('stok');
            $category_id = $request->input('category_id');
            $keterangan = $request->input('keterangan');
            $file = $request->file('file');

            $produk = Produk::find($id);
            $produk->id = $id_produks;
            $produk->nama_produk = $nama_produk;
            $produk->price = $price;
            $produk->stock = $stok;
            $produk->category_id = $category_id;
            $produk->keterangan = $keterangan;
            $produk->updated_at = now();
            if ($request->hasfile('file')) {
                $filename = round(microtime(true) * 1000) . '-' . str_replace(' ', '-', $file->getClientOriginalName());
                $request->file('file')->move(public_path('uploads/products'), $filename);
                $produk->file = $filename;
            } else {
                alert('error', 'File tidak ditemukan');
            }
            $produk->save();

            return redirect()->route('products.index')->with('success', 'Produk berhasil diupdate');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->route('products.index')->with('error', 'Produk gagal diupdate');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        try {
            $produk = Produk::findOrfail($id);
            $produk->delete();

            return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->route('products.index')->with('error', 'Produk gagal dihapus');
        }
    }
}
