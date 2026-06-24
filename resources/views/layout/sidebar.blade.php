<aside class="left-sidebar" id="sidebar">
      <!-- Sidebar scroll-->
      <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
          <a href="./index.html" class="text-nowrap logo-img">
            <img src="assets/images/logos/logo.svg" alt="" />
          </a>
          <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
            <i class="ti ti-x fs-6"></i>
          </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
          <ul id="sidebarnav">
            <li class="nav-small-cap">
              <iconify-icon icon="solar:menu-dots-linear" class="nav-small-cap-icon fs-4"></iconify-icon>
              <span class="hide-menu">Home</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="/" aria-expanded="false">
                <i class="ti ti-atom"></i>
                <span class="hide-menu">Dashboard</span>
              </a>
            </li>
            <!-- ---------------------------------- -->
            <!-- Dashboard -->
            <!-- ---------------------------------- -->
            <li class="sidebar-item">
              <a class="sidebar-link justify-content-between has-arrow" href="javascript:void(0)" aria-expanded="false">
                <div class="d-flex align-items-center gap-3">
                  <span class="d-flex">
                    <i class="ti ti-layout-grid"></i>
                  </span>
                  <span class="hide-menu">Books</span>
                </div>
                
              </a>
              <ul aria-expanded="false" class="collapse first-level">
                <li class="sidebar-item">
                  <a class="sidebar-link justify-content-between"  
                    href="/add-book">
                    <div class="d-flex align-items-center gap-3">
                      <div class="round-16 d-flex align-items-center justify-content-center">
                        <i class="ti ti-circle"></i>
                      </div>
                      <span class="hide-menu">Add Books</span>
                    </div>
                    
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link justify-content-between"  
                    href="/all-books">
                    <div class="d-flex align-items-center gap-3">
                      <div class="round-16 d-flex align-items-center justify-content-center">
                        <i class="ti ti-circle"></i>
                      </div>
                      <span class="hide-menu">All Books</span>
                    </div>
                    
                  </a>
                </li>
               
                @auth
                    @if(in_array(auth()->user()->role, ['admin', 'member']))
                        <li class="sidebar-item">
                            <a class="sidebar-link justify-content-between" href="/book-categories">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="round-16 d-flex align-items-center justify-content-center">
                                        <i class="ti ti-circle"></i>
                                    </div>
                                    <span class="hide-menu">Books Categories</span>
                                </div>
                            </a>
                        </li>
                    @endif
                @endauth
                              </ul>
            </li>
            {{-- <li class="sidebar-item">
              <a class="sidebar-link justify-content-between"  
                href="/users" aria-expanded="false">
                <div class="d-flex align-items-center gap-3">
                  <span class="d-flex">
                    <i class="ti ti-shopping-cart"></i>
                  </span>
                  <span class="hide-menu">Users</span>
                </div>
                
              </a>
            </li> --}}
            @auth
                @if(auth()->user()->role === 'admin')
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ url('/users') }}">
                            <div class="d-flex align-items-center gap-3">
                                <span><i class="ti ti-users"></i></span>
                                <span class="hide-menu">Users</span>
                            </div>
                        </a>
                    </li>
                @endif
            @endauth
           

            <li>
              <span class="sidebar-divider lg"></span>
            </li>
            
            
            
          </ul>
        </nav>
        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
    </aside>