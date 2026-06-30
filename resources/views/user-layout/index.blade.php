@include('css.user-layout')

<section id="billboard">
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <button class="prev slick-arrow">
                    <i class="icon icon-arrow-left"></i>
                </button>

                <div class="main-slider pattern-overlay">

                    @foreach($books as $book)
                        <div class="slider-item">
                            <div class="banner-content">
                                <h2 class="banner-title">{{ $book->book_name }}</h2>

                                <p>
                                    {{ Str::limit($book->description, 150) }}
                                </p>

                                <div class="btn-wrap">
                                    <a href="#" class="btn btn-outline-accent btn-accent-arrow">
                                        Read More
                                        <i class="icon icon-ns-arrow-right"></i>
                                    </a>
                                </div>
                            </div>

                            <img src="{{ asset('uploads/books/' . $book->book_image) }}" alt="{{ $book->book_name }}"
                                class="banner-image">
                        </div>
                    @endforeach

                </div>

                <button class="next slick-arrow">
                    <i class="icon icon-arrow-right"></i>
                </button>

            </div>
        </div>
    </div>
</section>

<section id="client-holder" data-aos="fade-up">
    <div class="container">
        <div class="row">
            <div class="inner-content">
                <div class="logo-wrap">
                    <div class="grid">
                        <a href="#"><img src="{{ asset('images/client-image1.png') }}" alt="client"></a>
                        <a href="#"><img src="{{ asset('images/client-image2.png') }}" alt="client"></a>
                        <a href="#"><img src="{{ asset('images/client-image3.png') }}" alt="client"></a>
                        <a href="#"><img src="{{ asset('images/client-image4.png') }}" alt="client"></a>
                        <a href="#"><img src="{{ asset('images/client-image5.png') }}" alt="client"></a>
                    </div>
                </div><!--image-holder-->
            </div>
        </div>
    </div>
</section>

<section id="featured-books" class="py-5 my-5">
    <div class="container">

        <div class="row">
            <div class="col-md-12">

                <div class="section-header align-center">
                    <div class="title">
                        <span>Some quality items</span>
                    </div>
                    <h2 class="section-title">Featured Books</h2>
                </div>

                <div class="product-list" data-aos="fade-up">
                    <div class="row">

                        @foreach($books as $book)
                            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">

                                <div class="product-item">

                                    <figure class="product-style">
                                        <img src="{{ asset('uploads/books/' . $book->book_image) }}"
                                            alt="{{ $book->book_name }}" class="book-cover">
                                    </figure>

                                    <div class="text-center mt-3">
                                        @auth
                                            <a href="{{ asset('uploads/pdfs/' . $book->book_pdf) }}" target="_blank"
                                                class="btn btn-dark px-4">
                                                📖 Read Book
                                            </a>
                                        @else
                                            <a href="{{ route('login') }}" class="btn btn-dark px-4">
                                                🔒 Login to Read
                                            </a>
                                        @endauth
                                    </div>
                                    <figcaption>

                                        <h3>{{ $book->book_name }}</h3>

                                        <span>{{ $book->arthur_name }}</span>

                                        <p class="mt-2">
                                            {{ \Illuminate\Support\Str::limit($book->description, 60) }}
                                        </p>

                                    </figcaption>

                                </div>

                            </div>
                        @endforeach

                    </div>
                </div>

            </div>
        </div>

        <div class="row">
            <div class="col-md-12">

                <div class="btn-wrap align-right">
                    <a href="#" id="openAllBooksBtn" class="btn-accent-arrow">
                        View All Books
                        <i class="icon icon-ns-arrow-right"></i>
                    </a>
                </div>

            </div>
        </div>

    </div>
</section>



