@extends('layout.master')

<style>
.stat-card {
    border-radius: 16px;
    border: none;
    box-shadow: 0 4px 18px rgba(0,0,0,0.06);
    transition: all 0.3s ease;
}
.stat-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
}
.stat-icon {
    width: 52px;
    height: 52px;
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
}
.welcome-banner {
    background: linear-gradient(135deg, #4f46e5, #7c3aed);
    border-radius: 20px;
    color: #fff;
}
.quick-action {
    border-radius: 14px;
    border: 1px solid #eee;
    transition: all 0.25s ease;
    text-decoration: none;
    color: #222;
}
.quick-action:hover {
    border-color: #4f46e5;
    background: #f5f3ff;
    color: #4f46e5;
}

/* Recent books table — rebuilt */
.recent-books-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
}
.recent-books-table thead th {
    font-size: 0.75rem;
    text-transform: uppercase;
    letter-spacing: 0.04em;
    color: #9ca3af;
    font-weight: 700;
    padding: 10px 14px;
    border-bottom: 2px solid #f1f1f4;
    background: #fafafa;
    white-space: nowrap;
}
.recent-books-table thead th:first-child { border-radius: 10px 0 0 0; }
.recent-books-table thead th:last-child { border-radius: 0 10px 0 0; }

.recent-books-table tbody tr {
    transition: background 0.2s ease;
}
.recent-books-table tbody tr:hover {
    background: #f8f7ff;
}
.recent-books-table td {
    padding: 14px;
    vertical-align: middle;
    border-bottom: 1px solid #f1f1f4;
    font-size: 0.9rem;
    color: #374151;
}
.recent-books-table tbody tr:last-child td {
    border-bottom: none;
}

.book-title-cell {
    font-weight: 600;
    color: #1f2937;
}

.category-pill {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: #eef2ff;
    color: #4f46e5;
    font-weight: 600;
    font-size: 0.78rem;
    padding: 6px 12px;
    border-radius: 50px;
    white-space: nowrap;
}
.category-pill.no-category {
    background: #f3f4f6;
    color: #9ca3af;
}
.category-pill i {
    font-size: 0.8rem;
}

.text-muted-soft {
    color: #9ca3af;
    font-size: 0.85rem;
}
</style>

@section('content')
    <div class="container-fluid py-4">

        <!-- Welcome banner -->
        <div class="welcome-banner p-4 p-md-5 mb-4 d-flex flex-wrap align-items-center justify-content-between gap-3">
            <div>
                <h2 class="fw-bold mb-1">Welcome back, {{ auth()->user()->name }} 👋</h2>
                <p class="mb-0 opacity-75">Here's what's happening in your library today.</p>
            </div>
            <a href="/add-book" class="btn btn-light text-primary fw-semibold rounded-pill px-4 py-2">
                <i class="ti ti-plus me-1"></i> Add New Book
            </a>
        </div>

        <!-- Stat cards -->
        <div class="row g-4 mb-4">
            <div class="col-sm-6 col-lg-3">
                <div class="card stat-card p-3 h-100">
                    <div class="d-flex align-items-center gap-3">
                        <div class="stat-icon bg-primary-subtle text-primary">
                            <i class="ti ti-books"></i>
                        </div>
                        <div>
                            <h3 class="mb-0 fw-bold">{{ $totalBooks ?? 0 }}</h3>
                            <small class="text-muted">Total Books</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="card stat-card p-3 h-100">
                    <div class="d-flex align-items-center gap-3">
                        <div class="stat-icon bg-success-subtle text-success">
                            <i class="ti ti-category"></i>
                        </div>
                        <div>
                            <h3 class="mb-0 fw-bold">{{ $totalCategories ?? 0 }}</h3>
                            <small class="text-muted">Categories</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="card stat-card p-3 h-100">
                    <div class="d-flex align-items-center gap-3">
                        <div class="stat-icon bg-warning-subtle text-warning">
                            <i class="ti ti-users"></i>
                        </div>
                        <div>
                            <h3 class="mb-0 fw-bold">{{ $totalUsers ?? 0 }}</h3>
                            <small class="text-muted">Active Users</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="card stat-card p-3 h-100">
                    <div class="d-flex align-items-center gap-3">
                        <div class="stat-icon bg-danger-subtle text-danger">
                            <i class="ti ti-clock-exclamation"></i>
                        </div>
                        <div>
                            {{-- <h3 class="mb-0 fw-bold">{{ $overdueBooks ?? 0 }}</h3> --}}
                            <small class="text-muted">Overdue Returns</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <!-- Recently added books -->
            <div class="col-lg-8">
               <div class="card stat-card h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h5 class="fw-bold mb-0">Recently Added Books</h5>
                            <a href="/all-books" class="fs-3 text-primary text-decoration-none fw-semibold">View All</a>
                        </div>
                        <div class="table-responsive">
                            <table class="recent-books-table">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Category</th>
                                        <th>Author</th>
                                        <th>Added</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse(($recentBooks ?? []) as $book)
                                    <tr>
                                        <td class="book-title-cell">{{ $book->book_name}}</td>
                                        <td>
                                            @if($book->category)
                                                <span class="category-pill">
                                                    <i class="ti ti-tag"></i>
                                                    {{ $book->category->category_name }}
                                                </span>
                                            @else
                                                <span class="category-pill no-category">
                                                    <i class="ti ti-tag-off"></i>
                                                    Uncategorized
                                                </span>
                                            @endif
                                        </td>
                                        <td class="text-muted-soft">{{ $book->author_name }}</td>
                                        <td class="text-muted-soft">{{ $book->created_at->diffForHumans() }}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-muted py-4">No books added yet.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick actions -->
            <div class="col-lg-4">
                <div class="card stat-card h-100">
                    <div class="card-body">
                        <h5 class="fw-bold mb-3">Quick Actions</h5>
                        <div class="d-flex flex-column gap-2">
                            <a href="/add-book" class="quick-action p-3 d-flex align-items-center gap-3">
                                <i class="ti ti-plus fs-5"></i>
                                <span class="fw-semibold">Add a New Book</span>
                            </a>
                            <a href="/all-books" class="quick-action p-3 d-flex align-items-center gap-3">
                                <i class="ti ti-list-details fs-5"></i>
                                <span class="fw-semibold">Manage Books</span>
                            </a>
                            @auth
                                @if(in_array(auth()->user()->role, ['admin', 'member']))
                                    <a href="/book-categories" class="quick-action p-3 d-flex align-items-center gap-3">
                                        <i class="ti ti-category fs-5"></i>
                                        <span class="fw-semibold">Manage Categories</span>
                                    </a>
                                @endif
                                @if(auth()->user()->role === 'admin')
                                    <a href="/users" class="quick-action p-3 d-flex align-items-center gap-3">
                                        <i class="ti ti-users fs-5"></i>
                                        <span class="fw-semibold">Manage Users</span>
                                    </a>
                                @endif
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection