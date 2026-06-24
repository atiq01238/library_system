@extends('layout.master')
@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header">
            <h4>Add Book</h4>
        </div>

        <div class="card-body">
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
                        @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> {{ session('success') }}

                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            <form action="{{ route('/add-book') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- Book Image -->
                <div class="mb-3">
                    <label for="bookImage" class="form-label">Book Image</label>
                    <input type="file" class="form-control" id="bookImage" name="book_image">
                    
                </div>
                @error('book_image')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <!-- Book Name -->
                <div class="mb-3">
                    <label for="bookName" class="form-label">Book Name</label>
                    <input type="text" class="form-control" id="bookName" name="book_name" placeholder="Enter book name">
                </div>
                @error('book_name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <div class="mb-3">
                    <label for="category" class="form-label">Book Category</label>

                        <select id="category" name="category_id" class="form-select">
                            <option value="">Select Category</option>

                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">
                                    {{ $category->category_name }}
                                </option>
                            @endforeach
                        </select>
                </div>
                @error('category_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <!-- Book Description -->
                <div class="mb-3">
                    <label for="bookDescription" class="form-label">Description</label>
                    <textarea class="form-control" id="bookDescription" name="description" rows="4" placeholder="Enter book description"></textarea>
                </div>
                @error('description')
                    <div class="text-danger">{{ $message }}</div>
                @enderror

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary">
                    Add Book
                </button>

            </form>
        </div>
    </div>
</div>

@endsection()
@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
$(document).ready(function () {
    $('#category').select2({
        placeholder: "Select Category",
        width: '100%'
    });
});
</script>
@endpush