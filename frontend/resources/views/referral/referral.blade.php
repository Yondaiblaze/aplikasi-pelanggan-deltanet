@extends('layouts.app')

@section('title', 'Referral')

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

.sidebar-header {
    padding: 18px 20px;
    border-bottom: 1px solid #e5e7eb;
}

.sidebar .logo {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 15px;
    font-weight: 700;
    color: #2563eb;
}

.sidebar-nav {
    padding: 16px;
    flex: 1;
    overflow-y: auto;
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

.nav-divider {
    height: 1px;
    background: #e5e7eb;
    margin: 15px 0;
    list-style: none;
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
}

/* HEADER */
.page-title{
    font-size:22px;
    font-weight:600;
    margin-bottom:6px;
}
.breadcrumb{
    font-size:14px;
    color:#6b7280;
    margin-bottom:20px;
}
.breadcrumb span{
    color:#2563eb;
}

/* STATS */
.referral-stats{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(200px,1fr));
    gap:15px;
    margin-bottom:20px;
}
.stat-card{
    background:linear-gradient(135deg,#3b82f6,#1d4ed8);
    color:white;
    padding:20px;
    border-radius:14px;
}
.stat-number{
    font-size:22px;
    font-weight:700;
}
.stat-label{
    font-size:14px;
    opacity:.9;
}

/* CARD */
.card-box{
    background:#fff;
    padding:20px;
    border-radius:14px;
    box-shadow:0 10px 30px rgba(0,0,0,.06);
    margin-bottom:20px;
}

/* REFERRAL CODE */
.referral-code{
    border:2px dashed #bfdbfe;
    border-radius:12px;
    padding:20px;
    text-align:center;
    background:#f8fbff;
}
.referral-code .code{
    font-size:24px;
    font-weight:700;
    color:#2563eb;
    margin-bottom:10px;
}
.copy-btn{
    background:#2563eb;
    color:white;
    border:none;
    padding:10px 18px;
    border-radius:8px;
    cursor:pointer;
}

/* TABLE TOP */
.table-top{
    display:flex;
    justify-content:space-between;
    align-items:center;
    flex-wrap:wrap;
    gap:10px;
    margin-bottom:15px;
}
.table-top select,
.table-top input{
    padding:8px 12px;
    border-radius:8px;
    border:1px solid #e5e7eb;
}

/* BUTTON */
.btn{
    border:none;
    padding:10px 12px;
    border-radius:8px;
    color:white;
    cursor:pointer;
}
.btn-blue{ background:#2563eb; }
.btn-sky{ background:#0ea5e9; }

/* TABLE */
.table{
    width:100%;
    border-collapse:collapse;
}
.table thead{
    background:#eff6ff;
}
.table th{
    padding:14px;
    font-size:13px;
    text-align:left;
    color:#1e3a8a;
}
.table td{
    padding:14px;
    border-top:1px solid #e5e7eb;
    font-size:14px;
    color:#374151;
}
.table tbody tr:hover{
    background:#f9fafb;
}

/* STATUS */
.status{
    padding:6px 12px;
    border-radius:999px;
    font-size:12px;
    font-weight:600;
}
.status.active{
    background:#dbeafe;
    color:#1d4ed8;
}
.status.pending{
    background:#fef3c7;
    color:#92400e;
}

/* FOOTER */
.table-footer{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-top:15px;
    font-size:14px;
    color:#6b7280;
}
</style>
@endpush

@section('content')
<div class="page-container">

    @include('layouts.sidebar')
    
    <!-- MAIN CONTENT -->
    <div class="main-content">

<div class="page-title">Referral</div>
<div class="breadcrumb">
    <span>Dashboard</span> &nbsp;›&nbsp; Referral
</div>

<!-- STATS -->
<div class="referral-stats">
    <div class="stat-card">
        <div class="stat-number">5</div>
        <div class="stat-label">Total Referral</div>
    </div>
    <div class="stat-card">
        <div class="stat-number">3</div>
        <div class="stat-label">Referral Aktif</div>
    </div>
    <div class="stat-card">
        <div class="stat-number">Rp 150.000</div>
        <div class="stat-label">Total Komisi</div>
    </div>
</div>

<!-- REFERRAL CODE -->
<div class="card-box">
    <h3 style="margin-bottom:12px;color:#374151">Kode Referral Anda</h3>
    <div class="referral-code">
        <div class="code" id="refCode">DELTA-JD2024</div>
        <p style="color:#6b7280;margin-bottom:12px">
            Bagikan kode ini untuk mendapatkan komisi
        </p>
        <button class="copy-btn" onclick="copyCode()">Salin Kode</button>
    </div>
</div>

<!-- TABLE -->
<div class="card-box">

    <div class="table-top">
        <div>
            <select>
                <option>10</option>
                <option>25</option>
                <option>50</option>
            </select>
            Entri Per Halaman
        </div>

        <div>
            <button class="btn btn-sky">⟳</button>
            <input type="text" placeholder="Mencari...">
        </div>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>NO</th>
                <th>NAMA</th>
                <th>TANGGAL GABUNG</th>
                <th>STATUS</th>
                <th>KOMISI</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>Ahmad Wijaya</td>
                <td>15 April 2024</td>
                <td><span class="status active">Aktif</span></td>
                <td>Rp 50.000</td>
            </tr>
            <tr>
                <td>2</td>
                <td>Siti Nurhaliza</td>
                <td>10 April 2024</td>
                <td><span class="status active">Aktif</span></td>
                <td>Rp 50.000</td>
            </tr>
            <tr>
                <td>3</td>
                <td>Budi Santoso</td>
                <td>5 April 2024</td>
                <td><span class="status pending">Pending</span></td>
                <td>Rp 0</td>
            </tr>
        </tbody>
    </table>

    <div class="table-footer">
        <div>Showing 1 to 3 of 3 entries</div>
        <div>◀ ▶</div>
    </div>

</div>
</div>
</div>
@endsection

@push('scripts')
<script>
function copyCode(){
    const code = document.getElementById('refCode').innerText;
    navigator.clipboard.writeText(code);
    alert('Kode referral berhasil disalin');
}
</script>
@endpush