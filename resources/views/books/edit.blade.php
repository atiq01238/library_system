@extends('layout.master')
@section('content')

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