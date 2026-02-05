@extends('layouts.app')

@section('title', 'Komisi')

@push('styles')
<style>
/* =====================
   GLOBAL
===================== */
*{
    box-sizing:border-box;
}

/* =====================
   SUMMARY BAR
===================== */
.komisi-summary{
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:16px;
    margin-bottom:24px;
}
.summary-card{
    background:#3b82f6;
    color:white;
    padding:18px 20px;
    border-radius:10px;
}
.summary-amount{
    font-size:20px;
    font-weight:700;
}
.summary-label{
    font-size:13px;
    opacity:.9;
}

/* =====================
   CARD
===================== */
.card-box{
    background:#fff;
    padding:20px;
    border-radius:12px;
    box-shadow:0 4px 20px rgba(0,0,0,.05);
    margin-bottom:20px;
}

/* =====================
   TABLE TOP
===================== */
.table-top{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:15px;
}
.table-top select,
.table-top input{
    padding:8px 12px;
    border-radius:6px;
    border:1px solid #e5e7eb;
    font-size:14px;
}

/* =====================
   BUTTON
===================== */
.btn{
    border:none;
    padding:9px 14px;
    border-radius:6px;
    color:white;
    cursor:pointer;
}
.btn-blue{background:#2563eb;}
.btn-disabled{
    background:#9ca3af;
    cursor:not-allowed;
}

/* =====================
   TABLE
===================== */
.table{
    width:100%;
    border-collapse:collapse;
}
.table thead{
    background:#f1f5f9;
}
.table th{
    text-align:left;
    font-size:12px;
    color:#475569;
    padding:12px;
}
.table td{
    padding:12px;
    border-top:1px solid #e5e7eb;
    font-size:14px;
}
.table tbody tr:hover{
    background:#f9fafb;
}

/* =====================
   STATUS
===================== */
.status{
    padding:5px 12px;
    border-radius:999px;
    font-size:12px;
    font-weight:600;
}
.status.paid{
    background:#dbeafe;
    color:#1d4ed8;
}
.status.pending{
    background:#fef3c7;
    color:#92400e;
}

/* =====================
   FOOTER
===================== */
.table-footer{
    display:flex;
    justify-content:space-between;
    margin-top:15px;
    font-size:13px;
    color:#6b7280;
}

/* =====================
   INFO
===================== */
.info-box{
    background:#f0f9ff;
    border-left:4px solid #2563eb;
    padding:14px;
    border-radius:8px;
    color:#1e40af;
}
</style>
@endpush

@section('content')
<div class="komisi-summary">
    <div class="summary-card">
        <div class="summary-amount">Rp {{ number_format($commissions['total_earned'] ?? 0, 0, ',', '.') }}</div>
        <div class="summary-label">Total Komisi</div>
    </div>
    <div class="summary-card">
        <div class="summary-amount">Rp {{ number_format(($commissions['total_earned'] ?? 0) - ($commissions['total_pending'] ?? 0), 0, ',', '.') }}</div>
        <div class="summary-label">Sudah Dibayar</div>
    </div>
    <div class="summary-card">
        <div class="summary-amount">Rp {{ number_format($commissions['total_pending'] ?? 0, 0, ',', '.') }}</div>
        <div class="summary-label">Menunggu Pembayaran</div>
    </div>
</div>

<div class="card-box">
    <div class="table-top">
        <div>
            <select>
                <option>10</option>
                <option>25</option>
                <option>50</option>
            </select>
            entri
        </div>

        <div>
            <button class="btn {{ ($commissions['total_earned'] ?? 0) >= ($commissions['minimum_withdraw'] ?? 100000) ? 'btn-blue' : 'btn-disabled' }}">
                Tarik Komisi (Min. Rp {{ number_format($commissions['minimum_withdraw'] ?? 100000, 0, ',', '.') }})
            </button>
            <input type="text" placeholder="Cari...">
        </div>
    </div>

    <table class="table">
        <thead>
        <tr>
            <th>TANGGAL</th>
            <th>REFERRAL</th>
            <th>KODE REFERRAL</th>
            <th>JUMLAH</th>
            <th>STATUS</th>
        </tr>
        </thead>
        <tbody>
        @if(isset($commissions['commissions']) && count($commissions['commissions']) > 0)
            @foreach($commissions['commissions'] as $commission)
            <tr>
                <td>{{ date('d M Y', strtotime($commission['earned_date'])) }}</td>
                <td>{{ $commission['referred_user']['name'] }}</td>
                <td>{{ $commission['referral_code'] }}</td>
                <td>Rp {{ number_format($commission['amount'], 0, ',', '.') }}</td>
                <td><span class="status {{ $commission['status'] }}">{{ ucfirst($commission['status']) }}</span></td>
            </tr>
            @endforeach
        @else
            <tr>
                <td colspan="5" style="text-align: center; color: #6b7280;">Belum ada data komisi</td>
            </tr>
        @endif
        </tbody>
    </table>

    <div class="table-footer">
        <div>Showing {{ count($commissions['commissions'] ?? []) }} entries</div>
        <div>◀ ▶</div>
    </div>
</div>

<div class="card-box">
    <h4 style="margin-bottom:10px;">Informasi Program Referral</h4>
    <div class="info-box">
        @if(isset($benefits['description']))
            <p>{{ $benefits['description'] }}</p>
        @endif
        
        @if(isset($benefits['how_it_works']))
            <h5>Cara Kerja:</h5>
            <ul>
                @foreach($benefits['how_it_works'] as $step)
                    <li>{{ $step }}</li>
                @endforeach
            </ul>
        @endif
        
        @if(isset($benefits['tips']))
            <h5>Tips:</h5>
            <ul>
                @foreach($benefits['tips'] as $tip)
                    <li>{{ $tip }}</li>
                @endforeach
            </ul>
        @endif
    </div>
</div>
@endsection