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
                            <h5 class="card-title" style="font-weight: bold">Nama Produk</h5>
                            <div class="row">
                                <div class="col">
                                    <h6 class="card-text" style="color: gray">Harga</h6>
                                    <h6 class="card-text" style="font-weight: bold">Rp 100.000</h6>
                                </div>
                                <div class="col-auto">
                                    <h6 class="card-text" style="color: gray">Stok</h6>
                                    <h6 class="card-text">100</h6>
                                </div>
                            </div>
                            <p class="card-text mt-2" style="color: gray">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem aspernatur quasi quam explicabo rem illo molestiae omnis impedit deleniti eos, laudantium repellat fugit praesentium officia voluptatem hic cumque minus blanditiis.</p>
                            {{-- Button modal edit --}}
                            <button type="button" class="btn btn-primary form-control" data-bs-toggle="modal" data-bs-target="#exampleModalEdit">Edit</button>
                            {{-- Button delete --}}
                            
                            <a href="#" class="btn btn-outline-primary form-control mt-2">Delete</a>
                        </div>
                    </div>
                </div>
            @endfor
        </div>
    </div>
@endsection
