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

    /* card mobile */
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

    /* tombol aksi */
    .action-buttons {
        display: flex;
        gap: 0.5rem;
        flex-wrap: wrap;
    }
    
    .btn-edit-sm, .btn-delete-sm {
        padding: 0.25rem 0.65rem;
        font-size: 0.75rem;
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.2s;
    }
    
    .btn-edit-sm {
        background: #e8f0fe;
        color: #3d5af1;
        border: none;
    }
    
    .btn-edit-sm:hover {
        background: #3d5af1;
        color: white;
    }
    
    .btn-delete-sm {
        background: #fee8e8;
        color: #dc3545;
        border: none;
    }
    
    .btn-delete-sm:hover {
        background: #dc3545;
        color: white;
    }
    
    .btn-add {
        background: #3d5af1;
        color: white;
        border: none;
        padding: 0.5rem 1.2rem;
        border-radius: 10px;
        font-weight: 600;
        font-size: 0.85rem;
        transition: all 0.2s;
        margin-bottom: 1rem;
    }
    
    .btn-add:hover {
        background: #2d4ad1;
        transform: translateY(-2px);
    }
    
    /* modal styling */
    .modal-custom .modal-content {
        border-radius: 20px;
        border: none;
        box-shadow: 0 20px 40px rgba(0,0,0,0.1);
    }
    
    .modal-custom .modal-header {
        background: #f8f9fc;
        border-bottom: 1px solid #eaecf5;
        border-radius: 20px 20px 0 0;
        padding: 1rem 1.5rem;
    }
    
    .modal-custom .modal-body {
        padding: 1.5rem;
    }
    
    .modal-custom .modal-footer {
        border-top: 1px solid #eaecf5;
        padding: 1rem 1.5rem;
    }
    
    .form-label-custom {
        font-weight: 600;
        font-size: 0.85rem;
        color: #2d3047;
        margin-bottom: 0.4rem;
    }
    
    .form-control-custom {
        border-radius: 10px;
        border: 1px solid #eaecf5;
        padding: 0.6rem 1rem;
        font-size: 0.9rem;
    }
    
    .form-control-custom:focus {
        border-color: #3d5af1;
        box-shadow: 0 0 0 3px rgba(61,90,241,0.1);
    }
    
    .mobile-action {
        margin-top: 0.5rem;
        padding-top: 0.5rem;
        border-top: 1px solid #f0f2fa;
    }
</style>
@endsection

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- header -->
<div class="page-header">
    <div class="container d-flex justify-content-between align-items-center flex-wrap gap-3">
        <div>
            <h1><i class="bi bi-journal-bookmark me-2" style="color:#3d5af1;"></i>Pengelolaan Buku</h1>
            <p>Halo <strong style="color:#3d5af1;">{{ $username }}</strong>, berikut daftar seluruh koleksi buku perpustakaan.</p>
        </div>
        <div class="d-flex gap-2">
            <button class="btn-add" data-bs-toggle="modal" data-bs-target="#tambahModal">
                <i class="bi bi-plus-circle me-1"></i>Tambah Buku
            </button>
        </div>
    </div>
</div>

