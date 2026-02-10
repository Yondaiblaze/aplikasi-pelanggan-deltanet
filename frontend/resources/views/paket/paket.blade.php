@extends('layouts.app')

@section('title', 'Paket Internet')

@push('styles')
<style>
/* Sidebar Styles */
.page-container {
    display: flex;
    min-height: calc(100vh - 100px);
}

/* ================= PAGE ================= */
.page-container {
    display: flex;
    gap: 20px;
    min-height: 100vh;
    background: transparent;
}

/* ================= SIDEBAR ================= */
.sidebar {
    width: 260px;
    background: #ffffff;
    position: sticky;
    top: 20px;
    align-self: flex-start;
    border-radius: 4px;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
    z-index: 50;
    display: flex;
    flex-direction: column;
    max-height: calc(100vh - 40px);
}

/* ================= HEADER ================= */
.sidebar-header {
    padding: 18px 20px;
    border-bottom: 1px solid #e5e7eb;
}

/* LOGO */
.sidebar .logo {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 15px;
    font-weight: 700;
    color: #2563eb;
}

.sidebar .logo i {
    font-size: 22px;
}

/* ================= NAV ================= */
.sidebar-nav {
    padding: 16px;
    flex: 1;
    overflow-y: auto;
}

/* Contoh item nav (opsional kalau ada) */
.sidebar-nav a {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 14px;
    border-radius: 10px;
    color: #374151;
    font-size: 14px;
    text-decoration: none;
    transition: background 0.2s ease;
}

.sidebar-nav a:hover {
    background: #f1f5f9;
}

/* Aktif */
.sidebar-nav a.active {
    background: #e0ecff;
    color: #2563eb;
    font-weight: 600;
}

.nav-menu {
    list-style: none;
    padding: 0;
    margin: 0;
}

.nav-item {
    margin-bottom: 3px;
}

.nav-link {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 10px 20px;
    color: #6b7280;
    text-decoration: none;
    transition: all 0.2s;
    font-size: 14px;
}

.nav-link:hover {
    background: #f3f4f6;
    color: #2563eb;
}

.nav-item.active .nav-link {
    background: #eff6ff;
    color: #2563eb;
    border-right: 3px solid #2563eb;
}

.nav-link i {
    width: 18px;
    text-align: center;
    font-size: 14px;
}

.nav-section-title {
    padding: 18px 20px;
    font-size: 15px;
    font-weight: 700;
    color: #2563eb;
    border-top: 1px solid #e5e7eb;
    border-bottom: 1px solid #e5e7eb;
    margin: 10px -16px;
}

.nav-divider {
    height: 12px;
    background: #6b7280;
    margin: 15px 0 15px 5px;
    list-style: none;
    border-radius: 0;
    width: 40%;
}

.sidebar-footer {
    padding: 15px;
    border-top: 2px solid #e5e7eb;
    background: #f8fafc;
    border-radius: 0 0 4px 4px;
}

.user-info {
    display: flex;
    align-items: center;
    gap: 8px;
}

.user-avatar {
    width: 32px;
    height: 32px;
    background: #e5e7eb;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #6b7280;
    font-size: 14px;
}

.user-details {
    flex: 1;
}

.user-name {
    display: block;
    font-size: 12px;
    font-weight: 600;
    color: #374151;
}

.user-status {
    display: block;
    font-size: 10px;
    color: #6b7280;
}

/* Main Content */
.main-content {
    flex: 1;
    padding: 0;
}

@media (max-width: 768px) {
    .sidebar {
        display: none;
    }
    
    .main-content {
        margin-left: 0;
    }
}

.page-title {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
}

.page-title h1 {
    color: #1e3a8a;
    font-size: 28px;
}

.view-toggle {
    display: flex;
    gap: 8px;
}

.view-btn {
    padding: 8px 12px;
    border: 1px solid #d1d5db;
    background: white;
    border-radius: 6px;
    cursor: pointer;
    transition: all 0.2s;
}