<section id="popular-books" class="bookshelf py-5 my-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <div class="section-header align-center">
                    <div class="title">
                        <span>Some quality items</span>
                    </div>
                    <h2 class="section-title">Popular Books</h2>
                </div>

                <ul class="tabs">
                    <li data-tab-target="#all-genre" class="active tab">All Genre</li>

                    @foreach ($categories as $category)
                        <li data-tab-target="#{{ Str::slug($category->category_name) }}" class="tab">
                            {{ $category->category_name }}
                        </li>
                    @endforeach
                </ul>
                <div class="tab-content">

                    {{-- All Genre: latest books across all categories --}}
                    <div id="all-genre" data-tab-content class="active">
                        <div class="row">
                           @forelse ($latestBooks as $book)
                                <div class="col-md-3">
                                    <div class="product-item book-card"
                                        data-id="{{ $book->id }}"
                                        data-name="{{ $book->book_name }}"
                                        data-author="{{ $book->author_name }}"
                                        data-image="{{ asset('uploads/books/'.$book->book_image) }}"
                                        data-description="{{ $book->description }}"
                                        data-pdf="{{ $book->book_pdf ? asset('uploads/pdfs/'.$book->book_pdf) : '' }}">
                                        <figure class="product-style">
                                            <img src="{{ asset('uploads/books/' . $book->book_image) }}"
                                                alt="{{ $book->book_name }}" class="product-item">
                                        </figure>
                                        <figcaption>
                                            <h3>{{ $book->book_name }}</h3>
                                            <span>{{ $book->author_name }}</span>
                                        </figcaption>
                                    </div>
                                </div>
                            @empty
                                <p>No books available yet.</p>
                            @endforelse
                        </div>
                    </div>

                    {{-- One block per category --}}
                    @foreach ($categories as $category)
                        <div id="{{ Str::slug($category->category_name) }}" data-tab-content>
                            <div class="row">
                                @forelse ($category->books as $book)
                                    <div class="col-md-3">
                                        <div class="product-item book-card"
                                            data-id="{{ $book->id }}"
                                            data-name="{{ $book->book_name }}"
                                            data-author="{{ $book->author_name }}"
                                            data-image="{{ asset('uploads/books/'.$book->book_image) }}"
                                            data-description="{{ $book->description }}"
                                            data-pdf="{{ $book->book_pdf ? asset('uploads/pdfs/'.$book->book_pdf) : '' }}">
                                            <figure class="product-style">
                                                <img src="{{ asset('uploads/books/' . $book->book_image) }}"
                                                    alt="{{ $book->book_name }}" class="product-item">
                                            </figure>
                                            <figcaption>
                                                <h3>{{ $book->book_name }}</h3>
                                                <span>{{ $book->author_name }}</span>
                                            </figcaption>
                                        </div>
                                    </div>
                                @empty
                                    <p>No books in this category yet.</p>
                                @endforelse
                            </div>
                        </div>
                    @endforeach

                </div>

            </div><!--inner-tabs-->

        </div>
    </div>
</section>

<section id="quotation" class="align-center pb-5 mb-5">
    <div class="inner-content">
        <h2 class="section-title divider">Quote of the day</h2>
        <blockquote data-aos="fade-up">
            <q>“The more that you read, the more things you will know. The more that you learn, the more places
                you’ll go.”</q>
            <div class="author-name">Dr. Seuss</div>
        </blockquote>
    </div>
</section>



<section id="subscribe">
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-md-8">
                <div class="row">

                    <div class="col-md-6">

                        <div class="title-element">
                            <h2 class="section-title divider">Subscribe to our newsletter</h2>
                        </div>

                    </div>
                    <div class="col-md-6">

                        <div class="subscribe-content" data-aos="fade-up">
                            <p>Sed eu feugiat amet, libero ipsum enim pharetra hac dolor sit amet, consectetur. Elit
                                adipiscing enim pharetra hac.</p>
                            <form id="form">
                                <input type="text" name="email" placeholder="Enter your email addresss here">
                                <button class="btn-subscribe">
                                    <span>send</span>
                                    <i class="icon icon-send"></i>
                                </button>
                            </form>
                        </div>

                    </div>

                </div>
            </div>

        </div>
    </div>
</section>

