@extends('layout.master')
<style>
    
.hero-section {
    background: linear-gradient(135deg, #4f46e5, #7c3aed);
    border-radius: 0 0 30px 30px;
}


.book-card {
    background: #fff;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 10px 25px rgba(0,0,0,0.08);
    transition: all 0.4s ease;
}

.book-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 35px rgba(0,0,0,0.15);
}


.book-image-wrapper {
    overflow: hidden;
    height: 300px;
}

.book-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform .5s ease;
}

.book-card:hover .book-image {
    transform: scale(1.08);
}


.book-card h5 {
    color: #222;
}


.btn-primary {
    background: #4f46e5;
    border: none;
}

.btn-primary:hover {
    background: #3730a3;
}
</style>
@section('content')


<div class="hero-section text-center text-white py-5 mb-5">
    <div class="container">
        <h1 class="display-4 fw-bold">📚 Discover Amazing Books</h1>
        <p class="lead">Explore thousands of books and expand your knowledge.</p>
    </div>
</div>
{{-- 
<div class="container pb-5">

    <div class="text-center mb-5">
        <h2 class="fw-bold">Featured Collection</h2>
        <p class="text-muted">Find your next favorite book</p>
    </div>

    <div class="row g-4">

        @foreach($books as $book)

        <div class="col-lg-4 col-md-6">
            <div class="book-card h-100">

                <div class="book-image-wrapper">
                    <img src="{{ asset('uploads/books/' . $book->book_image) }}"
                        alt="{{ $book->book_name }}"
                        class="book-image">
                </div>

                <div class="p-4">

                    <h5 class="fw-bold mb-3">
                        {{ $book->book_name }}
                    </h5>

                    <p class="text-muted">
                        {{ \Illuminate\Support\Str::limit($book->description, 120) }}
                    </p>

                    <a href="{{ route('books.show', $book->id) }}"
                        class="btn btn-primary rounded-pill px-4">
                        Read More →
                    </a>

                </div>

            </div>
        </div>

        @endforeach

    </div>

</div> --}}

@endsection