@extends('layouts')
@section('title', 'Tambah data Kategori Baru')
@section('content')

<h2>Create Category</h2>
<form action="{{ route('categories.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="cat_nama">Name:</label>
        <input type="text" class="form-control" name="cat_nama" id="cat_nama">
    </div>
    <div class="form-group">
        <label for="cat_deskripsi">Description:</label>
        <textarea class="form-control" name="cat_deskripsi" id="cat_deskripsi"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Create</button>
</form>
@endsection
