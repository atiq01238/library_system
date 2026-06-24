@extends('layout.master')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Book Categories</h4>

    <a href="/add-book-categories" class="btn btn-primary">
        + Add Book Category
    </a>
</div>
@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> {{ session('error') }}

        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> {{ session('success') }}

        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Category Name</th>
            <th>Actions</th>
        </tr>
    </thead>

    <tbody>
        @forelse($categories as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td>{{ $category->category_name }}</td>

                <td class="d-flex gap-2">
                    <form action="{{ route('categories.destroy', $category->id) }}"
                          method="POST"
                          onsubmit="return confirm('Are you sure you want to delete this category?');">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger btn-sm">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="3" class="text-center">
                    No categories found
                </td>
            </tr>
        @endforelse
    </tbody>
</table>

@endsection