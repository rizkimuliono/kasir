@extends('layouts')
@section('title', 'Tambah data Produk Baru')
@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Create New Product</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="pro_nama">Name:</label>
                    <input type="text" class="form-control" name="pro_nama" id="pro_nama" required>
                </div>
                <div class="form-group">
                    <label for="pro_deskripsi">Description:</label>
                    <textarea class="form-control" name="pro_deskripsi" id="pro_deskripsi" required></textarea>
                </div>
                <div class="form-group">
                    <label for="pro_stok">Stock:</label>
                    <input type="number" class="form-control" name="pro_stok" id="pro_stok" required>
                </div>
                <div class="form-group">
                    <label for="pro_harga_beli">Purchase Price:</label>
                    <input type="number" step="0.01" class="form-control" name="pro_harga_beli" id="pro_harga_beli" required>
                </div>
                <div class="form-group">
                    <label for="pro_harga_jual">Selling Price:</label>
                    <input type="number" step="0.01" class="form-control" name="pro_harga_jual" id="pro_harga_jual" required>
                </div>
                <div class="form-group">
                    <label for="pro_categori_id">Category:</label>
                    <select class="form-control" name="pro_categori_id" id="pro_categori_id" required>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->cat_nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="pro_gambar">Image:</label>
                    <input type="file" class="form-control-file" name="pro_gambar" id="pro_gambar">
                </div>
                <button type="submit" class="btn btn-primary"> <i class="fas fa-save"></i> SAVE</button>
            </form>
        </div>
    </div>

@endsection
