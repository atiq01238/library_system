<style>
    .sidebar-book-info {
        flex: 1;
        margin-left: 15px;
    }

    .book-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 10px;
    }

    .book-text {
        flex: 1;
        min-width: 0;
    }

    .book-text h4 {
        margin: 0;
        font-size: 16px;
        font-weight: 600;
        color: #222;
    }

    .book-text span {
        display: block;
        margin-top: 6px;
        color: #888;
        font-size: 13px;
    }

    .sidebar-heart {
        width: 38px;
        height: 38px;
        flex-shrink: 0;
        /* Prevent shrinking */
        border: none;
        border-radius: 50%;
        background: #f8f8f8;
        color: #999;
        cursor: pointer;
        transition: .3s;
    }

    .sidebar-heart:hover {
        background: #ffe5e5;
        color: #e63946;
    }

    .sidebar-heart.active {
        background: #ffe5e5;
        color: #e63946;
    }
</style>
<!-- Overlay -->
<div id="booksOverlay" class="books-overlay"></div>

<div id="allBooksSidebar" class="books-sidebar" role="dialog" aria-modal="true" aria-labelledby="booksSidebarTitle">
    <div class="books-sidebar-header">
        <button id="closeBooksBtn" class="close-sidebar-btn" aria-label="Close">&times;</button>

        <h3 class="sidebar-title" id="booksSidebarTitle">Explore the Library</h3>
        <p class="sidebar-subtitle">Browse every book or jump into a category</p>

        <div class="search-wrap">
            <input type="text" id="bookSearchInput" placeholder="Search books or authors..."
                aria-label="Search books or authors">
        </div>

        <div class="tab-switch" role="tablist">
            <button class="sidebar-tab-btn active" data-tab="books" role="tab" aria-selected="true">All Books</button>
            <button class="sidebar-tab-btn" data-tab="categories" role="tab" aria-selected="false">Categories</button>
            @auth
                <button class="sidebar-tab-btn" data-tab="favorites">Favorites</button>
            @endauth
        </div>
    </div>

    <div class="books-sidebar-body">
        <div id="booksTab" class="sidebar-tab-content active" role="tabpanel">
            @forelse($allBooks as $book)
                <a href="javascript:void(0)" class="sidebar-book-item" data-id="{{ $book->id }}"
                    data-name="{{ $book->book_name }}" data-author="{{ $book->arthur_name }}"
                    data-image="{{ asset('uploads/books/' . $book->book_image) }}"
                    data-description="{{ $book->description }}"
                    data-pdf="{{ $book->pdf_file ? asset('uploads/books/' . $book->pdf_file) : '' }}">
                    <img src="{{ asset('uploads/books/' . $book->book_image) }}" alt="{{ $book->book_name }}"
                        loading="lazy">
                    <div class="sidebar-book-info">

                        <div class="book-header">
                            <div class="book-text">
                                <h4>{{ $book->book_name }}</h4>
                                <span>{{ $book->author_name }}</span>
                            </div>

                            @auth
                                <button class="sidebar-heart {{ in_array($book->id, $userFavoriteIds) ? 'active' : '' }}"
                                    data-book-id="{{ $book->id }}">
                                    <i class="fas fa-heart"></i>
                                </button>
                            @endauth
                        </div>

                    </div>
                </a>
            @empty
                <div class="sidebar-empty">No books found.</div>
            @endforelse
            <div class="sidebar-empty" id="noBookResults" style="display:none;">No matches found.</div>
        </div>

        <div id="categoriesTab" class="sidebar-tab-content" role="tabpanel">
            @forelse($categories as $category)
                <a href="" class="sidebar-category-item">
                    <h4>{{ $category->category_name }}</h4>
                </a>
            @empty
                <div class="sidebar-empty">No categories found.</div>
            @endforelse
        </div>
        <div id="favoritesTab" class="sidebar-tab-content" role="tabpanel">

    @forelse($favoriteBooks as $book)

        <a href="javascript:void(0)"
           class="sidebar-book-item"
           data-id="{{ $book->id }}"
           data-name="{{ $book->book_name }}"
           data-author="{{ $book->author_name }}"
           data-image="{{ asset('uploads/books/'.$book->book_image) }}"
           data-description="{{ $book->description }}"
           data-pdf="{{ $book->book_pdf ? asset('uploads/pdfs/'.$book->book_pdf) : '' }}">

            <img src="{{ asset('uploads/books/'.$book->book_image) }}"
                 alt="{{ $book->book_name }}"
                 loading="lazy">

            <div class="sidebar-book-info">

                <div class="book-header">

                    <div class="book-text">
                        <h4>{{ $book->book_name }}</h4>
                        <span>{{ $book->author_name }}</span>
                    </div>

                    <button class="sidebar-heart active"
                            data-book-id="{{ $book->id }}">
                        <i class="fas fa-heart"></i>
                    </button>

                </div>

            </div>

        </a>

    @empty

        <div class="sidebar-empty">
            <i class="fas fa-heart-broken"></i>
            <h4>No Favorite Books</h4>
            <p>Books you add to favorites will appear here.</p>
        </div>

    @endforelse

</div>
    </div>
</div>

@push('scripts')
    <script>
        document.querySelectorAll(".sidebar-tab-btn").forEach(button => {

    button.addEventListener("click", function(){

        document.querySelectorAll(".sidebar-tab-btn")
            .forEach(btn => btn.classList.remove("active"));

        document.querySelectorAll(".sidebar-tab-content")
            .forEach(tab => tab.classList.remove("active"));

        this.classList.add("active");

        document.getElementById(this.dataset.tab + "Tab")
            .classList.add("active");

    });

});
    </script>

@endpush