<section id="latest-blog" class="py-5 my-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <div class="section-header align-center">
                    <div class="title">
                        <span>Read our articles</span>
                    </div>
                    <h2 class="section-title">Latest Articles</h2>
                </div>

                <div class="row">

                    <div class="col-md-4">

                        <article class="column" data-aos="fade-up">

                            <figure>
                                <a href="#" class="image-hvr-effect">
                                    <img src="images/post-img1.jpg" alt="post" class="post-image">
                                </a>
                            </figure>

                            <div class="post-item">
                                <div class="meta-date">Mar 30, 2021</div>
                                <h3><a href="#">Reading books always makes the moments happy</a></h3>

                                <div class="links-element">
                                    <div class="categories">inspiration</div>
                                    <div class="social-links">
                                        <ul>
                                            <li>
                                                <a href="#"><i class="icon icon-facebook"></i></a>
                                            </li>
                                            <li>
                                                <a href="#"><i class="icon icon-twitter"></i></a>
                                            </li>
                                            <li>
                                                <a href="#"><i class="icon icon-behance-square"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div><!--links-element-->

                            </div>
                        </article>

                    </div>
                    <div class="col-md-4">

                        <article class="column" data-aos="fade-up" data-aos-delay="200">
                            <figure>
                                <a href="#" class="image-hvr-effect">
                                    <img src="images/post-img2.jpg" alt="post" class="post-image">
                                </a>
                            </figure>
                            <div class="post-item">
                                <div class="meta-date">Mar 29, 2021</div>
                                <h3><a href="#">Reading books always makes the moments happy</a></h3>

                                <div class="links-element">
                                    <div class="categories">inspiration</div>
                                    <div class="social-links">
                                        <ul>
                                            <li>
                                                <a href="#"><i class="icon icon-facebook"></i></a>
                                            </li>
                                            <li>
                                                <a href="#"><i class="icon icon-twitter"></i></a>
                                            </li>
                                            <li>
                                                <a href="#"><i class="icon icon-behance-square"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div><!--links-element-->

                            </div>
                        </article>

                    </div>
                    <div class="col-md-4">

                        <article class="column" data-aos="fade-up" data-aos-delay="400">
                            <figure>
                                <a href="#" class="image-hvr-effect">
                                    <img src="images/post-img3.jpg" alt="post" class="post-image">
                                </a>
                            </figure>
                            <div class="post-item">
                                <div class="meta-date">Feb 27, 2021</div>
                                <h3><a href="#">Reading books always makes the moments happy</a></h3>

                                <div class="links-element">
                                    <div class="categories">inspiration</div>
                                    <div class="social-links">
                                        <ul>
                                            <li>
                                                <a href="#"><i class="icon icon-facebook"></i></a>
                                            </li>
                                            <li>
                                                <a href="#"><i class="icon icon-twitter"></i></a>
                                            </li>
                                            <li>
                                                <a href="#"><i class="icon icon-behance-square"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div><!--links-element-->

                            </div>
                        </article>

                    </div>

                </div>

                <div class="row">

                    <div class="btn-wrap align-center">
                        <a href="#" class="btn btn-outline-accent btn-accent-arrow" tabindex="0">Read All
                            Articles<i class="icon icon-ns-arrow-right"></i></a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

@include('user-layout.sidebar')
<div id="bookModalOverlay" class="book-modal-overlay"></div>

<div id="bookModal" class="book-modal">
    <button id="closeBookModal" class="book-modal-close">&times;</button>

    <div class="book-modal-img">
        <img id="modalBookImage" src="" alt="">
    </div>

    <div class="book-modal-info">
        <span class="modal-eyebrow">Featured Book</span>
        <h2 id="modalBookName"></h2>
        <span id="modalBookAuthor" class="modal-author"></span>
        <p id="modalBookDescription" class="modal-description"></p>

       <div class="book-modal-actions">
            <a id="modalReadBtn" href="#" target="_blank" class="btn btn-dark">📖 Read Book</a>
            <a id="modalLoginBtn" href="{{ route('login') }}" class="btn btn-dark">🔒 Login to Read</a>
        </div>
    </div>
</div>
