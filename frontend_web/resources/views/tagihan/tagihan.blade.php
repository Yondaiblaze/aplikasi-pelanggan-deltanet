@extends('layouts.app')

@section('title', 'Tagihan Saya')

@push('styles')
<style>
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
