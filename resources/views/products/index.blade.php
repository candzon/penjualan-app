@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mt-3">
            <div class="col">
                <h3>{{ __('List Products') }}</h3>
            </div>
            <div class="col-auto">
                {{-- Button modal add product --}}
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Add
                    Product</a>
            </div>
        </div>


        <div class="row">
            @foreach ($produks as $item)
                <div class="col-sm-3 mt-4">
                    <div class="card">
                        <img src="{{ asset('uploads/products/' . $item->file) }}" style="max-width: auto; max-height: 150px" alt="Image">
                        <div class="card-body">
                            <h5 class="card-title" style="font-weight: bold">{{ $item->nama_produk }}</h5>
                            <div class="row">
                                <div class="col">
                                    <h6 class="card-text" style="color: gray">Harga</h6>
                                    <h6 class="card-text" style="font-weight: bold">{{ $item->price }}</h6>
                                </div>
                                <div class="col-auto">
                                    <h6 class="card-text" style="color: gray">Stok</h6>
                                    <h6 class="card-text">{{ $item->stock }}</h6>
                                </div>
                            </div>
                            <h6 class="card-text mt-2" style="color: gray">Kategori</h6>
                            <h6 class="card-text mt-2">{{ $item->nama_kategori }}</h6>
                            <h6 class="card-text mt-2" style="color: gray">Keterangan</h6>
                            <p class="card-text mt-0">{{ $item->keterangan }}</p>
                            {{-- Button modal edit --}}
                            <button type="button" class="btn btn-primary form-control" data-bs-toggle="modal"
                                data-bs-target="#exampleModalEdit{{ $item->id }}">Edit</button>
                            {{-- Button delete --}}
                            <form action="{{ route('products.destroy', ['product' => $item->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-primary form-control mt-1">Delete</button>
                            </form>
                           
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- Modal add products --}}
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Product</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Nama Produk</label>
                                    <input type="text" name="nama_produk" class="form-control"
                                        id="exampleFormControlInput1">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Harga</label>
                                    <input type="text" name="price" class="form-control" id="format_rupiah">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Stok</label>
                                    <input type="text" name="stok" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Keterangan</label>
                                    <textarea name="keterangan" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Category</label>
                                    <select name="category_id" class="form-select">
                                        <option value="NULL">Pilih</option>
                                        @foreach ($categories as $cat)
                                            <option value="{{ $cat->id }}">{{ $cat->nama_kategori }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Foto</label>
                                    <input class="form-control" type="file" name="file">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    {{-- End Modal add --}}

    {{-- Modal Edit products --}}
    @foreach ($produks as $items)
        <div class="modal fade" id="exampleModalEdit{{ $items->id }}" tabindex="-1"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{ route('products.update', ['product' => $items->id]) }}" method="POST"
                    enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Product</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Nama Produk</label>
                                        <input type="text" name="nama_produk" class="form-control" value="{{ $items->nama_produk }}"
                                            id="exampleFormControlInput1">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Harga</label>
                                        <input type="text" name="price" class="form-control" id="format_rupiah" value="{{ $items->price }}">  
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Stok</label>
                                        <input type="text" name="stok" class="form-control" value="{{ $items->stock }}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Keterangan</label>
                                        <textarea name="keterangan" class="form-control" >{{ $items->keterangan}}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Category</label>
                                        <select name="category_id" class="form-select" id="">
                                            <option value="NULL">Pilih</option>
                                            @foreach ($categories as $cat)
                                                <option value="{{ $cat->id }}">{{ $cat->nama_kategori }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <input type="text" hidden name="id_produks" value="{{ $items->id }}">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endforeach
    {{-- End Modal edit --}}
@endsection