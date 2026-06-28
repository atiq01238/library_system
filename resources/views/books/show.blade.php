@extends('layout.master')

@section('content')
<style>
    .book-cover-wrapper{
    position: sticky;
    top: 20px;
    text-align: center;
}

.book-cover{
    width: 100%;
    max-width: 320px;
    height: 480px;
    object-fit: cover;
    border-radius: 15px;

    box-shadow:
        0 15px 35px rgba(0,0,0,.15),
        0 5px 15px rgba(0,0,0,.1);

    transition: .3s ease;
}

.book-cover:hover{
    transform: translateY(-8px);
}

.book-details-card{
    background: #fff;
    padding: 35px;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0,0,0,.08);
}

.book-details-card h1{
    font-size: 2.5rem;
    margin-bottom: 15px;
}

.book-details-card p{
    line-height: 1.9;
    font-size: 16px;
}
</style>
<div class="container py-5">

    <div class="row">

        <!-- Book Cover -->
        <div class="col-lg-4">
            <div class="book-cover-wrapper">

                <img src="{{ asset('uploads/books/' . $book->book_image) }}"
                     class="book-cover"
                     alt="{{ $book->book_name }}">

            </div>
        </div>

        <!-- Book Details -->
        <div class="col-lg-8">

            <div class="book-details-card">

                <span class="badge bg-primary mb-3">
                    📚 Library Collection
                </span>

                <h1 class="fw-bold">
                    {{ $book->book_name }}
                </h1>

                <hr>

                <h5 class="fw-semibold">
                    About This Book
                </h5>

                <p class="text-muted">
                    {{ $book->description }}
                </p>

                <div class="mt-4">

                    <a href="{{ url()->previous() }}"
                       class="btn btn-outline-dark">
                        ← Back
                    </a>

                    {{-- <a href="{{ route('books.edit', $book->id) }}"
                       class="btn btn-warning">
                        ✏️ Edit
                    </a> --}}

                </div>

            </div>

        </div>

    </div>

</div>

@endsection