@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <h3>{{ __('Products') }}</h3>
            </div>
            <div class="col-auto">
                {{-- Button modal add product --}}
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Add Product</a>
            </div>
        </div>


        <div class="row">

            @for ($i = 0; $i < 10; $i++)
                <div class="col-sm-3 mt-4">
                    <div class="card">
                        <img src="{{ URL::to('/') }}/uploads/products/ban.jpg" style="max-width: auto; max-height: 150px"
                            alt="Image">
                        <div class="card-body">
                            <h5 class="card-title">Nama Produk</h5>
                            <h6 class="card-text">Harga</h6>
                            <p class="card-text">Deskripsi</p>
                            {{-- Button modal edit --}}
                            <a href="#" class="btn btn-primary form-control">Edit</a>
                            <a href="#" class="btn btn-outline-primary form-control mt-2">Delete</a>
                        </div>
                    </div>
                </div>
            @endfor
        </div>
    </div>
@endsection
