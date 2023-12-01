@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mt-3">
            <div class="col">
                <h3>{{ __('List Order') }}</h3>
            </div>
            <div class="col-auto">
                {{-- Button modal add product --}}
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Add
                    Order</a>
            </div>
        </div>

        <div class="row mt-5">
            <div class="container">
                <table class="table" id="myTable">
                    <thead>
                        <tr>
                            <th>No Invoices</th>
                            <th>Nama Customer</th>
                            <th>Admin Purchasing</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order2 as $o)
                            @php
                                $getCustomer = App\Models\Customer::where('id', $o->customer_id)->first();
                                $getUser = App\Models\User::where('id', $o->user_id)->first();
                            @endphp
                            <tr>
                                <td>{{ $o->invoice }}</td>
                                <td>{{ $getCustomer->nama_customer }}</td>
                                <td>{{ $getUser->name }}</td>
                                <td>{{ $o->total }}</td>
                                <td class="action">
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#exampleModalEdit{{ $o->id_order }}">Edit</button>
                                        </div>
                                        <div class="col">
                                            <form action="{{ route('order.destroy', ['order' => $o->id_order]) }}" method="POST">
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
            <form action="{{ route('order.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Order</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Nama Customer</label>
                                    <select name="id_customer" class="form-select">
                                        <option value="NULL">Choose</option>
                                        @foreach ($customers as $c)
                                            <option value="{{ $c->id }}">{{ $c->nama_customer }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Admin Purchasing</label>
                                    <select name="id_user" class="form-select">
                                        <option value="NULL">Choose</option>
                                        @foreach ($users as $u)
                                            <option value="{{ $u->id }}">{{ $u->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Total</label>
                                    <input type="text" class="form-control" name="total" id="format_rupiah">
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
    @foreach ($order2 as $items)
        <div class="modal fade" id="exampleModalEdit{{ $items->id_order }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{ route('order.update', ['order' => $items->id_order]) }}" method="POST"
                    enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Order</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Nama Customer</label>
                                        <select name="id_customer" class="form-select">
                                            <option value="NULL">Choose</option>
                                            @foreach ($customers as $c)
                                                <option value="{{ $c->id }}"
                                                    @if ($c->id == $items->customer_id) selected @endif>
                                                    {{ $c->nama_customer }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Admin Purchasing</label>
                                        <select name="id_user" class="form-select">
                                            <option value="NULL">Choose</option>
                                            @foreach ($users as $u)
                                                <option value="{{ $u->id }}"
                                                    @if ($u->id == $items->user_id) selected @endif>{{ $u->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Total</label>
                                        <input type="text" class="form-control" name="total" id=""
                                            value="{{ $items->total }}">
                                    </div>
                                </div>
                                <input type="text" name="id_order" hidden value="{{ $items->id_order }}">
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
    @endforeach
@endsection
