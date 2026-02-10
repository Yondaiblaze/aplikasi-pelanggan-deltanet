@extends('layouts.app')

@section('title', 'Tagihan Saya')

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

.page-title {
    font-size: 22px;
    font-weight: 600;
    margin-bottom: 6px;
}

.breadcrumb {
    color: #6b7280;
    font-size: 14px;
    margin-bottom: 20px;
}

.breadcrumb span {
    color: #2563eb;
}

.card-box {
    background: #ffffff;
    border-radius: 14px;
    padding: 20px;
    box-shadow: 0 10px 30px rgba(0,0,0,.06);
}

.table-top {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 15px;
    flex-wrap: wrap;
    gap: 10px;
}

.table-top select,
.table-top input {
    padding: 8px 12px;
    border-radius: 8px;
    border: 1px solid #e5e7eb;
    outline: none;
}

.table {
    width: 100%;
    border-collapse: collapse;
}

.table thead {
    background: #f0f7ff;
}

.table th {
    text-align: left;
    padding: 14px;
    font-size: 13px;
    color: #1e3a8a;
}

.table td {
    padding: 14px;
    border-top: 1px solid #e5e7eb;
    font-size: 14px;
    color: #374151;
}

.table tbody tr:hover {
    background: #f9fafb;
}

.status {
    padding: 6px 12px;
    border-radius: 999px;
    font-size: 12px;
    font-weight: 600;
}

.status.paid {
    background: #dbeafe;
    color: #1d4ed8;
}

.status.unpaid {
    background: #fee2e2;
    color: #b91c1c;
}

.btn-action {
    border: none;
    padding: 6px 10px;
    border-radius: 6px;
    cursor: pointer;
    color: white;
    font-size: 12px;
}

.btn-detail {
    background:#2563eb;
}

.btn-pay {
    background:#22c55e;
}

.table-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 15px;
    color: #6b7280;
    font-size: 14px;
}
</style>
@endpush

@section('content')
<div class="page-container">
    
    @include('layouts.sidebar')
    
    <!-- MAIN CONTENT -->
    <div class="main-content">

<div class="page-title">Tagihan Saya</div>
<div class="breadcrumb">
    <span>Dashboard</span> &nbsp;›&nbsp; Tagihan
</div>

<div class="card-box">

    <!-- TOP BAR -->
    <div class="table-top">
        <div>
            <select>
                <option>10</option>
                <option>25</option>
                <option>50</option>
            </select>
            Entri Per Halaman
        </div>

        <div class="actions">
            <select onchange="filterStatus(this.value)">
                <option value="">Semua Status</option>
                <option value="paid">Lunas</option>
                <option value="unpaid">Belum Bayar</option>
            </select>

            <input type="text" placeholder="Cari tagihan..." onkeyup="searchTable(this.value)">
        </div>
    </div>

    <!-- TABLE -->
    <table class="table">
        <thead>
            <tr>
                <th>NO</th>
                <th>KODE TAGIHAN</th>
                <th>PAKET</th>
                <th>JUMLAH</th>
                <th>PERIODE</th>
                <th>STATUS</th>
                <th>AKSI</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>INV-001</td>
                <td>Premium 50 Mbps</td>
                <td>Rp 400.000</td>
                <td>April 2024</td>
                <td><span class="status paid">Lunas</span></td>
                <td>
                    <button class="btn-action btn-detail">Detail</button>
                </td>
            </tr>

            <tr>
                <td>2</td>
                <td>INV-002</td>
                <td>Premium 50 Mbps</td>
                <td>Rp 400.000</td>
                <td>Mei 2024</td>
                <td><span class="status unpaid">Belum Bayar</span></td>
                <td>
                    <button class="btn-action btn-detail">Detail</button>
                    <button class="btn-action btn-pay">Bayar</button>
                </td>
            </tr>
        </tbody>
    </table>

    <div class="table-footer">
        <div>Showing 1 to 2 of 2 entries</div>
        <div>◀ ▶</div>
    </div>

</div>
    </div>
</div>

@endsection

@push('scripts')
<script>
function searchTable(value) {
    const rows = document.querySelectorAll('.table tbody tr');
    value = value.toLowerCase();

    rows.forEach(row => {
        row.style.display = row.textContent.toLowerCase().includes(value)
            ? ''
            : 'none';
    });
}

function filterStatus(status) {
    const rows = document.querySelectorAll('.table tbody tr');

    rows.forEach(row => {
        const isPaid = row.querySelector('.status').classList.contains('paid');
        const rowStatus = isPaid ? 'paid' : 'unpaid';

        if (status === '' || status === rowStatus) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
}
</script>
@endpush
