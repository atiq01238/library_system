@extends('layout.master')
@section('content')

<div class="container py-5">
    <div class="row g-4">

        @foreach($books as $book)
            <div class="col-md-4">
                <div class="book-card">

                    <!-- Image -->
                    <img src="{{ asset('uploads/books/' . $book->book_image) }}"
                         alt="{{ $book->book_name }}"
                         class="img-fluid">

                    <div class="book-body">

                        <!-- Book Name -->
                        <h5 class="book-title">{{ $book->book_name }}</h5>

                        <!-- Description -->
                       <p class="book-desc">
                            {{ \Illuminate\Support\Str::limit($book->description, 100) }}
                            <a href="{{ route('books.show', $book->id) }}">Read more</a>
                        </p>
                        <!-- Button -->
                        <a href="{{ route('books.show', $book->id) }}" class="btn btn-primary btn-sm">
                            See »
                        </a>

                    </div>
                </div>
            </div>
        @endforeach

    </div>
</div>
@endsection