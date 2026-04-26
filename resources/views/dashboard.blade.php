@extends('layouts.app')

@section('title', 'Dashboard — Pustaka Nusantara')

@section('styles')
<style>
    .hero-banner {
        width: 100%;
        height: 220px;
        object-fit: cover;
        display: block;
        background: linear-gradient(135deg, #1a1a2e 0%, #2d1b00 50%, #1a1a2e 100%);
        position: relative;
        overflow: hidden;
    }

    .hero-banner-inner {
        width: 100%;
        height: 220px;
        background: url('https://asset.kompas.com/crop/65x65:865x599/750x500/data/photo/2017/06/28/1265845835.jpg') center/cover no-repeat;
        position: relative;
    }

    .hero-banner-inner::after {
        content: '';
        position: absolute;
        inset: 0;
        background: rgba(0,0,0,0.35);
    }

    .welcome-bar {
        background: #fff;
        border-bottom: 1px solid #eaecf5;
        padding: 0.9rem 0;
    }

    .welcome-text {
        font-family: 'DM Sans', sans-serif;
        font-size: 0.95rem;
        color: #2d3047;
        margin: 0;
    }

    .welcome-text span {
        color: #3d5af1;
        font-weight: 700;
    }

    .search-section {
        background: #fff;
        padding: 1.2rem 0;
        border-bottom: 1px solid #eee;
        box-shadow: 0 2px 8px rgba(0,0,0,0.06);
    }

    .search-input {
        border: 1.5px solid #dde3f5;
        border-radius: 8px;
        padding: 0.6rem 1rem;
        font-family: 'DM Sans', sans-serif;
        font-size: 0.92rem;
        color: #2d3047;
        outline: none;
        width: 100%;
        transition: border-color 0.2s;
    }

    .search-input:focus { border-color: #3d5af1; }

    .select-input {
        border: 1.5px solid #dde3f5;
        border-radius: 8px;
        padding: 0.6rem 1rem;
        font-family: 'DM Sans', sans-serif;
        font-size: 0.92rem;
        color: #6b7aaa;
        outline: none;
        width: 100%;
        background: #fff;
        cursor: pointer;
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%236b7aaa' d='M6 8L1 3h10z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 0.9rem center;
        padding-right: 2rem;
        transition: border-color 0.2s;
    }

    .select-input:focus { border-color: #3d5af1; }

    .btn-cari {
        background: #3d5af1;
        color: #fff;
        border: none;
        border-radius: 8px;
        padding: 0.6rem 1.6rem;
        font-family: 'DM Sans', sans-serif;
        font-weight: 600;
        font-size: 0.92rem;
        cursor: pointer;
        white-space: nowrap;
        transition: background 0.2s;
        width: 100%;
    }

    .btn-cari:hover { background: #2a44d4; }

    .main-content {
        background: #f8f9fc;
        padding: 2rem 0 3rem;
        min-height: 60vh;
    }

    .book-card {
        background: #fff;
        border-radius: 12px;
        border: 1px solid #eaecf5;
        padding: 1.5rem 1rem 1rem;
        text-align: center;
        transition: box-shadow 0.2s, transform 0.2s;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .book-card:hover {
        box-shadow: 0 8px 28px rgba(61,90,241,0.12);
        transform: translateY(-3px);
    }

    .book-icon {
        font-size: 5rem;
        margin-bottom: 1rem;
        display: block;
        line-height: 1;
    }

    .book-title {
        font-family: 'DM Sans', sans-serif;
        font-size: 0.95rem;
        font-weight: 600;
        color: #2d3047;
        margin-bottom: 0.2rem;
        line-height: 1.3;
    }

    .book-author {
        font-size: 0.82rem;
        color: #8b95bb;
        margin-bottom: auto;
    }

    .btn-selengkapnya {
        margin-top: 1.2rem;
        background: transparent;
        border: 1.5px solid #dde3f5;
        border-radius: 8px;
        padding: 0.45rem 1rem;
        font-family: 'DM Sans', sans-serif;
        font-size: 0.85rem;
        color: #3d5af1;
        cursor: pointer;
        transition: all 0.2s;
        width: 100%;
    }

    .btn-selengkapnya:hover {
        background: #3d5af1;
        color: #fff;
        border-color: #3d5af1;
    }

    .kategori-box {
        background: #fff;
        border-radius: 12px;
        border: 1px solid #eaecf5;
        padding: 1.2rem;
    }

    .kategori-title {
        font-family: 'DM Sans', sans-serif;
        font-weight: 700;
        font-size: 1rem;
        color: #2d3047;
        margin-bottom: 0.8rem;
    }

    .kategori-badge {
        display: inline-block;
        background: #e8f0fe;
        color: #3d5af1;
        border-radius: 20px;
        padding: 0.2em 0.7em;
        font-size: 0.78rem;
        font-weight: 500;
        margin-bottom: 0.4rem;
        margin-right: 0.3rem;
    }

    .info-count {
        font-size: 0.88rem;
        color: #6b7aaa;
        margin-top: 1.5rem;
    }

    .info-count strong { color: #2d3047; }
</style>
@endsection

@section('content')

<!-- Hero Banner  -->
<div class="hero-banner">
    <div class="hero-banner-inner"></div>
</div>

{{-- Welcome Bar --}}
<div class="welcome-bar">
    <div class="container">
        <p class="welcome-text">
            Selamat datang, <span>{{ $username }}</span>! Temukan koleksi buku favoritmu di sini.
        </p>
    </div>
</div>

<!-- Search Section -->
<div class="search-section">
    <div class="container">
        <div class="row g-2 align-items-center">
            <div class="col-12 col-md-4">
                <input type="text" class="search-input" placeholder="Judul Buku" id="searchJudul">
            </div>
            <div class="col-6 col-md-3">
                <select class="select-input" id="filterGenre">
                    <option value="">Pilih Genre</option>
                    <option>Novel</option>
                    <option>Non-fiksi</option>
                    <option>Self-help</option>
                    <option>Sejarah</option>
                    <option>Teknologi</option>
                    <option>Fiksi Ilmiah</option>
                </select>
            </div>
            <div class="col-6 col-md-3">
                <select class="select-input" id="filterStatus">
                    <option value="">Pilih Status</option>
                    <option>Tersedia</option>
                    <option>Dipinjam</option>
                </select>
            </div>
            <div class="col-12 col-md-2">
                <button class="btn-cari" onclick="filterBuku()">Cari Sekarang</button>
            </div>
        </div>
    </div>
</div>

<!-- Content -->
<div class="main-content">
    <div class="container">
        <div class="row g-3">

            <!-- Book Cards -->
            <div class="col-lg-10">
                <div class="row g-3" id="bookGrid">
                    @foreach($stats['books'] as $book)
                    <div class="col-6 col-md-3 book-item"
                        data-judul="{{ strtolower($book['judul']) }}"
                        data-genre="{{ $book['genre'] }}"
                        data-status="{{ $book['status'] }}">
                        <div class="book-card">
                            <span class="book-icon">📗</span>
                            <div class="book-title">{{ $book['judul'] }}</div>
                            <div class="book-author">{{ $book['pengarang'] }}</div>
                            <button class="btn-selengkapnya">Selengkapnya</button>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="info-count" id="infoCount">
                    Menampilkan <strong>1</strong> sampai <strong>{{ count($stats['books']) }}</strong> dari <strong>{{ count($stats['books']) }}</strong> data
                </div>
            </div>

            <!-- Sidebar Kategori -->
            <div class="col-lg-2">
                <div class="kategori-box">
                    <div class="kategori-title">Kategori</div>
                    <span class="kategori-badge">Novel</span>
                    <span class="kategori-badge">Non-fiksi</span>
                    <span class="kategori-badge">Self-help</span>
                    <span class="kategori-badge">Sejarah</span>
                    <span class="kategori-badge">Teknologi</span>
                    <span class="kategori-badge">Fiksi Ilmiah</span>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
function filterBuku() {
    const judul  = document.getElementById('searchJudul').value.toLowerCase();
    const genre  = document.getElementById('filterGenre').value;
    const status = document.getElementById('filterStatus').value;

    const items = document.querySelectorAll('.book-item');
    let visible = 0;

    items.forEach(item => {
        const matchJudul  = item.dataset.judul.includes(judul);
        const matchGenre  = genre  === '' || item.dataset.genre  === genre;
        const matchStatus = status === '' || item.dataset.status === status;

        if (matchJudul && matchGenre && matchStatus) {
            item.style.display = '';
            visible++;
        } else {
            item.style.display = 'none';
        }
    });

    document.getElementById('infoCount').innerHTML =
        `Menampilkan <strong>1</strong> sampai <strong>${visible}</strong> dari <strong>{{ count($stats['books']) }}</strong> data`;
}
</script>
@endsection