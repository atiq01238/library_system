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

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

	<link rel="stylesheet" type="text/css" href="{{ asset('css/normalize.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('icomoon/icomoon.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/vendor.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('style.css') }}">
</head>
	<style>
		.profile-modal-overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.4);
    z-index: 9998;
    justify-content: center;
    align-items: center;
}

.profile-modal-overlay.show {
    display: flex;
}

/* Blur everything behind the modal */
body.modal-open > *:not(.profile-modal-overlay) {
    filter: blur(4px);
    pointer-events: none;
    user-select: none;
}

.profile-modal {
    background: #fff;
    border-radius: 12px;
    padding: 30px;
    width: 90%;
    max-width: 400px;
    position: relative;
    box-shadow: 0 10px 40px rgba(0,0,0,0.2);
    animation: modalFadeIn 0.25s ease;
}

@keyframes modalFadeIn {
    from { opacity: 0; transform: translateY(-15px); }
    to { opacity: 1; transform: translateY(0); }
}

.profile-modal-close {
    position: absolute;
    top: 12px;
    right: 16px;
    background: none;
    border: none;
    font-size: 24px;
    cursor: pointer;
    color: #888;
}

.profile-modal-content {
    text-align: center;
}

.profile-avatar img,
.avatar-placeholder {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    object-fit: cover;
    margin: 0 auto 15px;
}

.avatar-placeholder {
    display: flex;
    align-items: center;
    justify-content: center;
    background: #5b6df9;
    color: #fff;
    font-size: 32px;
    font-weight: 600;
}

.profile-email, .profile-phone, .profile-address {
    color: #777;
    font-size: 14px;
    margin: 4px 0;
}

.profile-actions {
    margin-top: 20px;
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.btn-profile {
    display: block;
    padding: 10px;
    border-radius: 6px;
    background: #f2f2f2;
    color: #333;
    text-decoration: none;
    border: none;
    font-size: 14px;
    cursor: pointer;
    width: 100%;
}

.btn-logout {
    background: #ffe5e5;
    color: #d33;
}
	</style>
<body data-bs-spy="scroll" data-bs-target="#header" tabindex="0"  data-logged-in="{{ auth()->check() ? 'true' : 'false' }}">

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

	@auth
		<div class="profile-modal-overlay" id="profileModalOverlay">
			<div class="profile-modal">
				<button class="profile-modal-close" id="profileModalClose">&times;</button>
				<div class="profile-modal-content">
					<div class="profile-avatar">
						@if(auth()->user()->avatar)
							<img src="{{ asset('uploads/avatars/' . auth()->user()->avatar) }}" alt="{{ auth()->user()->name }}">
						@else
							<div class="avatar-placeholder">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
						@endif
					</div>
					<h3>{{ auth()->user()->name }}</h3>
					<p class="profile-email">{{ auth()->user()->email }}</p>
					
					<hr>
					<div class="profile-actions">
						{{-- <a href="" class="btn-profile">Edit Profile</a> --}}
						<form method="POST" action="{{ route('logout') }}">
							@csrf
							<button type="submit" class="btn-profile btn-logout">Logout</button>
						</form>
					</div>
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