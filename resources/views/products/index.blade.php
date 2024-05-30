@extends('layouts')
@section('title', 'Data Products')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Products</h6>

            <a href="{{ route('products.create') }}" class="btn btn-primary btn-sm float-right" style="margin-top:-25px">Add Product</a>

            <a href="" class="btn btn-success btn-sm float-right" style="margin-top:-25px; margin-right:50px;">Scan + Stok</a>
        </div>
        <div class="card-body">
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    {{ $message }}
                </div>
            @endif
            @if ($message = Session::get('error'))
                <div class="alert alert-success">
                    {{ $message }}
                </div>
            @endif
            <table id="dataTable" class="table table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Category</th>
                        <th>Purchase Price</th>
                        <th>Selling Price</th>
                        <th>Stock</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->pro_nama }}</td>
                            <td>{{ $product->pro_deskripsi }}</td>
                            <td>{{ $product->category->cat_nama }}</td>
                            <td>{{ $product->pro_harga_beli }}</td>
                            <td>{{ $product->pro_harga_jual }}</td>
                            <td class="{{ $product->pro_stok <= 10 ? 'bg-danger text-white' : '' }}">
                                {{ $product->pro_stok }}
                                <button class="btn btn-primary btn-sm float-right view-details" data-id="{{ $product->id }}"> <i class="fa fa-upload" aria-hidden="true"></i> Stok</button>
                            </td>
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

    <!-- Modal -->
    <div class="modal fade" id="productModal" tabindex="-1" role="dialog" aria-labelledby="productModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="productModalLabel">Product Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/update_stok" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                Nama Produk : <span id="pro_nama"></span><br>
                                Kategori : <span id="pro_categori_id"></span>
                                <input type="hidden" id="pro_id" name="id">
                                <div class="form-group">
                                    <label>Harga beli</label>
                                    <input type="text" class="form-control" disabled id="pro_harga_beli">
                                </div>
                                <div class="form-group">
                                    <label>Harga Jual</label>
                                    <input type="text" class="form-control" disabled id="pro_harga_jual">
                                </div>

                                <div class="form-group" style="margin-top: 60px;">
                                    <label>Stok Saat ini</label>
                                    <input type="text" class="form-control" disabled id="pro_stok">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <img id="pro_gambar" src="" alt="Product Image" height="200">
                                <p><strong>Description:</strong> <br><span id="pro_deskripsi"></span></p>

                                <div class="form-group">
                                    <label>+Stok Penambahan</label>
                                    <input type="number" class="form-control" name="stok_baru" placeholder="ketikkan nilai stok baru">
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary"> <i class="fas fa-save"></i> UPDATE STOK</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script>
        // Call the dataTables jQuery plugin
        $(document).ready(function() {
            $('#dataTable').DataTable();

            $('.view-details').on('click', function() {
                var productId = $(this).data('id');
                $.ajax({
                    url: '/get-products/' + productId,
                    method: 'GET',
                    success: function(data) {
                        // console.log(data.category.cat_nama);
                        $('#pro_id').val(data.id);
                        $('#pro_nama').text(data.pro_nama);
                        $('#pro_deskripsi').text(data.pro_deskripsi);
                        $('#pro_stok').val(data.pro_stok);
                        $('#pro_harga_beli').val(data.pro_harga_beli);
                        $('#pro_harga_jual').val(data.pro_harga_jual);
                        $('#pro_categori_id').text(data.category.cat_nama);
                        $('#pro_gambar').attr('src', '/storage/' + data.pro_gambar);

                        $('#productModal').modal('show');
                    }
                });
            });
        });
    </script>
@endsection
