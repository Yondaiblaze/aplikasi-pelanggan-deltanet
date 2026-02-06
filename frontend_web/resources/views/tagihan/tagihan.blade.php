@extends('layouts.app')

@section('title', 'Tagihan Saya - DeltaNet')

@push('styles')
<style>
    /* =====================
       LAYOUT & TEXT
    ===================== */
    .page-header {
        margin-bottom: 25px;
    }

    .page-title {
        font-size: 24px;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 5px;
    }

    .breadcrumb {
        color: #64748b;
        font-size: 14px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .breadcrumb a {
        color: #2563eb;
        text-decoration: none;
        font-weight: 500;
    }

    /* =====================
       CARD BOX
    ===================== */
    .card-box {
        background: #ffffff;
        border-radius: 16px;
        padding: 25px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.04);
        border: 1px solid #f1f5f9;
    }

    /* =====================
       TABLE CONTROLS
    ===================== */
    .table-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        flex-wrap: wrap;
        gap: 15px;
    }

    .entries-control {
        font-size: 14px;
        color: #64748b;
    }

    .table-top select,
    .table-top input {
        padding: 10px 14px;
        border-radius: 10px;
        border: 1px solid #e2e8f0;
        outline: none;
        font-size: 14px;
        transition: all 0.2s;
    }

    .table-top input:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }

    .filter-group {
        display: flex;
        gap: 10px;
    }

    /* =====================
       MODERN TABLE
    ===================== */
    .table-responsive {
        overflow-x: auto;
    }

    .table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }

    .table thead {
        background: #f8fafc;
    }

    .table th {
        text-align: left;
        padding: 16px;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: #64748b;
        border-bottom: 2px solid #f1f5f9;
    }

    .table td {
        padding: 16px;
        border-bottom: 1px solid #f1f5f9;
        font-size: 14px;
        color: #334155;
        vertical-align: middle;
    }

    .table tbody tr:hover {
        background: #fdfdfd;
    }

    /* =====================
       STATUS & BUTTONS
    ===================== */
    .status {
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 700;
        display: inline-block;
    }

    .status.paid {
        background: #dcfce7;
        color: #166534;
    }

    .status.unpaid {
        background: #fee2e2;
        color: #b91c1c;
    }

    .btn-group {
        display: flex;
        gap: 8px;
    }

    .btn-action {
        border: none;
        padding: 8px 14px;
        border-radius: 8px;
        cursor: pointer;
        font-size: 12px;
        font-weight: 600;
        transition: all 0.2s;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .btn-detail {
        background: #f1f5f9;
        color: #475569;
    }

    .btn-detail:hover { background: #e2e8f0; }

    .btn-pay {
        background: #2563eb;
        color: white;
    }

    .btn-pay:hover { background: #1d4ed8; transform: translateY(-1px); }

    /* =====================
       FOOTER
    ===================== */
    .table-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 20px;
        color: #64748b;
        font-size: 13px;
    }

    .pagination {
        display: flex;
        gap: 5px;
    }

    .page-link {
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        background: #f1f5f9;
        cursor: pointer;
        color: #475569;
    }

    .page-link.active {
        background: #2563eb;
        color: white;
    }
</style>
@endpush

@section('content')

<div class="page-header">
    <div class="page-title">Riwayat Tagihan</div>
    <div class="breadcrumb">
        <a href="{{ route('dashboard') }}">Dashboard</a>
        <i class="fas fa-chevron-right" style="font-size: 10px;"></i>
        <span>Tagihan</span>
    </div>
</div>

<div class="card-box">

    <div class="table-top">
        <div class="entries-control">
            Tampilkan
            <select>
                <option>10</option>
                <option>25</option>
                <option>50</option>
            </select>
            Data
        </div>

        <div class="filter-group">
            <select onchange="filterStatus(this.value)">
                <option value="">Semua Status</option>
                <option value="paid">Lunas</option>
                <option value="unpaid">Belum Bayar</option>
            </select>

            <input type="text" placeholder="Cari nomor invoice..." onkeyup="searchTable(this.value)">
        </div>
    </div>

    <div class="table-responsive">
        <table class="table" id="billingTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Invoice</th>
                    <th>Layanan / Paket</th>
                    <th>Total Bayar</th>
                    <th>Periode</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td style="font-weight: 600;">INV-2024-001</td>
                    <td>Flash Pro 30 Mbps</td>
                    <td style="font-weight: 600;">Rp 350.000</td>
                    <td>Januari 2024</td>
                    <td><span class="status paid">Lunas</span></td>
                    <td>
                        <div class="btn-group">
                            <button class="btn-action btn-detail"><i class="fas fa-file-invoice"></i> Detail</button>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td>2</td>
                    <td style="font-weight: 600;">INV-2024-002</td>
                    <td>Flash Pro 30 Mbps</td>
                    <td style="font-weight: 600;">Rp 350.000</td>
                    <td>Februari 2024</td>
                    <td><span class="status unpaid">Belum Bayar</span></td>
                    <td>
                        <div class="btn-group">
                            <button class="btn-action btn-detail"><i class="fas fa-file-invoice"></i> Detail</button>
                            <button class="btn-action btn-pay"><i class="fas fa-credit-card"></i> Bayar</button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="table-footer">
        <div>Menampilkan 1 sampai 2 dari 2 data</div>
        <div class="pagination">
            <div class="page-link"><i class="fas fa-chevron-left"></i></div>
            <div class="page-link active">1</div>
            <div class="page-link"><i class="fas fa-chevron-right"></i></div>
        </div>
    </div>

</div>

@endsection

@push('scripts')
<script>
/**
 * Fungsi Pencarian Tabel
 */
function searchTable(value) {
    const rows = document.querySelectorAll('#billingTable tbody tr');
    const term = value.toLowerCase();

    rows.forEach(row => {
        const text = row.textContent.toLowerCase();
        row.style.display = text.includes(term) ? '' : 'none';
    });
}

/**
 * Fungsi Filter Status
 */
function filterStatus(status) {
    const rows = document.querySelectorAll('#billingTable tbody tr');

    rows.forEach(row => {
        const statusSpan = row.querySelector('.status');
        const isPaid = statusSpan.classList.contains('paid');
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
