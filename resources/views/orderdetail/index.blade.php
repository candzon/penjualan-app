@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mt-3">
            <div class="col">
                <h3>{{ __('List Order Details') }}</h3>
            </div>
            <div class="col-auto">
                {{-- Button modal add product --}}
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Add
                    Order Detail</a>
            </div>
        </div>

        <div class="row mt-5">
            <div class="container">
                <table class="table" id="myTable">
                    <thead>
                        <tr>
                            <th>No Invoices</th>
                            <th>Products</th>
                            <th>Qty</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orderDetail as $o)
                            <tr>
                                <td>{{ $o->invoice }}</td>
                                <td>{{ $o->nama_produk }}</td>
                                <td>{{ $o->qty }}</td>
                                <td>{{ $o->price }}</td>
                                <td class="action">
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#exampleModalEdit{{ $o->id_order_detail }}">Edit</button>
                                        </div>
                                        <div class="col">
                                            <form
                                                action="{{ route('orderdetail.destroy', ['orderdetail' => $o->id_order_detail]) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-primary">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Modal add products --}}
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('orderdetail.store') }}" method="POST" enctype="multipart/form-data">
                @method('POST')
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
                                    <label for="exampleFormControlInput1" class="form-label">No Invoice</label>
                                    <select name="id_order" id="" class="form-select">
                                        <option value="0">Choose</option>
                                        @foreach ($order as $pe)
                                            <option value="{{ $pe->id_order }}">{{ $pe->invoice }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Nama Produk</label>
                                    <select name="id_produk" id="" class="form-select">
                                        <option value="0">Choose</option>
                                        @foreach ($produk2 as $p)
                                            <option value="{{ $p->id }}">{{ $p->nama_produk }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Qty</label>
                                    <input type="text" name="qty" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Price</label>
                                    <input type="text" class="form-control" name="price">
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
    @foreach ($orderDetail as $items)
        <div class="modal fade" id="exampleModalEdit{{ $items->id_order_detail }}" tabindex="-1"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{ route('orderdetail.update', ['orderdetail' => $items->id_order_detail]) }}" method="POST"
                    enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Product</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">No Invoice</label>
                                        <select name="id_order" id="" class="form-select">
                                            <option value="0">Choose</option>
                                            @foreach ($order as $pe)
                                                <option value="{{ $pe->id_order }}"
                                                    @if ($pe->id_order == $items->order_id) selected @endif>{{ $pe->invoice }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Nama Produk</label>
                                        <select name="id_produk" id="" class="form-select">
                                            <option value="0">Choose</option>
                                            @foreach ($produk2 as $p)
                                                <option value="{{ $p->id }}"
                                                    @if ($p->id == $items->product_id) selected @endif>{{ $p->nama_produk }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Qty</label>
                                        <input type="text" name="qty" class="form-control"
                                            value="{{ $items->qty }}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Price</label>
                                        <input type="text" class="form-control" name="price"
                                            value="{{ $items->price }}">
                                    </div>
                                </div>
                            </div>
                            <input type="text" hidden name="id_orderdetail" value="{{ $items->id_order_detail }}">
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
