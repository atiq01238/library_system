<style>
.favorite-menu{
    position:relative;
}

.favorite-link{
    display:flex;
    align-items:center;
    gap:6px;
}

.favorite-link i{
    color:#c0392b;
    font-size:14px;
}

.favorite-panel{
    position:absolute;
    top:55px;
    right:0;
    left:auto;
    transform:translateY(-8px);
    width:380px;
    background:#fff;
    border-radius:14px;
    box-shadow:0 20px 45px rgba(20,15,10,.14);
    opacity:0;
    visibility:hidden;
    transition:opacity .25s ease, transform .25s ease, visibility .25s;
    overflow:hidden;
    z-index:9999;
    font-family:'Poppins', sans-serif;
}

.favorite-panel.active{
    opacity:1;
    visibility:visible;
    transform:translateY(0);
}

/* little arrow pointing up to the Favorites link */
.favorite-panel::before{
    content:"";
    position:absolute;
    top:-7px;
    right:28px;
    width:14px;
    height:14px;
    background:#fff;
    transform:rotate(45deg);
    box-shadow:-3px -3px 6px rgba(20,15,10,.03);
}

.favorite-header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:18px 20px;
    background:#faf5ef;
    border-bottom:1px solid #f0e6d8;
}

.favorite-header h4{
    margin:0;
    font-family:'Playfair Display', serif;
    font-size:17px;
    font-weight:600;
    color:#2b2b2b;
    letter-spacing:.3px;
}

.favorite-header small{
    display:block;
    margin-top:2px;
    color:#a99a86;
    font-size:12px;
}

.favorite-header button{
    width:28px;
    height:28px;
    border:none;
    background:#fff;
    color:#a99a86;
    border-radius:50%;
    cursor:pointer;
    font-size:16px;
    line-height:1;
    display:flex;
    align-items:center;
    justify-content:center;
    transition:.2s;
}

.favorite-header button:hover{
    background:#d5b59f;
    color:#fff;
}

.favorite-list{
    max-height:360px;
    overflow-y:auto;
    padding:8px 14px;
}

.favorite-list::-webkit-scrollbar{
    width:5px;
}
.favorite-list::-webkit-scrollbar-thumb{
    background:#e8ddcf;
    border-radius:10px;
}

.favorite-item{
    display:flex;
    gap:12px;
    padding:14px 6px;
    border-bottom:1px solid #f2ece3;
}

.favorite-item:last-child{
    border-bottom:none;
}

.favorite-item img{
    width:52px;
    height:74px;
    object-fit:cover;
    border-radius:6px;
    flex-shrink:0;
    box-shadow:0 4px 10px rgba(0,0,0,.08);
}

.book-info{
    flex:1;
    min-width:0;
}

.book-info h5{
    margin:0 0 3px;
    font-size:14px;
    font-weight:600;
    color:#2b2b2b;
    white-space:nowrap;
    overflow:hidden;
    text-overflow:ellipsis;
}

.book-info p{
    color:#a99a86;
    margin:0 0 10px;
    font-size:12.5px;
}

.book-buttons{
    display:flex;
    align-items:stretch;
    gap:8px;
}

.book-buttons a,
.removeFavorite{
    display:inline-flex;
    align-items:center;
    justify-content:center;
    gap:5px;
    height:30px;
    padding:0 13px;
    border-radius:7px;
    font-size:11.5px;
    font-weight:600;
    letter-spacing:.2px;
    line-height:1;
    box-sizing:border-box;
    transition:.2s;
}

.book-buttons a{
    background:#d5b59f;
    color:#fff;
    text-decoration:none;
    border:1px solid #d5b59f;
}

.book-buttons a i{
    font-size:11px;
}

.book-buttons a:hover{
    background:#c39d82;
    border-color:#c39d82;
    color:#fff;
}

.removeFavorite{
    border:1px solid #ecd9d9;
    background:#fff;
    color:#b23b3b;
    cursor:pointer;
}

.removeFavorite i{
    font-size:11px;
}

.removeFavorite:hover{
    background:#b23b3b;
    border-color:#b23b3b;
    color:#fff;
}

.favorite-count{
    background:#c0392b;
    color:#fff;
    padding:1px 6px;
    border-radius:30px;
    font-size:10.5px;
    margin-left:4px;
    vertical-align:2px;
}

.empty-state{
    text-align:center;
    padding:50px 20px;
}

.empty-state i{
    font-size:40px;
    color:#e6d6c4;
    margin-bottom:14px;
    display:block;
}

.empty-state h5{
    font-family:'Playfair Display', serif;
    font-size:16px;
    color:#2b2b2b;
    margin:0 0 6px;
}

.empty-state p{
    color:#a99a86;
    font-size:13px;
    margin:0;
}

@media (max-width:480px){
    .favorite-panel{
        width:92vw;
        right:-40px;
    }
}
</style>

