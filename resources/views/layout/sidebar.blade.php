<aside class="left-sidebar" id="sidebar">
  <!-- Sidebar scroll-->
  <div>
    <div class="brand-logo d-flex align-items-center justify-content-between">
      <a href="./index.html" class="text-nowrap logo-img d-flex align-items-center gap-2">
        <img src="{{ asset('assets/images/logos/logo.svg') }}" alt="Logo" height="32" />
        <span class="fw-bold fs-5 text-white d-none d-lg-inline">LibraryHub</span>
      </a>
      <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
        <i class="ti ti-x fs-6"></i>
      </div>
    </div>

    <!-- Sidebar navigation-->
    <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
      <ul id="sidebarnav">

        <!-- Home -->
        <li class="nav-small-cap">
          <iconify-icon icon="solar:home-2-bold-duotone" class="nav-small-cap-icon fs-4"></iconify-icon>
          <span class="hide-menu">Home</span>
        </li>

        <li class="sidebar-item">
          <a class="sidebar-link {{ request()->is('/') ? 'active' : '' }}" href="admin">
            <span class="d-flex">
              <i class="ti ti-layout-dashboard"></i>
            </span>
            <span class="hide-menu">Dashboard</span>
          </a>
        </li>

        <!-- Library Management -->
        <li class="nav-small-cap mt-2">
          <iconify-icon icon="solar:book-2-bold-duotone" class="nav-small-cap-icon fs-4"></iconify-icon>
          <span class="hide-menu">Library</span>
        </li>

        <li class="sidebar-item">
          <a class="sidebar-link has-arrow {{ request()->is('add-book') || request()->is('all-books') ? 'active' : '' }}"
             href="javascript:void(0)" aria-expanded="false">
            <div class="d-flex align-items-center gap-3">
              <span class="d-flex">
                <i class="ti ti-books"></i>
              </span>
              <span class="hide-menu">Books</span>
            </div>
          </a>
          <ul aria-expanded="false" class="collapse first-level">
            <li class="sidebar-item">
              <a class="sidebar-link {{ request()->is('add-book') ? 'active' : '' }}" href="/add-book">
                <div class="d-flex align-items-center gap-3">
                  <div class="round-16 d-flex align-items-center justify-content-center">
                    <i class="ti ti-plus"></i>
                  </div>
                  <span class="hide-menu">Add Book</span>
                </div>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link {{ request()->is('all-books') ? 'active' : '' }}" href="/all-books">
                <div class="d-flex align-items-center gap-3">
                  <div class="round-16 d-flex align-items-center justify-content-center">
                    <i class="ti ti-list-details"></i>
                  </div>
                  <span class="hide-menu">All Books</span>
                </div>
              </a>
            </li>

            @auth
              @if(in_array(auth()->user()->role, ['admin', 'member']))
                <li class="sidebar-item">
                  <a class="sidebar-link {{ request()->is('book-categories') ? 'active' : '' }}" href="/book-categories">
                    <div class="d-flex align-items-center gap-3">
                      <div class="round-16 d-flex align-items-center justify-content-center">
                        <i class="ti ti-category"></i>
                      </div>
                      <span class="hide-menu">Categories</span>
                    </div>
                  </a>
                </li>
              @endif
            @endauth
          </ul>
        </li>

        <!-- Admin only: Users -->
        @auth
          @if(auth()->user()->role === 'admin')
            <li class="nav-small-cap mt-2">
              <iconify-icon icon="solar:shield-user-bold-duotone" class="nav-small-cap-icon fs-4"></iconify-icon>
              <span class="hide-menu">Administration</span>
            </li>

            <li class="sidebar-item">
              <a class="sidebar-link {{ request()->is('users') ? 'active' : '' }}" href="{{ url('/users') }}">
                <div class="d-flex align-items-center gap-3">
                  <span class="d-flex">
                    <i class="ti ti-users"></i>
                  </span>
                  <span class="hide-menu">Users</span>
                </div>
              </a>
            </li>
          @endif
        @endauth

        <li>
          <span class="sidebar-divider lg"></span>
        </li>

        <!-- Logged-in user footer card -->
        @auth
          <li class="sidebar-item px-3 mt-2">
            <div class="d-flex align-items-center gap-2 p-2 rounded-3 bg-light-subtle">
              <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center text-white fw-bold"
                   style="width:36px;height:36px;">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
              </div>
              <div class="hide-menu">
                <h6 class="mb-0 fw-semibold fs-3">{{ auth()->user()->name }}</h6>
                <span class="fs-2 text-muted text-capitalize">{{ auth()->user()->role }}</span>
              </div>
            </div>
          </li>
        @endauth

      </ul>
    </nav>
    <!-- End Sidebar navigation -->
  </div>
  <!-- End Sidebar scroll-->
</aside>