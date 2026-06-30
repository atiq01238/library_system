<!-- Overlay -->
<div id="booksOverlay" class="books-overlay"></div>

<div id="allBooksSidebar" class="books-sidebar" role="dialog" aria-modal="true" aria-labelledby="booksSidebarTitle">
    <div class="books-sidebar-header">
        <button id="closeBooksBtn" class="close-sidebar-btn" aria-label="Close">&times;</button>

        <h3 class="sidebar-title" id="booksSidebarTitle">Explore the Library</h3>
        <p class="sidebar-subtitle">Browse every book or jump into a category</p>

        <div class="search-wrap">
            <input type="text" id="bookSearchInput" placeholder="Search books or authors..." aria-label="Search books or authors">
        </div>

        <div class="tab-switch" role="tablist">
            <button class="sidebar-tab-btn active" data-tab="books" role="tab" aria-selected="true">All Books</button>
            <button class="sidebar-tab-btn" data-tab="categories" role="tab" aria-selected="false">Categories</button>
        </div>
    </div>

    <div class="books-sidebar-body">
        <div id="booksTab" class="sidebar-tab-content active" role="tabpanel">
           @forelse($allBooks as $book)
                <a href="javascript:void(0)"
                class="sidebar-book-item"
                data-id="{{ $book->id }}"
                data-name="{{ $book->book_name }}"
                data-author="{{ $book->arthur_name }}"
                data-image="{{ asset('uploads/books/' . $book->book_image) }}"
                data-description="{{ $book->description }}"
                data-pdf="{{ $book->pdf_file ? asset('uploads/books/' . $book->pdf_file) : '' }}">
                    <img src="{{ asset('uploads/books/' . $book->book_image) }}" alt="{{ $book->book_name }}" loading="lazy">
                    <div class="sidebar-book-info">
                        <h4>{{ $book->book_name }}</h4>
                        <span>{{ $book->arthur_name }}</span>
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
    </div>
</div>