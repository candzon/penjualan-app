@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mt-3">
            <div class="col">
                <h3>{{ __('Master Category') }}</h3>
            </div>
            <div class="col-auto">
                {{-- Button modal add product --}}
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Add
                    Category</a>
            </div>
        </div>

        {{-- Alert --}}
        @if (session('success'))
            <div class="alert alert-success mt-3">
                {{ session('success') }}
            </div>
        @elseif(session('error'))
            <div class="alert alert-danger mt-3">
                {{ session('error') }}
            </div>
        @endif
        {{-- End Alert --}}

        {{-- Table --}}
        <div class="row mt-5">
            <div class="container">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Created At</th>
                            <th>Nama Kategori</th>
                            <th>Keterangan</th>
                            <th>Update At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $item)
                            <tr>
                                <td>{{ $item->created_at }}</td>
                                <td>{{ $item->nama_kategori }}</td>
                                @if ($item->keterangan == null)
                                    <td>-</td>
                                @else
                                    <td>{{ $item->keterangan }}</td>
                                @endif
                                @if ($item->updated_at == null)
                                    <td>-</td>
                                @else
                                    <td>{{ $item->updated_at }}</td>
                                @endif
                                <td>
                                    <div class="row">
                                        <div class="col-auto">
                                            <button class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#exampleModalEdit{{ $item->id }}">Edit</button>
                                        </div>
                                        <div class="col-auto">
                                            <form action="{{ route('category.destroy', ['category' => $item->id]) }}"
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
            <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Category</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Nama Kategori</label>
                                    <input type="text" name="nama_kategori" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Keterangan</label>
                                    <input type="text" name="keterangan" class="form-control">
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
    @foreach ($categories as $items)
        <div class="modal fade" id="exampleModalEdit{{ $items->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{ route('category.update', ['category' => $items->id]) }}" method="POST"
                    enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Category</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Nama Kategori</label>
                                        <input type="text" name="nama_kategori" class="form-control"
                                            value="{{ $items->nama_kategori }}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Keterangan</label>
                                        <input type="text" name="keterangan" class="form-control"
                                            value="{{ $items->keterangan }}">
                                    </div>
                                </div>
                            </div>
                            <input type="text" hidden name="id_kategori" value="{{ $items->id }}">
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
