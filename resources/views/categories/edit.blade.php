@extends('layouts')
@section('title', 'Edit data Kategori')
@section('content')

<h2>Edit Category</h2>
    <form action="{{ route('categories.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="cat_nama">Name:</label>
            <input type="text" class="form-control" name="cat_nama" id="cat_nama" value="{{ $category->cat_nama }}">
        </div>
        <div class="form-group">
            <label for="cat_deskripsi">Description:</label>
            <textarea class="form-control" name="cat_deskripsi" id="cat_deskripsi">{{ $category->cat_deskripsi }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>

@endsection
