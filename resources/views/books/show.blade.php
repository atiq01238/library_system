@extends('layout.master')
@section('content')

<div class="container py-5">

    <div class="row">

        <!-- LEFT SIDE IMAGE -->
        <div class="col-md-5">
            <img src="{{ asset('uploads/books/' . $book->book_image) }}"
                 class="img-fluid rounded shadow"
                 alt="{{ $book->book_name }}">
        </div>

        <!-- RIGHT SIDE DETAILS -->
        <div class="col-md-7">

            <h2>{{ $book->book_name }}</h2>

            <p class="text-muted mt-3">
                {{ $book->description }}
            </p>

            <hr>

            <a href="/" class="btn btn-secondary">
                ← Back to Books
            </a>

        </div>

    </div>

</div>
@endsection