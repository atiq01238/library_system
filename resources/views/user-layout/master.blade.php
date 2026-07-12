<!DOCTYPE html>
<html lang="en">

<head>
	<title>BookSaw - Free Book Store HTML CSS Template</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="format-detection" content="telephone=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="author" content="">
	<meta name="keywords" content="">
	<meta name="description" content="">
	<meta name="csrf-token" content="{{ csrf_token() }}">


	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/normalize.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('icomoon/icomoon.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/vendor.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('style.css') }}">
</head>


<body data-bs-spy="scroll" data-bs-target="#header" tabindex="0"
	data-logged-in="{{ auth()->check() ? 'true' : 'false' }}">

	<div id="header-wrap">

		<div class="top-content">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-6">
						<div class="social-links">
							<ul>
								<li>
									<a href="#"><i class="icon icon-facebook"></i></a>
								</li>
								<li>
									<a href="#"><i class="icon icon-twitter"></i></a>
								</li>
								<li>
									<a href="#"><i class="icon icon-youtube-play"></i></a>
								</li>
								<li>
									<a href="#"><i class="icon icon-behance-square"></i></a>
								</li>
							</ul>
						</div><!--social-links-->
					</div>
					<div class="col-md-6">
						<div class="right-element">
							@auth
								<a href="#" class="user-account for-buy" id="userAccountToggle">
									<i class="icon icon-user"></i>
									<span>{{ explode(' ', auth()->user()->name)[0] }}</span>
								</a>
							@else
								<a href="{{ route('login') }}" class="user-account for-buy">
									<i class="icon icon-user"></i>
									<span>Account</span>
								</a>
							@endauth
							<div class="action-menu">

								<div class="search-bar">
									<a href="#" class="search-button search-toggle" data-selector="#header-wrap">
										<i class="icon icon-search"></i>
									</a>
									<form role="search" method="get" class="search-box">
										<input class="search-field text search-input" placeholder="Search"
											type="search">
									</form>
								</div>
							</div>

						</div><!--top-right-->
					</div>

				</div>
			</div>
		</div><!--top-content-->

		@include('user-layout.header')

	</div><!--header-wrap-->

	@include('user-layout.index')

	@include('user-layout.footer')
	@include('components.chatbot')

	@auth
		<div class="profile-modal-overlay" id="profileModalOverlay">
			<div class="profile-modal profile-dashboard">

				<button class="profile-modal-close" id="profileModalClose">&times;</button>

				<div class="profile-modal-content">

					{{-- Avatar --}}
					{{-- <div class="profile-avatar">
						@if(auth()->user()->avatar)
						<img src="{{ asset('uploads/avatars/' . auth()->user()->avatar) }}">
						@else
						<div class="avatar-placeholder">
							{{ strtoupper(substr(auth()->user()->name,0,1)) }}
						</div>
						@endif
					</div> --}}

					<h3>{{ auth()->user()->name }}</h3>
					<p class="profile-email">{{ auth()->user()->email }}</p>

					<hr>

					{{-- Statistics --}}
					<div class="profile-stats">

						<div class="stat-box">
							<i class="fas fa-heart"></i>
							<h4>{{ count($favoriteBooks) }} </h4>
							<span>Favorites</span>
						</div>

						<div class="stat-box">
							<i class="fas fa-eye"></i>
							<h4 id="viewedCountStat">{{ $viewedBooksCount ?? 0 }}</h4>
							<span>Viewed</span>
						</div>

						<div class="stat-box">
							<i class="fas fa-book-reader"></i>
							<h4 id="readCountStat">{{ $readBooksCount ?? 0 }}</h4>
							<span>Read</span>
						</div>

					</div>

					<hr>

					{{-- Favorite Books --}}
					<div class="profile-favorites">

						<div class="section-title">
							❤️ My Favorite Books
						</div>

						@forelse($favoriteBooks->take(2) as $book)

							<div class="favorite-row">

								<img src="{{ asset('uploads/books/' . $book->book_image) }}">

								<div class="favorite-details">
									<h5>{{ $book->book_name }}</h5>
									<small>{{ $book->author_name }}</small>
								</div>

								<a href="{{ route('books.read', $book->id) }}" target="_blank" class="read-btn">
									Read
								</a>

							</div>

						@empty

							<div class="empty-books">
								No favorite books yet.
							</div>

						@endforelse

					</div>

					<form method="POST" action="{{ route('logout') }}">
						@csrf
						<button class="btn-profile btn-logout mt-3">
							Logout
						</button>
					</form>

				</div>

			</div>
		</div>
	@endauth
	<script src="{{ asset('js/main.js') }}"></script>
	<script src="{{ asset('js/jquery-1.11.0.min.js') }}"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
		crossorigin="anonymous"></script>
	<script src="{{ asset('js/plugins.js') }}"></script>
	<script src="{{ asset('js/script.js') }}"></script>

</body>
@stack('scripts')

</html>