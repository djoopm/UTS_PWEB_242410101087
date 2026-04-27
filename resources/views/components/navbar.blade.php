<nav class="navbar navbar-expand-lg" style="background: #fff; border-bottom: 1px solid #eaecf5; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
    <div class="container">

        {{-- Logo --}}
        <a class="navbar-brand d-flex align-items-center gap-2" href="/dashboard?username={{ request()->query('username') }}" style="text-decoration:none;">
            <div style="width:36px; height:36px; background:#3d5af1; border-radius:8px; display:flex; align-items:center; justify-content:center;">
                <i class="bi bi-book-half" style="color:#fff; font-size:1.1rem;"></i>
            </div>
            <span style="font-family:'DM Sans',sans-serif; font-weight:700; font-size:1rem; color:#2d3047;">
                Pustaka <span style="color:#3d5af1;">Nusantara</span>
            </span>
        </a>

        <!-- mobile -->
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- navlink -->
        <div class="collapse navbar-collapse" id="navbarMain">
            <ul class="navbar-nav ms-auto gap-1">
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2 px-3 py-2"
                        href="/dashboard?username={{ request()->query('username') }}"
                        style="color:#2d3047; font-family:'DM Sans',sans-serif; font-size:0.93rem; font-weight:500; border-radius:8px; transition:background 0.2s;"
                        onmouseover="this.style.background='#f0f4ff'; this.style.color='#3d5af1'"
                        onmouseout="this.style.background='transparent'; this.style.color='#2d3047'">
                        <i class="bi bi-house-door"></i> Beranda
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2 px-3 py-2"
                        href="/pengelolaan?username={{ request()->query('username') }}"
                        style="color:#2d3047; font-family:'DM Sans',sans-serif; font-size:0.93rem; font-weight:500; border-radius:8px; transition:background 0.2s;"
                        onmouseover="this.style.background='#f0f4ff'; this.style.color='#3d5af1'"
                        onmouseout="this.style.background='transparent'; this.style.color='#2d3047'">
                        <i class="bi bi-journal-bookmark"></i> Pengelolaan Buku
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2 px-3 py-2"
                        href="/profile?username={{ request()->query('username') }}"
                        style="color:#2d3047; font-family:'DM Sans',sans-serif; font-size:0.93rem; font-weight:500; border-radius:8px; transition:background 0.2s;"
                        onmouseover="this.style.background='#f0f4ff'; this.style.color='#3d5af1'"
                        onmouseout="this.style.background='transparent'; this.style.color='#2d3047'">
                        <i class="bi bi-person-circle"></i> Profil
                    </a>
                </li>
            </ul>
        </div>

    </div>
</nav>