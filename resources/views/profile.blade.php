@extends('layouts.app')

@section('title', 'Profile — UPA')

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

    .profile-card {
        background: #fff;
        border-radius: 14px;
        border: 1px solid #eaecf5;
        box-shadow: 0 4px 16px rgba(61,90,241,0.06);
        overflow: hidden;
    }

    .profile-cover {
        height: 90px;
        background: linear-gradient(135deg, #3d5af1 0%, #6b7aff 100%);
    }

    .avatar-wrap {
        padding: 0 1.5rem;
        margin-top: -40px;
        margin-bottom: 1rem;
    }

    .avatar-circle {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: #fff;
        border: 3px solid #fff;
        box-shadow: 0 4px 14px rgba(61,90,241,0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        font-weight: 700;
        color: #3d5af1;
        font-family: 'DM Sans', sans-serif;
    }

    .profile-name {
        font-size: 1.3rem;
        font-weight: 700;
        color: #2d3047;
        padding: 0 1.5rem;
        margin-bottom: 0.2rem;
    }

    .profile-role {
        display: inline-block;
        background: #e8f0fe;
        color: #3d5af1;
        font-size: 0.78rem;
        padding: 0.2em 0.85em;
        border-radius: 20px;
        font-weight: 600;
        margin: 0 1.5rem 1.2rem;
    }

    .stat-row {
        display: flex;
        border-top: 1px solid #eaecf5;
    }

    .stat-item {
        flex: 1;
        text-align: center;
        padding: 1rem 0.5rem;
        border-right: 1px solid #eaecf5;
    }

    .stat-item:last-child { border-right: none; }

    .stat-val {
        font-size: 1.6rem;
        font-weight: 700;
        color: #3d5af1;
        line-height: 1;
    }

    .stat-lbl {
        font-size: 0.75rem;
        color: #8b95bb;
        margin-top: 0.2rem;
    }

    .info-card {
        background: #fff;
        border-radius: 14px;
        border: 1px solid #eaecf5;
        box-shadow: 0 4px 16px rgba(61,90,241,0.06);
        padding: 1.5rem;
    }

    .info-card-title {
        font-size: 0.95rem;
        font-weight: 700;
        color: #2d3047;
        margin-bottom: 1.2rem;
        padding-bottom: 0.75rem;
        border-bottom: 1px solid #eaecf5;
    }

    .info-row {
        display: flex;
        align-items: center;
        padding: 0.75rem 0;
        border-bottom: 1px solid #f0f2fa;
        gap: 0.9rem;
    }

    .info-row:last-of-type { border-bottom: none; }

    .info-icon {
        width: 36px;
        height: 36px;
        border-radius: 8px;
        background: #f0f4ff;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #3d5af1;
        font-size: 0.95rem;
        flex-shrink: 0;
    }

    .info-label {
        font-size: 0.75rem;
        color: #8b95bb;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        font-weight: 500;
    }

    .info-value {
        font-size: 0.92rem;
        color: #2d3047;
        font-weight: 500;
    }

    .btn-primary-full {
        background: #3d5af1;
        color: #fff;
        border: none;
        border-radius: 8px;
        padding: 0.65rem 1rem;
        font-family: 'DM Sans', sans-serif;
        font-weight: 600;
        font-size: 0.9rem;
        width: 100%;
        cursor: pointer;
        margin-top: 1.2rem;
        transition: background 0.2s;
        text-decoration: none;
        display: block;
        text-align: center;
    }

    .btn-primary-full:hover {
        background: #2a44d4;
        color: #fff;
    }

    .btn-logout {
        background: #fff;
        color: #e53e3e;
        border: 1.5px solid #e53e3e;
        border-radius: 8px;
        padding: 0.65rem 1rem;
        font-family: 'DM Sans', sans-serif;
        font-weight: 600;
        font-size: 0.9rem;
        width: 100%;
        cursor: pointer;
        margin-top: 0.6rem;
        transition: all 0.2s;
        text-align: center;
    }

    .btn-logout:hover {
        background: #e53e3e;
        color: #fff;
    }
</style>
@endsection

@section('content')

<!-- header -->
<div class="page-header">
    <div class="container">
        <h1><i class="bi bi-person-circle me-2" style="color:#3d5af1;"></i>Profil Anggota</h1>
        <p>Informasi akun dan aktivitas membaca kamu</p>
    </div>
</div>
<!-- content -->
<section style="padding: 2rem 0 3rem; background: #f8f9fc;">
    <div class="container">
        <div class="row g-4 justify-content-center">

            <!-- profil -->
            <div class="col-md-4">
                <div class="profile-card">
                    <div class="profile-cover"></div>
                    <div class="avatar-wrap">
                        <div class="avatar-circle">
                            {{ strtoupper(substr($profile['username'], 0, 1)) }}
                        </div>
                    </div>
                    <div class="profile-name">{{ $profile['username'] }}</div>
                    <div><span class="profile-role"><i class="bi bi-shield-check me-1"></i>{{ $profile['role'] }}</span></div>

                    <div class="stat-row">
                        <div class="stat-item">
                            <div class="stat-val">{{ $profile['buku_dipinjam'] }}</div>
                            <div class="stat-lbl">Dipinjam</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-val">{{ $profile['buku_selesai'] }}</div>
                            <div class="stat-lbl">Selesai Dibaca</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- detail -->
            <div class="col-md-6">
                <div class="info-card">
                    <div class="info-card-title">
                        <i class="bi bi-info-circle me-2" style="color:#3d5af1;"></i>Informasi Akun
                    </div>

                    <div class="info-row">
                        <div class="info-icon"><i class="bi bi-person"></i></div>
                        <div>
                            <div class="info-label">Username</div>
                            <div class="info-value">{{ $profile['username'] }}</div>
                        </div>
                    </div>

                    <div class="info-row">
                        <div class="info-icon"><i class="bi bi-envelope"></i></div>
                        <div>
                            <div class="info-label">Email</div>
                            <div class="info-value">{{ $profile['email'] }}</div>
                        </div>
                    </div>

                    <div class="info-row">
                        <div class="info-icon"><i class="bi bi-shield"></i></div>
                        <div>
                            <div class="info-label">Role / Status</div>
                            <div class="info-value">{{ $profile['role'] }}</div>
                        </div>
                    </div>

                    <div class="info-row">
                        <div class="info-icon"><i class="bi bi-calendar3"></i></div>
                        <div>
                            <div class="info-label">Bergabung Sejak</div>
                            <div class="info-value">Tahun {{ $profile['bergabung'] }}</div>
                        </div>
                    </div>

                    <!-- pengelolaan -->
                    <a href="{{ route('pengelolaan') }}" class="btn-primary-full">
                        <i class="bi bi-journal-bookmark me-2"></i> Lihat Koleksi Buku
                    </a>

                    <!-- Logout -->
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn-logout">
                            <i class="bi bi-box-arrow-right me-2"></i> Logout
                        </button>
                    </form>

                </div>
            </div>

        </div>
    </div>
</section>

@endsection