<header id="header">
	<div class="container-fluid">
		<div class="row">

			<div class="col-md-2">
				<div class="main-logo">
					<a href="index.html"><img src="images/main-logo.png" alt="logo"></a>
				</div>
			</div>

			<div class="col-md-10">

				<nav id="navbar">
					<div class="main-menu stellarnav">
						<ul class="menu-list">
							<li class="menu-item active"><a href="/">Home</a></li>
							@auth
								<li class="menu-item favorite-menu">

									<a href="#" id="favoriteBtn" class="favorite-link">
										<i class="fas fa-heart"></i>
										Favorites
										<span class="favorite-count">
											{{ count($favoriteBooks) }}
										</span>
									</a>

									<div class="favorite-panel" id="favoriteDropdown">

										<div class="favorite-header">
											<div>
												<h4>My Favorite Books</h4>
												<small>{{ count($favoriteBooks) }} saved books</small>
											</div>
											<button id="closeFavorite">&times;</button>
										</div>

										<div class="favorite-list">

											@forelse($favoriteBooks as $book)

												<div class="favorite-item">

													<img src="{{ asset('uploads/books/' . $book->book_image) }}" alt="{{ $book->book_name }}">

													<div class="book-info">
														<h5>{{ $book->book_name }}</h5>
														<p>{{ $book->author_name }}</p>

														<div class="book-buttons">
															<a href="{{ asset('uploads/pdfs/' . $book->book_pdf) }}" target="_blank">
																<i class="fas fa-book-open"></i> Read
															</a>
															<button class="removeFavorite" data-book="{{ $book->id }}">
																<i class="fas fa-trash-alt"></i> Remove
															</button>
														</div>
													</div>

												</div>

											@empty

												<div class="empty-state">
													<i class="fas fa-heart-broken"></i>
													<h5>No Favorite Books</h5>
													<p>Start saving books by clicking the heart icon.</p>
												</div>

											@endforelse

										</div>

									</div>

								</li>
							@endauth
							<li class="menu-item has-sub">
								<a href="#pages" class="nav-link">Pages</a>
								<ul>
									<li class="active"><a href="/">Home</a></li>
									<li><a href="">About</a></li>
									<li><a href="">Contact</a></li>
									<li><a href="">Thank You</a></li>
								</ul>
							</li>
							<li class="menu-item"><a href="#featured-books" class="nav-link">Featured</a></li>
							<li class="menu-item"><a href="#popular-books" class="nav-link">Popular</a></li>
							<li class="menu-item"><a href="#latest-blog" class="nav-link">Articles</a></li>
						</ul>

						<div class="hamburger">
							<span class="bar"></span>
							<span class="bar"></span>
							<span class="bar"></span>
						</div>

					</div>
				</nav>

			</div>

		</div>
	</div>
</header>

@push('scripts')
	<script>
	const favoriteBtn = document.getElementById("favoriteBtn");
	const favoritePanel = document.getElementById("favoriteDropdown");
	const closeBtn = document.getElementById("closeFavorite");

	favoriteBtn.addEventListener("click", function(e){
		e.preventDefault();
		favoritePanel.classList.toggle("active");
	});

	closeBtn.addEventListener("click", function(){
		favoritePanel.classList.remove("active");
	});

	document.addEventListener("click", function(e){
		if(!favoritePanel.contains(e.target) && !favoriteBtn.contains(e.target)){
			favoritePanel.classList.remove("active");
		}
	});

	// Handle removing a book from favorites
	favoritePanel.addEventListener("click", function(e){

		const btn = e.target.closest(".removeFavorite");
		if(!btn) return;

		const bookId = btn.dataset.book;
		const item = btn.closest(".favorite-item");

		btn.disabled = true;

		fetch(`/books/${bookId}/favorite`, {
			method: "POST",
			headers: {
				"Content-Type": "application/json",
				"X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
			}
		})
		.then(res => {
			if(!res.ok) throw new Error("Request failed");
			return res.json();
		})
		.then(data => {
			// remove the row from the DOM
			item.remove();

			// update the badge count
			const countEls = document.querySelectorAll(".favorite-count");
			const newCount = data.count ?? countEls[0].textContent.trim() - 1;
			countEls.forEach(el => el.textContent = newCount);

			// update the "X saved books" line
			const smallEl = favoritePanel.querySelector(".favorite-header small");
			if(smallEl) smallEl.textContent = `${newCount} saved books`;

			// if none left, show the empty state
			if(newCount <= 0){
				favoritePanel.querySelector(".favorite-list").innerHTML = `
					<div class="empty-state">
						<i class="fas fa-heart-broken"></i>
						<h5>No Favorite Books</h5>
						<p>Start saving books by clicking the heart icon.</p>
					</div>`;
			}
		})
		.catch(err => {
			console.error(err);
			btn.disabled = false;
			alert("Couldn't remove this book. Please try again.");
		});
	});
	</script>
@endpush
