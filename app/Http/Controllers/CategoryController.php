<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $title = 'Category';
        $categories = (new Category())->getCategories();
        return view('category.index', compact(['categories', 'title']));
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
            //     'nama_kategori' => 'required',
            // ]);

            $nama_kategori = $request->input('nama_kategori');
            $keterangan = $request->input('keterangan');

            $category = new Category;
            $category->nama_kategori = $nama_kategori;
            $category->keterangan = $keterangan;
            $category->save();

            return redirect()->route('category.index')->with('success', 'Category berhasil ditambahkan');
        } catch (\Throwable $th) {
            return redirect()->route('category.index')->with('error', 'Category gagal ditambahkan');
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
            $nama_kategori = $request->input('nama_kategori');
            $keterangan = $request->input('keterangan');

            $category = Category::find($id);
            $category->nama_kategori = $nama_kategori;
            $category->keterangan = $keterangan;
            $category->updated_at = now();
            $category->save();

            return redirect()->route('category.index')->with('success', 'Category berhasil diubah');
        } catch (\Throwable $th) {
            return redirect()->route('category.index')->with('error', 'Category gagal diubah');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $category = Category::find($id);
        $category->delete();

        return redirect()->route('category.index')->with('success', 'Category berhasil dihapus');
    }
}
