<style>
.search-suggestions-dropdown {
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.12);
    margin-top: 8px;
    max-height: 360px;
    overflow-y: auto;
    z-index: 1050;
    display: none;
}
.search-suggestions-dropdown.show {
    display: block;
}
.suggestion-item {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 10px 14px;
    cursor: pointer;
    text-decoration: none;
    color: #222;
    transition: background 0.15s ease;
}
.suggestion-item:hover {
    background: #f5f3ff;
}
.suggestion-item img {
    width: 36px;
    height: 48px;
    object-fit: cover;
    border-radius: 4px;
    flex-shrink: 0;
}
.suggestion-item .info {
    overflow: hidden;
}
.suggestion-item .info h6 {
    margin: 0;
    font-size: 0.85rem;
    font-weight: 600;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
.suggestion-item .info small {
    color: #888;
}
.suggestion-empty {
    padding: 14px;
    text-align: center;
    color: #999;
    font-size: 0.85rem;
}
</style>
<header class="app-header">
  <nav class="navbar navbar-expand-lg navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item d-block d-xl-none">
        <a class="nav-link sidebartoggler" id="headerCollapse" href="javascript:void(0)">
          <i class="ti ti-menu-2"></i>
        </a>
      </li>

      <!-- Search -->
     <li class="nav-item d-none d-md-flex align-items-center ms-2 position-relative">
          <div class="position-relative" style="width: 280px;">
              <i class="ti ti-search position-absolute top-50 translate-middle-y ms-3 text-muted"></i>
              <input
                  type="text"
                  id="bookSearchInput"
                  class="form-control rounded-pill ps-5"
                  placeholder="Search by title or author..."
                  autocomplete="off"
              />
              <div id="searchSuggestions" class="search-suggestions-dropdown"></div>
          </div>
      </li>
    </ul>

    <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
      <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end gap-1">

        <!-- Notifications -->
        <li class="nav-item dropdown">
          <a class="nav-link position-relative" href="javascript:void(0)" id="drop1" data-bs-toggle="dropdown"
            aria-expanded="false">
            <i class="ti ti-bell fs-5"></i>
            <div class="notification bg-primary rounded-circle"></div>
          </a>
          <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up notification-dropdown"
            aria-labelledby="drop1" style="width: 320px;">
            <div class="d-flex align-items-center justify-content-between px-3 py-2 border-bottom">
              <h6 class="mb-0 fw-semibold">Notifications</h6>
              <span class="badge bg-primary-subtle text-primary rounded-pill">2 New</span>
            </div>
            <div class="message-body">
              <a href="javascript:void(0)" class="dropdown-item d-flex align-items-start gap-2 py-2">
                <span
                  class="rounded-circle bg-success-subtle text-success d-flex align-items-center justify-content-center flex-shrink-0"
                  style="width:36px;height:36px;">
                  <i class="ti ti-book-2 fs-5"></i>
                </span>
                <div>
                  <p class="mb-0 fs-3 fw-semibold">New book added</p>
                  <small class="text-muted">2 minutes ago</small>
                </div>
              </a>
              <a href="javascript:void(0)" class="dropdown-item d-flex align-items-start gap-2 py-2">
                <span
                  class="rounded-circle bg-warning-subtle text-warning d-flex align-items-center justify-content-center flex-shrink-0"
                  style="width:36px;height:36px;">
                  <i class="ti ti-alert-circle fs-5"></i>
                </span>
                <div>
                  <p class="mb-0 fs-3 fw-semibold">Book overdue reminder</p>
                  <small class="text-muted">1 hour ago</small>
                </div>
              </a>
            </div>
            <div class="text-center border-top py-2">
              <a href="javascript:void(0)" class="fs-3 fw-semibold text-primary text-decoration-none">View all
                notifications</a>
            </div>
          </div>
        </li>

        <!-- Profile -->
        <li class="nav-item dropdown">
          <a class="nav-link d-flex align-items-center gap-2" href="javascript:void(0)" id="drop2"
            data-bs-toggle="dropdown" aria-expanded="false">
            @if(auth()->user()->avatar ?? false)
              <img src="{{ auth()->user()->avatar }}" alt="" width="35" height="35" class="rounded-circle">
            @else
              <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center text-white fw-bold"
                style="width:35px;height:35px;">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
              </div>
            @endif
            <div class="d-none d-md-flex flex-column align-items-start">
              <span class="fs-3 fw-semibold lh-1">{{ auth()->user()->name }}</span>
              <span class="fs-2 text-muted text-capitalize lh-1">{{ auth()->user()->role }}</span>
            </div>
            <i class="ti ti-chevron-down fs-6 d-none d-md-inline text-muted"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2"
            style="width: 240px;">
            <div class="px-3 py-2 border-bottom">
              <p class="mb-0 fw-semibold fs-3">{{ auth()->user()->name }}</p>
              <small class="text-muted">{{ auth()->user()->email }}</small>
            </div>
            <div class="message-body">
              <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                <i class="ti ti-user fs-6"></i>
                <p class="mb-0 fs-3">My Profile</p>
              </a>
              <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                <i class="ti ti-mail fs-6"></i>
                <p class="mb-0 fs-3">My Account</p>
              </a>
              <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                <i class="ti ti-list-check fs-6"></i>
                <p class="mb-0 fs-3">My Task</p>
              </a>
            </div>
            <div class="border-top">
              <form action="{{ route('logout') }}" method="POST" class="m-0">
                @csrf
                <button type="submit"
                  class="dropdown-item d-flex align-items-center gap-2 border-0 bg-transparent text-danger w-100">
                  <i class="ti ti-logout fs-6"></i>
                  <span class="fs-3">Logout</span>
                </button>
              </form>
            </div>
          </div>
        </li>
      </ul>
    </div>
  </nav>
</header>
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const input = document.getElementById('bookSearchInput');
    const dropdown = document.getElementById('searchSuggestions');
    let debounceTimer;

    input.addEventListener('input', function () {
        clearTimeout(debounceTimer);
        const query = this.value.trim();

        if (query.length === 0) {
            dropdown.classList.remove('show');
            dropdown.innerHTML = '';
            return;
        }

        debounceTimer = setTimeout(() => {
            fetch(`{{ route('books.search.suggestions') }}?query=...`)
                .then(res => res.json())
                .then(books => {
                    dropdown.innerHTML = '';

                    if (books.length === 0) {
                        dropdown.innerHTML = '<div class="suggestion-empty">No books found</div>';
                    } else {
                        books.forEach(book => {
                            const link = document.createElement('a');
                            link.href = `/book/${book.id}`;
                            link.className = 'suggestion-item';
                            link.innerHTML = `
                                <img src="/uploads/books/${book.book_image}" alt="${book.book_name}">
                                <div class="info">
                                    <h6>${book.book_name}</h6>
                                    <small>${book.arthur_name}</small>
                                </div>
                            `;
                            dropdown.appendChild(link);
                        });
                    }

                    dropdown.classList.add('show');
                })
                .catch(() => {
                    dropdown.innerHTML = '<div class="suggestion-empty">Something went wrong</div>';
                    dropdown.classList.add('show');
                });
        }, 300); // 300ms debounce so it doesn't fire on every keystroke
    });

    // Hide dropdown when clicking outside
    document.addEventListener('click', function (e) {
        if (!input.contains(e.target) && !dropdown.contains(e.target)) {
            dropdown.classList.remove('show');
        }
    });
});
</script>
  
@endpush