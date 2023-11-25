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
@endsection
