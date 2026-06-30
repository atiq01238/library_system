@extends('layout.master')
@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<div class="container py-5">

    <h3>Edit Book</h3>

    <form action="{{ route('books.update', $book->id) }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <!-- Current Image -->
        <div class="mb-3">
            <label>Current Image</label><br>
            <img src="{{ asset('uploads/books/' . $book->book_image) }}"
                 width="120"
                 class="rounded shadow">
        </div>

        <!-- New Image -->
        <div class="mb-3">
            <label>Change Image</label>
            <input type="file" name="book_image" class="form-control">
        </div>

        <!-- Book Name -->
        <div class="mb-3">
            <label>Book Name</label>
            <input type="text"
                   name="book_name"
                   value="{{ $book->book_name }}"
                   class="form-control">
        </div>
        <div class="mb-3">
            <label>Author Name</label>
            <input type="text"
                   name="author_name"
                   value="{{ $book->author_name }}"
                   class="form-control">
        </div>
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

        <!-- Description -->
        <div class="mb-3">
            <label>Description</label>
            <textarea name="description"
                      class="form-control"
                      rows="5">{{ $book->description }}</textarea>
        </div>

        <!-- Button -->
        <button class="btn btn-primary">
            Update Book
        </button>

    </form>

</div>
@endsection
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