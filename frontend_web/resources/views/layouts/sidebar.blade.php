<!-- SIDEBAR -->
<div class="sidebar">
    <div class="sidebar-header">
        <div class="logo">DeltaNet</div>
    </div>

    <nav class="sidebar-nav">
        <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <span class="nav-icon">📊</span>
            Dashboard
        </a>
        <a href="{{ route('profil') }}" class="{{ request()->routeIs('profil') ? 'active' : '' }}">
            <span class="nav-icon">👤</span>
            Profil Saya
        </a>
        <a href="{{ route('tagihan') }}" class="{{ request()->routeIs('tagihan') ? 'active' : '' }}">
            <span class="nav-icon">💳</span>
            Tagihan
        </a>
        <a href="{{ route('tiket') }}" class="{{ request()->routeIs('tiket') ? 'active' : '' }}">
            <span class="nav-icon">🎫</span>
            Tiket
        </a>
        <a href="{{ route('referral') }}" class="{{ request()->routeIs('referral') ? 'active' : '' }}">
            <span class="nav-icon">👥</span>
            Referral
        </a>
        <a href="{{ route('komisi') }}" class="{{ request()->routeIs('komisi') ? 'active' : '' }}">
            <span class="nav-icon">💰</span>
            Komisi
        </a>
        <a href="{{ route('pengaturan') }}" class="{{ request()->routeIs('pengaturan') ? 'active' : '' }}">
            <span class="nav-icon">⚙️</span>
            Pengaturan
        </a>
        <form action="{{ route('logout') }}" method="POST" style="margin-top: 20px;">
            @csrf
            <button type="submit" style="background:none;border:none;color:#374151;padding:12px 20px;width:100%;text-align:left;cursor:pointer;font-size:14px;display:flex;align-items:center;gap:12px;">
                <span class="nav-icon">🚪</span>
                Keluar
            </button>
        </form>
    </nav>
</div>

<style>
.sidebar {
    background: #fff;
    border-right: 1px solid #e5e7eb;
    height: 100vh;
    position: sticky;
    top: 0;
}

.sidebar-header {
    padding: 20px;
    border-bottom: 1px solid #e5e7eb;
}

.sidebar-header .logo {
    font-size: 20px;
    font-weight: bold;
    color: #2563eb;
}

.sidebar-nav {
    padding: 20px 0;
}

.sidebar-nav a {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 20px;
    text-decoration: none;
    color: #374151;
    font-size: 14px;
    transition: all 0.2s;
}

.sidebar-nav a:hover {
    background: #f3f4f6;
}

.sidebar-nav a.active {
    background: #3b82f6;
    color: white;
}

.nav-icon {
    font-size: 16px;
}
</style>
