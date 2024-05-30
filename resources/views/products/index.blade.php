@extends('layouts')
@section('title', 'Data Products')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Products</h6>
        <a href="{{ route('products.create') }}" class="btn btn-primary btn-sm float-right" style="margin-top:-25px">Add Product</a>
    </div>
    <div class="card-body">
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                {{ $message }}
            </div>
        @endif
        <table id="dataTable" class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Stock</th>
                    <th>Purchase Price</th>
                    <th>Selling Price</th>
                    <th>Category</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->pro_nama }}</td>
                        <td>{{ $product->pro_deskripsi }}</td>
                        <td>{{ $product->pro_stok }}</td>
                        <td>{{ $product->pro_harga_beli }}</td>
                        <td>{{ $product->pro_harga_jual }}</td>
                        <td>{{ $product->category->cat_nama }}</td>
                        <td>
                            @if ($product->pro_gambar)
                                <img src="{{ asset('storage/' . $product->pro_gambar) }}" width="50" height="50" alt="{{ $product->pro_nama }}">
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('products.show', $product->id) }}" class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection

@section('js')
<script>
    // Call the dataTables jQuery plugin
    $(document).ready(function() {
        $('#dataTable').DataTable();
    });
</script>
@endsection
