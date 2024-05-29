@extends('layouts')
@section('title', 'Data Categories')
@section('content')

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">DataTables Users</h6>
        <a href="{{ route('categories.create') }}" class="btn btn-primary btn-sm float-right" style="margin-top:-25px">Add Category</a>
    </div>
    <div class="card-body">

        @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{ $category->cat_nama }}</td>
                            <td>{{ $category->cat_deskripsi }}</td>
                            <td>
                                    <a class="btn btn-warning btn-sm" href="{{ route('categories.edit', $category->id) }}"><i class="fas fa-edit"></i> edit</a>
                                    |
                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>
        </div>
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
