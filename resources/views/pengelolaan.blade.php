@extends('layouts.app')

@section('title', 'Pengelolaan Buku — Pustaka Nusantara')

@section('styles')
<style>
    .page-header {
        background: #fff;
        border-bottom: 1px solid #eaecf5;
        padding: 1.5rem 0;
    }

    .page-header h1 {
        font-family: 'DM Sans', sans-serif;
        color: #2d3047;
        font-size: 1.4rem;
        font-weight: 700;
        margin: 0;
    }

    .page-header p {
        color: #8b95bb;
        margin: 0.2rem 0 0;
        font-size: 0.88rem;
    }

    .total-badge {
        background: #e8f0fe;
        color: #3d5af1;
        border-radius: 20px;
        padding: 0.3rem 1rem;
        font-size: 0.85rem;
        font-weight: 600;
        white-space: nowrap;
    }

    /* ── table desktop ── */
    .table-card {
        background: #fff;
        border-radius: 14px;
        border: 1px solid #eaecf5;
        box-shadow: 0 4px 16px rgba(61,90,241,0.06);
        overflow: hidden;
    }

    .table {
        font-size: 0.9rem;
        margin: 0;
    }

    .table thead th {
        background: #f0f4ff;
        color: #3d5af1;
        font-family: 'DM Sans', sans-serif;
        font-weight: 600;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        border: none;
        padding: 0.9rem 1.1rem;
    }

    .table tbody tr {
        border-bottom: 1px solid #f0f2fa;
        transition: background 0.15s;
    }

    .table tbody tr:last-child { border-bottom: none; }
    .table tbody tr:hover { background: #f8f9ff; }

    .table tbody td {
        padding: 0.85rem 1.1rem;
        color: #2d3047;
        vertical-align: middle;
        border: none;
    }

    .no-col    { color: #8b95bb; font-weight: 500; }
    .judul-col { font-weight: 600; color: #2d3047; }
    .author-col{ color: #6b7aaa; }

    .badge-genre {
        font-size: 0.75rem;
        font-weight: 500;
        padding: 0.3em 0.8em;
        border-radius: 20px;
        font-family: 'DM Sans', sans-serif;
    }

    .badge-novel       { background: #fde8d0; color: #7a3b10; }
    .badge-sejarah     { background: #d4e8f5; color: #0d4d72; }
    .badge-nonfiksi    { background: #d8f0e2; color: #1a6636; }
    .badge-selfhelp    { background: #f0d8f5; color: #6a1a7a; }
    .badge-fiksiilmiah { background: #d8e4f5; color: #1a3a7a; }
    .badge-teknologi   { background: #f5f0d0; color: #6a5a0a; }
    .badge-default     { background: #e8e8f5; color: #444;    }

    .badge-tersedia { background: #d8f0e2; color: #1a6636; font-size:0.75rem; padding:0.3em 0.8em; border-radius:20px; font-weight:500; }
    .badge-dipinjam { background: #fde8d0; color: #7a3b10; font-size:0.75rem; padding:0.3em 0.8em; border-radius:20px; font-weight:500; }

    /* card mb */
    .book-list-card {
        background: #fff;
        border-radius: 12px;
        border: 1px solid #eaecf5;
        box-shadow: 0 2px 10px rgba(61,90,241,0.05);
        padding: 1rem 1.1rem;
    }

    .book-list-card .blc-no {
        font-size: 0.75rem;
        color: #8b95bb;
        font-weight: 500;
        margin-bottom: 0.2rem;
    }

    .book-list-card .blc-judul {
        font-weight: 700;
        color: #2d3047;
        font-size: 0.95rem;
        margin-bottom: 0.15rem;
    }

    .book-list-card .blc-author {
        font-size: 0.82rem;
        color: #6b7aaa;
        margin-bottom: 0.5rem;
    }

    .book-list-card .blc-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 0.4rem;
    }
</style>
@endsection

@section('content')
<!-- header -->
<div class="page-header">
    <div class="container d-flex justify-content-between align-items-center flex-wrap gap-3">
        <div>
            <h1><i class="bi bi-journal-bookmark me-2" style="color:#3d5af1;"></i>Pengelolaan Buku</h1>
            <p>Halo <strong style="color:#3d5af1;">{{ $username }}</strong>, berikut daftar seluruh koleksi buku perpustakaan.</p>
        </div>
        <span class="total-badge">{{ count($books) }} Judul Buku</span>
    </div>
</div>

<section style="padding: 2rem 0 3rem; background: #f8f9fc;">
    <div class="container">

        <!-- desktop -->
        <div class="table-card d-none d-md-block">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul Buku</th>
                            <th>Pengarang</th>
                            <th>Genre</th>
                            <th>Tahun</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($books as $index => $book)
                        <tr>
                            <td class="no-col">{{ $index + 1 }}</td>
                            <td class="judul-col">{{ $book['judul'] }}</td>
                            <td class="author-col">{{ $book['pengarang'] }}</td>
                            <td>
                                @php
                                    $genreClass = match($book['genre']) {
                                        'Novel'        => 'badge-novel',
                                        'Sejarah'      => 'badge-sejarah',
                                        'Non-fiksi'    => 'badge-nonfiksi',
                                        'Self-help'    => 'badge-selfhelp',
                                        'Fiksi Ilmiah' => 'badge-fiksiilmiah',
                                        'Teknologi'    => 'badge-teknologi',
                                        default        => 'badge-default',
                                    };
                                @endphp
                                <span class="badge-genre {{ $genreClass }}">{{ $book['genre'] }}</span>
                            </td>
                            <td>{{ $book['tahun'] }}</td>
                            <td>
                                @if($book['status'] === 'Tersedia')
                                    <span class="badge-tersedia"><i class="bi bi-check-circle me-1"></i>Tersedia</span>
                                @else
                                    <span class="badge-dipinjam"><i class="bi bi-clock me-1"></i>Dipinjam</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- mobile -->
        <div class="d-flex d-md-none flex-column gap-3">
            @foreach($books as $index => $book)
            @php
                $genreClass = match($book['genre']) {
                    'Novel'        => 'badge-novel',
                    'Sejarah'      => 'badge-sejarah',
                    'Non-fiksi'    => 'badge-nonfiksi',
                    'Self-help'    => 'badge-selfhelp',
                    'Fiksi Ilmiah' => 'badge-fiksiilmiah',
                    'Teknologi'    => 'badge-teknologi',
                    default        => 'badge-default',
                };
            @endphp
            <div class="book-list-card">
                <div class="blc-no">#{{ $index + 1 }}</div>
                <div class="blc-judul">{{ $book['judul'] }}</div>
                <div class="blc-author"><i class="bi bi-person me-1"></i>{{ $book['pengarang'] }} &middot; {{ $book['tahun'] }}</div>
                <div class="blc-footer">
                    <span class="badge-genre {{ $genreClass }}">{{ $book['genre'] }}</span>
                    @if($book['status'] === 'Tersedia')
                        <span class="badge-tersedia"><i class="bi bi-check-circle me-1"></i>Tersedia</span>
                    @else
                        <span class="badge-dipinjam"><i class="bi bi-clock me-1"></i>Dipinjam</span>
                    @endif
                </div>
            </div>
            @endforeach
        </div>

        <div style="font-size:0.85rem; color:#8b95bb; margin-top:1rem;">
            Menampilkan <strong style="color:#2d3047;">{{ count($books) }}</strong> data buku
        </div>

    </div>
</section>

@endsection