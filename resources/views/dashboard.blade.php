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
    
    .btn-reset {
        background: #e8f0fe;
        color: #3d5af1;
        border: none;
        border-radius: 8px;
        padding: 0.6rem 1rem;
        font-family: 'DM Sans', sans-serif;
        font-weight: 500;
        font-size: 0.92rem;
        cursor: pointer;
        white-space: nowrap;
        transition: all 0.2s;
        width: 100%;
        margin-top: 0.5rem;
    }
    
    .btn-reset:hover {
        background: #d4e0fc;
    }

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
        cursor: pointer;
        transition: all 0.2s;
    }
    
    .kategori-badge:hover {
        background: #3d5af1;
        color: white;
    }
    
    .kategori-badge.active {
        background: #3d5af1;
        color: white;
    }

    .info-count {
        font-size: 0.88rem;
        color: #6b7aaa;
        margin-top: 1.5rem;
    }

    .info-count strong { color: #2d3047; }
    
    /* Loading state */
    .loading-overlay {
        position: relative;
    }
    
    .loading-spinner {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 10;
    }
    
    .book-grid-loading {
        opacity: 0.5;
        pointer-events: none;
    }
    
    .spinner-border-sm {
        width: 1rem;
        height: 1rem;
        border-width: 0.15em;
    }
    
    .no-results {
        text-align: center;
        padding: 3rem;
        background: white;
        border-radius: 12px;
        border: 1px solid #eaecf5;
        color: #8b95bb;
    }
    
    .no-results i {
        font-size: 3rem;
        margin-bottom: 1rem;
        display: block;
    }
    
    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.5; }
    }
    
    .search-indicator {
        font-size: 0.75rem;
        color: #8b95bb;
        margin-top: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .search-indicator .typing {
        color: #3d5af1;
        font-weight: 500;
    }
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
                <input type="text" class="search-input" placeholder="🔍 Cari judul buku..." id="searchJudul" autocomplete="off">
            </div>
            <div class="col-6 col-md-3">
                <select class="select-input" id="filterGenre">
                    <option value="">Semua Genre</option>
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
                    <option value="">Semua Status</option>
                    <option>Tersedia</option>
                    <option>Dipinjam</option>
                </select>
            </div>
            <div class="col-12 col-md-2">
                <button class="btn-cari" onclick="resetAndSearch()">Reset Filter</button>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-12">
                <div class="search-indicator" id="searchIndicator">
                    <span>💡</span> Ketik untuk mencari — hasil akan muncul otomatis
                </div>
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
                <div id="bookGridContainer" style="position: relative; min-height: 300px;">
                    <div class="row g-3" id="bookGrid">
                        @foreach($stats['books'] as $index => $book)
                        <div class="col-6 col-md-3 book-item"
                            data-id="{{ $book['id'] }}"
                            data-judul="{{ strtolower($book['judul']) }}"
                            data-judul-asli="{{ $book['judul'] }}"
                            data-pengarang="{{ $book['pengarang'] }}"
                            data-genre="{{ $book['genre'] }}"
                            data-tahun="{{ $book['tahun'] }}"
                            data-status="{{ $book['status'] }}">
                            <div class="book-card">
                                <span class="book-icon">📗</span>
                                <div class="book-title">{{ $book['judul'] }}</div>
                                <div class="book-author">{{ $book['pengarang'] }}</div>
                                <button class="btn-selengkapnya" onclick="showBookDetail({{ $index }})">Selengkapnya</button>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="info-count" id="infoCount">
                    Menampilkan <strong id="startCount">1</strong> sampai <strong id="endCount">{{ count($stats['books']) }}</strong> dari <strong id="totalCount">{{ count($stats['books']) }}</strong> data
                </div>
            </div>

            <!-- Sidebar Kategori -->
            <div class="col-lg-2">
                <div class="kategori-box">
                    <div class="kategori-title">Kategori Populer</div>
                    <span class="kategori-badge" onclick="filterByGenre('Novel')">📖 Novel</span>
                    <span class="kategori-badge" onclick="filterByGenre('Non-fiksi')">📚 Non-fiksi</span>
                    <span class="kategori-badge" onclick="filterByGenre('Self-help')">🌟 Self-help</span>
                    <span class="kategori-badge" onclick="filterByGenre('Sejarah')">🏛️ Sejarah</span>
                    <span class="kategori-badge" onclick="filterByGenre('Teknologi')">💻 Teknologi</span>
                    <span class="kategori-badge" onclick="filterByGenre('Fiksi Ilmiah')">🚀 Fiksi Ilmiah</span>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
// Data buku lengkap dari server (disimpan untuk filter cepat)
const allBooks = @json($stats['books']);
let currentResults = [...allBooks];
let searchTimeout = null;
let isTyping = false;

// DOM Elements
const searchInput = document.getElementById('searchJudul');
const genreFilter = document.getElementById('filterGenre');
const statusFilter = document.getElementById('filterStatus');
const bookGrid = document.getElementById('bookGrid');
const infoCount = document.getElementById('infoCount');
const startCountSpan = document.getElementById('startCount');
const endCountSpan = document.getElementById('endCount');
const totalCountSpan = document.getElementById('totalCount');
const searchIndicator = document.getElementById('searchIndicator');

// Debounce function (delay saat berhenti ngetik)
function debounce(func, delay) {
    return function(...args) {
        if (searchTimeout) clearTimeout(searchTimeout);
        
        // Tampilkan indikator "sedang mengetik"
        if (!isTyping) {
            isTyping = true;
            if (searchIndicator) {
                searchIndicator.innerHTML = '<span>⌨️</span> <span class="typing">Sedang mengetik...</span> <span style="font-size:0.7rem;">(berhenti sejenak untuk mencari)</span>';
            }
        }
        
        searchTimeout = setTimeout(() => {
            isTyping = false;
            func.apply(this, args);
        }, delay);
    };
}

function performSearch() {
    const searchTerm = searchInput.value.toLowerCase().trim();
    const selectedGenre = genreFilter.value;
    const selectedStatus = statusFilter.value;
    
    // Update indikator
    if (searchIndicator && !isTyping) {
        if (searchTerm) {
            searchIndicator.innerHTML = `<span>🔍</span> Menampilkan hasil untuk: <strong>"${searchTerm}"</strong>`;
        } else if (selectedGenre || selectedStatus) {
            searchIndicator.innerHTML = `<span>🎯</span> Filter aktif: ${selectedGenre || 'Semua genre'} | ${selectedStatus || 'Semua status'}`;
        } else {
            searchIndicator.innerHTML = '<span>💡</span> Ketik untuk mencari — hasil akan muncul otomatis';
        }
    }
    
    // data
    const filtered = allBooks.filter(book => {
        //judul
        const matchJudul = searchTerm === '' || 
                          book.judul.toLowerCase().includes(searchTerm);
        
        // genre
        const matchGenre = selectedGenre === '' || 
                          book.genre === selectedGenre;
        
        //status
        const matchStatus = selectedStatus === '' || 
                           book.status === selectedStatus;
        
        return matchJudul && matchGenre && matchStatus;
    });
    
    currentResults = filtered;
    renderBooks(filtered);
    updateInfoCount(filtered.length);
}

// Render buku ke grid
function renderBooks(books) {
    if (!bookGrid) return;
    
    if (books.length === 0) {
        bookGrid.innerHTML = `
            <div class="col-12">
                <div class="no-results">
                    <i>📭</i>
                    <h5>Tidak ada buku ditemukan</h5>
                    <p>Coba dengan kata kunci atau filter yang berbeda</p>
                    <button class="btn-cari" onclick="resetFilters()" style="margin-top: 1rem; width: auto; padding: 0.5rem 1.5rem;">
                        Reset Filter
                    </button>
                </div>
            </div>
        `;
        return;
    }
    
    let html = '';
    books.forEach((book, index) => {
        // Pilih icon berdasarkan genre
        let icon = '📗';
        switch(book.genre) {
            case 'Novel': icon = '📖'; break;
            case 'Sejarah': icon = '🏛️'; break;
            case 'Teknologi': icon = '💻'; break;
            case 'Self-help': icon = '🌟'; break;
            case 'Fiksi Ilmiah': icon = '🚀'; break;
            case 'Non-fiksi': icon = '📚'; break;
            default: icon = '📗';
        }
        
        html += `
            <div class="col-6 col-md-3 book-item"
                data-id="${book.id}"
                data-judul="${book.judul.toLowerCase()}"
                data-judul-asli="${book.judul}"
                data-pengarang="${book.pengarang}"
                data-genre="${book.genre}"
                data-tahun="${book.tahun}"
                data-status="${book.status}">
                <div class="book-card">
                    <span class="book-icon">${icon}</span>
                    <div class="book-title">${escapeHtml(book.judul)}</div>
                    <div class="book-author">${escapeHtml(book.pengarang)}</div>
                    <button class="btn-selengkapnya" onclick="showBookDetail(${index})">Selengkapnya</button>
                </div>
            </div>
        `;
    });
    
    bookGrid.innerHTML = html;
}

function escapeHtml(text) {
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}

function updateInfoCount(total) {
    if (!startCountSpan || !endCountSpan || !totalCountSpan) return;
    
    const start = total > 0 ? 1 : 0;
    const end = total;
    totalCountSpan.textContent = allBooks.length;
    startCountSpan.textContent = start;
    endCountSpan.textContent = end;
    
    if (infoCount) {
        if (total !== allBooks.length) {
            infoCount.style.background = '#e8f0fe';
            infoCount.style.padding = '0.5rem 1rem';
            infoCount.style.borderRadius = '8px';
            infoCount.style.transition = 'all 0.3s';
        } else {
            infoCount.style.background = '';
            infoCount.style.padding = '';
        }
    }
}

// Reset semua filter
function resetFilters() {
    searchInput.value = '';
    genreFilter.value = '';
    statusFilter.value = '';
    performSearch();
}

function resetAndSearch() {
    resetFilters();
}

function filterByGenre(genre) {
    genreFilter.value = genre;
    performSearch();
}

function showBookDetail(index) {
    const book = currentResults[index];
    if (!book) return;
    
    // Bisa pakai alert atau modal bootstrap
    alert(`📚 ${book.judul}\n✍️ ${book.pengarang}\n📖 Genre: ${book.genre}\n📅 Tahun: ${book.tahun}\n📌 Status: ${book.status}`);
}

if (searchInput) {
    searchInput.addEventListener('input', debounce(performSearch, 500));
}

if (genreFilter) {
    genreFilter.addEventListener('change', performSearch);
}

if (statusFilter) {
    statusFilter.addEventListener('change', performSearch);
}

document.addEventListener('DOMContentLoaded', function() {
    performSearch();
    
    const currentGenre = genreFilter.value;
    if (currentGenre) {
        const badges = document.querySelectorAll('.kategori-badge');
        badges.forEach(badge => {
            if (badge.textContent.includes(currentGenre)) {
                badge.classList.add('active');
            }
        });
    }
});
</script>
@endsection