<section style="padding: 2rem 0 3rem; background: #f8f9fc;">
    <div class="container">

        <!-- desktop table -->
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
                            <th style="text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="books-table-body">
                        @foreach($books as $index => $book)
                        <tr id="book-row-{{ $book['id'] }}">
                            <td class="no-col">{{ $index + 1 }}</td>
                            <td class="judul-col book-judul">{{ $book['judul'] }}</td>
                            <td class="author-col book-pengarang">{{ $book['pengarang'] }}</td>
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
                                <span class="badge-genre {{ $genreClass }} book-genre">{{ $book['genre'] }}</span>
                            </td>
                            <td class="book-tahun">{{ $book['tahun'] }}</td>
                            <td>
                                @if($book['status'] === 'Tersedia')
                                    <span class="badge-tersedia book-status"><i class="bi bi-check-circle me-1"></i>Tersedia</span>
                                @else
                                    <span class="badge-dipinjam book-status"><i class="bi bi-clock me-1"></i>Dipinjam</span>
                                @endif
                            </td>
                            <td style="text-align: center;">
                                <div class="action-buttons">
                                    <button class="btn-edit-sm" 
                                            data-id="{{ $book['id'] }}"
                                            data-judul="{{ $book['judul'] }}"
                                            data-pengarang="{{ $book['pengarang'] }}"
                                            data-genre="{{ $book['genre'] }}"
                                            data-tahun="{{ $book['tahun'] }}"
                                            data-status="{{ $book['status'] }}">
                                        <i class="bi bi-pencil"></i> Edit
                                    </button>
                                    <button class="btn-delete-sm" 
                                            data-id="{{ $book['id'] }}"
                                            data-judul="{{ $book['judul'] }}">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- mobile cards -->
        <div class="d-flex d-md-none flex-column gap-3" id="mobile-books-container">
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
            <div class="book-list-card" id="mobile-card-{{ $book['id'] }}">
                <div class="blc-no">#{{ $index + 1 }}</div>
                <div class="blc-judul mobile-judul">{{ $book['judul'] }}</div>
                <div class="blc-author"><i class="bi bi-person me-1"></i><span class="mobile-pengarang">{{ $book['pengarang'] }}</span> &middot; <span class="mobile-tahun">{{ $book['tahun'] }}</span></div>
                <div class="blc-footer">
                    <span class="badge-genre {{ $genreClass }} mobile-genre">{{ $book['genre'] }}</span>
                    @if($book['status'] === 'Tersedia')
                        <span class="badge-tersedia mobile-status"><i class="bi bi-check-circle me-1"></i>Tersedia</span>
                    @else
                        <span class="badge-dipinjam mobile-status"><i class="bi bi-clock me-1"></i>Dipinjam</span>
                    @endif
                </div>
                <div class="mobile-action">
                    <div class="action-buttons">
                        <button class="btn-edit-sm" 
                                data-id="{{ $book['id'] }}"
                                data-judul="{{ $book['judul'] }}"
                                data-pengarang="{{ $book['pengarang'] }}"
                                data-genre="{{ $book['genre'] }}"
                                data-tahun="{{ $book['tahun'] }}"
                                data-status="{{ $book['status'] }}">
                            <i class="bi bi-pencil"></i> Edit
                        </button>
                        <button class="btn-delete-sm" 
                                data-id="{{ $book['id'] }}"
                                data-judul="{{ $book['judul'] }}">
                            <i class="bi bi-trash"></i> Hapus
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div style="font-size:0.85rem; color:#8b95bb; margin-top:1rem;">
            Menampilkan <strong style="color:#2d3047;" id="total-books-count">{{ count($books) }}</strong> data buku
        </div>

    </div>
</section>

<!-- Modal Edit Buku -->
<div class="modal fade modal-custom" id="editModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="bi bi-pencil-square me-2"></i>Edit Buku</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="editForm">
                    <input type="hidden" id="edit_id">
                    <div class="mb-3">
                        <label class="form-label-custom">Judul Buku</label>
                        <input type="text" id="edit_judul" class="form-control form-control-custom" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label-custom">Pengarang</label>
                        <input type="text" id="edit_pengarang" class="form-control form-control-custom" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label-custom">Genre</label>
                        <select id="edit_genre" class="form-control form-control-custom" required>
                            <option value="Novel">Novel</option>
                            <option value="Sejarah">Sejarah</option>
                            <option value="Non-fiksi">Non-fiksi</option>
                            <option value="Self-help">Self-help</option>
                            <option value="Fiksi Ilmiah">Fiksi Ilmiah</option>
                            <option value="Teknologi">Teknologi</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label-custom">Tahun Terbit</label>
                        <input type="number" id="edit_tahun" class="form-control form-control-custom" required min="1800" max="{{ date('Y') }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label-custom">Status</label>
                        <select id="edit_status" class="form-control form-control-custom" required>
                            <option value="Tersedia">Tersedia</option>
                            <option value="Dipinjam">Dipinjam</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="saveEdit" style="background:#3d5af1; border:none;">Simpan Perubahan</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Buku -->