.view-btn.active {
    background: #2563eb;
    color: white;
    border-color: #2563eb;
}

.packages-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
    gap: 20px;
}

.packages-list {
    display: none;
    flex-direction: column;
    gap: 15px;
}

.package-list-item {
    background: white;
    border-radius: 12px;
    padding: 20px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.package-list-info {
    display: flex;
    gap: 30px;
    align-items: center;
}

.package-list-speed {
    font-size: 24px;
    font-weight: bold;
    color: #2563eb;
}

.package-list-price {
    font-size: 18px;
    font-weight: 600;
    color: #374151;
}

.package-card {
    background: white;
    border-radius: 12px;
    padding: 25px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    text-align: center;
    transition: transform 0.2s ease;
}

.package-card:hover {
    transform: translateY(-2px);
}

.package-name {
    background: #2563eb;
    color: white;
    padding: 6px 12px;
    border-radius: 4px;
    font-size: 14px;
    font-weight: 600;
    display: inline-block;
    margin-bottom: 15px;
}

.package-speed {
    margin-bottom: 15px;
}

.speed-label {
    font-size: 14px;
    color: #374151;
}

.speed-number {
    font-size: 36px;
    font-weight: bold;
    color: #2563eb;
    margin: 0 5px;
}

.speed-unit {
    font-size: 20px;
    font-weight: bold;
    color: #2563eb;
}

.package-price {
    margin-bottom: 20px;
}

.package-price strong {
    font-size: 18px;
    color: #374151;
}

.package-price span {
    font-size: 14px;
    color: #6b7280;
}

.package-divider {
    border: none;
    border-top: 1px solid #e5e7eb;
    margin: 20px 0;
}

.package-features {
    margin-bottom: 25px;
    text-align: left;
}

.feature-item {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
    font-size: 14px;
    color: #374151;
}

.feature-icon {
    color: #2563eb;
    width: 18px;
    margin-right: 10px;
}

.subscribe-btn {
    width: 100%;
    background: #2563eb;
    color: white;
    border: none;
    padding: 12px 20px;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    transition: background 0.2s;
}

.subscribe-btn:hover {
    background: #1d4ed8;
}
</style>
@endpush

@section('content')
<div class="page-container">

    @include('layouts.sidebar')
    
    <!-- MAIN CONTENT -->
    <div class="main-content">
        <div class="page-title">
            <h1>Paket Internet DeltaNet</h1>
            <div class="view-toggle">
                <button class="view-btn active" onclick="toggleView('grid')"><i class="fas fa-th"></i></button>
                <button class="view-btn" onclick="toggleView('list')"><i class="fas fa-list"></i></button>
            </div>
        </div>
        
        <div class="packages-grid" id="gridView">
    <!-- Paket Flash 20 Mbps -->
    <div class="package-card">
        <div class="package-name">Flash</div>
        
        <div class="package-speed">
            <span class="speed-label">up to</span>
            <span class="speed-number">20</span>
            <span class="speed-unit">Mbps</span>
        </div>
        
        <div class="package-price">
            <strong>Rp250.000</strong>
            <span>/bulan</span>
        </div>
        
        <hr class="package-divider">
        
        <div class="package-features">
            <div class="feature-item">
                <i class="fas fa-infinity feature-icon"></i>
                <span>Unlimited Kuota Data</span>
            </div>
            <div class="feature-item">
                <i class="fas fa-wifi feature-icon"></i>
                <span>Include Modem Wifi</span>
            </div>
            <div class="feature-item">
                <i class="fas fa-mobile-alt feature-icon"></i>
                <span>Ideal Untuk 4-5 Gadget</span>
            </div>
            <div class="feature-item">
                <i class="fas fa-headset feature-icon"></i>
                <span>24/7 Customer Support</span>
            </div>
        </div>
        
        <button class="subscribe-btn">Langganan Sekarang</button>
    </div>
    
    <!-- Paket Flash 30 Mbps -->
    <div class="package-card">
        <div class="package-name">Flash</div>
        
        <div class="package-speed">
            <span class="speed-label">up to</span>
            <span class="speed-number">30</span>
            <span class="speed-unit">Mbps</span>
        </div>
        
        <div class="package-price">
            <strong>Rp350.000</strong>
            <span>/bulan</span>
        </div>
        
        <hr class="package-divider">
        
        <div class="package-features">
            <div class="feature-item">
                <i class="fas fa-infinity feature-icon"></i>
                <span>Unlimited Kuota Data</span>
            </div>
            <div class="feature-item">
                <i class="fas fa-wifi feature-icon"></i>
                <span>Include Modem Wifi</span>
            </div>
            <div class="feature-item">
                <i class="fas fa-mobile-alt feature-icon"></i>
                <span>Ideal Untuk 6-8 Gadget</span>
            </div>
            <div class="feature-item">
                <i class="fas fa-headset feature-icon"></i>
                <span>24/7 Customer Support</span>
            </div>
        </div>
        
        <button class="subscribe-btn">Langganan Sekarang</button>
    </div>
    
    <!-- Paket Flash 40 Mbps -->
    <div class="package-card">
        <div class="package-name">Flash</div>
        
        <div class="package-speed">
            <span class="speed-label">up to</span>
            <span class="speed-number">40</span>
            <span class="speed-unit">Mbps</span>
        </div>
        
        <div class="package-price">
            <strong>Rp450.000</strong>
            <span>/bulan</span>
        </div>
        
        <hr class="package-divider">
        
        <div class="package-features">
            <div class="feature-item">
                <i class="fas fa-infinity feature-icon"></i>
                <span>Unlimited Kuota Data</span>
            </div>
            <div class="feature-item">
                <i class="fas fa-wifi feature-icon"></i>
                <span>Include Modem Wifi</span>
            </div>
            <div class="feature-item">
                <i class="fas fa-mobile-alt feature-icon"></i>
                <span>Ideal Untuk 8-12 Gadget</span>
            </div>
            <div class="feature-item">
                <i class="fas fa-headset feature-icon"></i>
                <span>24/7 Customer Support</span>
            </div>
        </div>
        
        <button class="subscribe-btn">Langganan Sekarang</button>
    </div>
</div>

        <div class="packages-list" id="listView">
            <div class="package-list-item">
                <div class="package-list-info">
                    <div class="package-list-speed">20 Mbps</div>
                    <div class="package-list-price">Rp250.000/bulan</div>
                    <div>Unlimited • Wifi • 4-5 Gadget</div>
                </div>
                <button class="subscribe-btn" style="width:auto;padding:10px 20px;">Langganan</button>
            </div>
            <div class="package-list-item">
                <div class="package-list-info">
                    <div class="package-list-speed">30 Mbps</div>
                    <div class="package-list-price">Rp350.000/bulan</div>
                    <div>Unlimited • Wifi • 6-8 Gadget</div>
                </div>
                <button class="subscribe-btn" style="width:auto;padding:10px 20px;">Langganan</button>
            </div>
            <div class="package-list-item">
                <div class="package-list-info">
                    <div class="package-list-speed">40 Mbps</div>
                    <div class="package-list-price">Rp450.000/bulan</div>
                    <div>Unlimited • Wifi • 8-12 Gadget</div>
                </div>
                <button class="subscribe-btn" style="width:auto;padding:10px 20px;">Langganan</button>
            </div>
        </div>
    </div>
</div>

<script>
function toggleView(view) {
    const gridView = document.getElementById('gridView');
    const listView = document.getElementById('listView');
    const buttons = document.querySelectorAll('.view-btn');
    
    if (view === 'grid') {
        gridView.style.display = 'grid';
        listView.style.display = 'none';
        buttons[0].classList.add('active');
        buttons[1].classList.remove('active');
    } else {
        gridView.style.display = 'none';
        listView.style.display = 'flex';
        buttons[0].classList.remove('active');
        buttons[1].classList.add('active');
    }
}
</script>
@endsection