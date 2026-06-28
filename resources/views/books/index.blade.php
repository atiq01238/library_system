@extends('layout.master')
@section('content')

<div class="container py-5">

    <h3 class="mb-4">📚 All Books</h3>
    <div class="mb-4">
        <input type="text"
            id="search"
            class="form-control"
            placeholder="🔍 Search Book...">
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

            <div id="books-container" >
              @foreach($books as $book)
                    <div class="card mb-3 shadow-sm border-0" class="card mb-3 shadow-sm border-0"
                    onclick="window.location='{{ route('books.show', $book->id) }}'"
                    style="cursor:pointer;">

                        <div class="row g-0 align-items-center">

                            <!-- LEFT IMAGE -->
                            <div class="col-md-2 text-center p-2">
                                <img src="{{ asset('uploads/books/' . $book->book_image) }}"
                                    class="img-fluid rounded"
                                    style="height:120px; object-fit:cover;">
                            </div>

                            <!-- MIDDLE DETAILS -->
                            <div class="col-md-7 p-3">
                                <h5 class="mb-1">{{ $book->book_name }}</h5>
                                <p class="text-muted mb-0">
                                    {{ \Illuminate\Support\Str::limit($book->description, 120) }}
                                </p>
                            </div>

                            <!-- RIGHT BUTTONS -->
                            <div class="col-md-3 text-end p-3">

                                <!-- Edit Button -->
                                <a href="{{ route('books.edit', $book->id)}}"
                                class="btn btn-sm btn-warning me-2"
                                 onclick="event.stopPropagation();">
                                    ✏️ Edit
                                </a>

                                <!-- Delete Button -->
                                <form action="{{ route('books.delete', $book->id) }}"
                                    method="POST"
                                    style="display:inline;"
                                     onclick="event.stopPropagation();">
                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-sm btn-danger"
                                            onclick="return confirm('Are you sure?')">
                                        🗑 Delete
                                    </button>
                                </form>

                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
    

</div>

@endsection
@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>
$(document).ready(function(){

    $('#search').on('keyup', function(){

        let search = $(this).val();

        $.ajax({
            url: "{{ route('books.search') }}",
            type: "GET",
            data: {
                search: search
            },
            success: function(response){
                $('#books-container').html(response);
            }
        });

    });

});
</script>
    
@endpush