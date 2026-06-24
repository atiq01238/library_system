@extends('layout.master')
@section('content')

<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header">
            <h4>Add Book Category</h4>
        </div>

        <div class="card-body">

            {{-- Error Messages --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Oops!</strong> There were some problems:

                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Success Message --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> {{ session('success') }}

                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            {{-- Form --}}
            <form action="{{ route('add-book-category') }}" method="POST">
                @csrf

                <!-- Category Name -->
                <div class="mb-3">
                    <label for="categoryName" class="form-label">Category Name</label>
                    <input type="text" class="form-control" id="categoryName" name="category_name" placeholder="Enter category name">
                </div>

                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary">
                    Add Category
                </button>

            </form>

        </div>
    </div>
</div>

@endsection