<div class="modal fade modal-custom" id="tambahModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="bi bi-plus-circle me-2"></i>Tambah Buku Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="tambahForm">
                    <div class="mb-3">
                        <label class="form-label-custom">Judul Buku</label>
                        <input type="text" id="tambah_judul" class="form-control form-control-custom" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label-custom">Pengarang</label>
                        <input type="text" id="tambah_pengarang" class="form-control form-control-custom" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label-custom">Genre</label>
                        <select id="tambah_genre" class="form-control form-control-custom" required>
                            <option value="Novel">Novel</option>
                            <option value="Sejarah">Sejarah</option>
                            <option value="Non-fiksi">Non-fiksi</option>
                            <option value="Self-help">Self-help</option>
                            <option value="Fiksi Ilmiah">Fiksi Ilmiah</option>
                            <option value="Teknologi">Teknologi</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label-custom">Tahun Terbit</label>
                        <input type="number" id="tambah_tahun" class="form-control form-control-custom" required min="1800" max="{{ date('Y') }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label-custom">Status</label>
                        <select id="tambah_status" class="form-control form-control-custom" required>
                            <option value="Tersedia">Tersedia</option>
                            <option value="Dipinjam">Dipinjam</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-success" id="saveTambah">Tambah Buku</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // ========== EDIT BUKU ==========
    $(document).on('click', '.btn-edit-sm', function() {
        $('#edit_id').val($(this).data('id'));
        $('#edit_judul').val($(this).data('judul'));
        $('#edit_pengarang').val($(this).data('pengarang'));
        $('#edit_genre').val($(this).data('genre'));
        $('#edit_tahun').val($(this).data('tahun'));
        $('#edit_status').val($(this).data('status'));
        $('#editModal').modal('show');
    });

    $('#saveEdit').click(function() {
        var formData = {
            id: $('#edit_id').val(),
            judul: $('#edit_judul').val(),
            pengarang: $('#edit_pengarang').val(),
            genre: $('#edit_genre').val(),
            tahun: $('#edit_tahun').val(),
            status: $('#edit_status').val(),
            _method: 'PUT'
        };

        $.ajax({
            url: '/books/update',
            type: 'POST',
            data: formData,
            success: function(response) {
                if (response.success) {
                    // Update desktop table
                    var row = $('#book-row-' + response.data.id);
                    row.find('.book-judul').text(response.data.judul);
                    row.find('.book-pengarang').text(response.data.pengarang);
                    row.find('.book-genre').text(response.data.genre);
                    row.find('.book-tahun').text(response.data.tahun);
                    
                    // Update genre 
                    var genreClass = getGenreClass(response.data.genre);
                    row.find('.book-genre').attr('class', 'badge-genre ' + genreClass + ' book-genre');
                    row.find('.book-genre').text(response.data.genre);
                    
                    // Update status
                    if (response.data.status === 'Tersedia') {
                        row.find('.book-status').html('<i class="bi bi-check-circle me-1"></i>Tersedia').attr('class', 'badge-tersedia book-status');
                    } else {
                        row.find('.book-status').html('<i class="bi bi-clock me-1"></i>Dipinjam').attr('class', 'badge-dipinjam book-status');
                    }
                    
                    // Update mobile card
                    var mobileCard = $('#mobile-card-' + response.data.id);
                    mobileCard.find('.mobile-judul').text(response.data.judul);
                    mobileCard.find('.mobile-pengarang').text(response.data.pengarang);
                    mobileCard.find('.mobile-tahun').text(response.data.tahun);
                    mobileCard.find('.mobile-genre').attr('class', 'badge-genre ' + genreClass + ' mobile-genre').text(response.data.genre);
                    
                    if (response.data.status === 'Tersedia') {
                        mobileCard.find('.mobile-status').html('<i class="bi bi-check-circle me-1"></i>Tersedia').attr('class', 'badge-tersedia mobile-status');
                    } else {
                        mobileCard.find('.mobile-status').html('<i class="bi bi-clock me-1"></i>Dipinjam').attr('class', 'badge-dipinjam mobile-status');
                    }
                    
                    // Update button data attributes
                    $('.btn-edit-sm[data-id="' + response.data.id + '"]').data(response.data);
                    
                    $('#editModal').modal('hide');
                    alert(response.message);
                }
            },
            error: function(xhr) {
                alert('Terjadi kesalahan: ' + (xhr.responseJSON?.message || 'Gagal update buku'));
            }
        });
    });

    // ========== DELETE BUKU ==========
    $(document).on('click', '.btn-delete-sm', function() {
        var id = $(this).data('id');
        var judul = $(this).data('judul');
        
        if (confirm('Apakah Anda yakin ingin menghapus buku "' + judul + '"?')) {
            $.ajax({
                url: '/books/delete',
                type: 'POST',
                data: {
                    id: id,
                    _method: 'DELETE'
                },
                success: function(response) {
                    if (response.success) {
                        $('#book-row-' + id).fadeOut(function() { $(this).remove(); });
                        $('#mobile-card-' + id).fadeOut(function() { $(this).remove(); });
                        updateRowNumbers();
                        var newCount = $('#books-table-body tr').length;
                        $('#total-books-count').text(newCount);
                        $('.total-badge').text(newCount + ' Judul Buku');
                        alert(response.message);
                    }
                },
                error: function(xhr) {
                    alert('Terjadi kesalahan: ' + (xhr.responseJSON?.message || 'Gagal hapus buku'));
                }
            });
        }
    });

    // ========== TAMBAH BUKU ==========
    $('#saveTambah').click(function() {
        var formData = {
            judul: $('#tambah_judul').val(),
            pengarang: $('#tambah_pengarang').val(),
            genre: $('#tambah_genre').val(),
            tahun: $('#tambah_tahun').val(),
            status: $('#tambah_status').val()
        };

        $.ajax({
            url: '/books/add',
            type: 'POST',
            data: formData,
            success: function(response) {
                if (response.success) {
                    var newId = response.data.id;
                    var newIndex = $('#books-table-body tr').length + 1;
                    var genreClass = getGenreClass(response.data.genre);
                    
                    // Desktop row
                    var newRow = `
                        <tr id="book-row-${newId}">
                            <td class="no-col">${newIndex}</td>
                            <td class="judul-col book-judul">${response.data.judul}</td>
                            <td class="author-col book-pengarang">${response.data.pengarang}</td>
                            <td><span class="badge-genre ${genreClass} book-genre">${response.data.genre}</span></td>
                            <td class="book-tahun">${response.data.tahun}</td>
                            <td>${response.data.status === 'Tersedia' ? '<span class="badge-tersedia book-status"><i class="bi bi-check-circle me-1"></i>Tersedia</span>' : '<span class="badge-dipinjam book-status"><i class="bi bi-clock me-1"></i>Dipinjam</span>'}</td>
                            <td style="text-align: center;">
                                <div class="action-buttons">
                                    <button class="btn-edit-sm" data-id="${newId}" data-judul="${response.data.judul}" data-pengarang="${response.data.pengarang}" data-genre="${response.data.genre}" data-tahun="${response.data.tahun}" data-status="${response.data.status}">
                                        <i class="bi bi-pencil"></i> Edit
                                    </button>
                                    <button class="btn-delete-sm" data-id="${newId}" data-judul="${response.data.judul}">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </div>
                            </td>
                        </tr>
                    `;
                    $('#books-table-body').append(newRow);
                    
                    // Mobile card
                    var newMobileCard = `
                        <div class="book-list-card" id="mobile-card-${newId}">
                            <div class="blc-no">#${newIndex}</div>
                            <div class="blc-judul mobile-judul">${response.data.judul}</div>
                            <div class="blc-author"><i class="bi bi-person me-1"></i><span class="mobile-pengarang">${response.data.pengarang}</span> &middot; <span class="mobile-tahun">${response.data.tahun}</span></div>
                            <div class="blc-footer">
                                <span class="badge-genre ${genreClass} mobile-genre">${response.data.genre}</span>
                                ${response.data.status === 'Tersedia' ? '<span class="badge-tersedia mobile-status"><i class="bi bi-check-circle me-1"></i>Tersedia</span>' : '<span class="badge-dipinjam mobile-status"><i class="bi bi-clock me-1"></i>Dipinjam</span>'}
                            </div>
                            <div class="mobile-action">
                                <div class="action-buttons">
                                    <button class="btn-edit-sm" data-id="${newId}" data-judul="${response.data.judul}" data-pengarang="${response.data.pengarang}" data-genre="${response.data.genre}" data-tahun="${response.data.tahun}" data-status="${response.data.status}">
                                        <i class="bi bi-pencil"></i> Edit
                                    </button>
                                    <button class="btn-delete-sm" data-id="${newId}" data-judul="${response.data.judul}">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </div>
                            </div>
                        </div>
                    `;
                    $('#mobile-books-container').append(newMobileCard);
                    
                    // Update total count
                    var newCount = $('#books-table-body tr').length;
                    $('#total-books-count').text(newCount);
                    $('.total-badge').text(newCount + ' Judul Buku');
                    
                    $('#tambahForm')[0].reset();
                    $('#tambahModal').modal('hide');
                    alert(response.message);
                }
            },
            error: function(xhr) {
                alert('Terjadi kesalahan: ' + (xhr.responseJSON?.message || 'Gagal menambah buku'));
            }
        });
    });
    
    function getGenreClass(genre) {
        const classes = {
            'Novel': 'badge-novel',
            'Sejarah': 'badge-sejarah',
            'Non-fiksi': 'badge-nonfiksi',
            'Self-help': 'badge-selfhelp',
            'Fiksi Ilmiah': 'badge-fiksiilmiah',
            'Teknologi': 'badge-teknologi'
        };
        return classes[genre] || 'badge-default';
    }
    
    function updateRowNumbers() {
        $('#books-table-body tr').each(function(index, row) {
            $(row).find('.no-col').text(index + 1);
        });
        $('#mobile-books-container .book-list-card').each(function(index, card) {
            $(card).find('.blc-no').text('#' + (index + 1));
        });
    }
});
</script>
@endsection