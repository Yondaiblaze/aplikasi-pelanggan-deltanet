@extends('layouts.app')

@section('title', 'Detail Status Instalasi')

@push('styles')
<style>
.page-title {
    font-size: 28px;
    font-weight: 700;
    color: #1f2937;
    margin-bottom: 8px;
}

.breadcrumb {
    font-size: 14px;
    color: #6b7280;
    margin-bottom: 32px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.breadcrumb span {
    color: #3b82f6;
    font-weight: 500;
}

.breadcrumb-separator {
    color: #d1d5db;
}

.tracking-card {
    background: #ffffff;
    padding: 32px;
    border-radius: 16px;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    border: 1px solid #f3f4f6;
    margin-bottom: 24px;
}

.order-info {
    background: #f8fafc;
    padding: 20px;
    border-radius: 12px;
    margin-bottom: 30px;
    border-left: 4px solid #3b82f6;
}

.order-info h3 {
    color: #1f2937;
    font-size: 18px;
    margin-bottom: 12px;
}

.order-details {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 16px;
}

.detail-item {
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.detail-label {
    font-size: 12px;
    color: #6b7280;
    font-weight: 600;
    text-transform: uppercase;
}

.detail-value {
    font-size: 14px;
    color: #374151;
    font-weight: 500;
}

.timeline {
    position: relative;
    padding-left: 30px;
}

.timeline::before {
    content: '';
    position: absolute;
    left: 15px;
    top: 0;
    bottom: 0;
    width: 2px;
    background: #e5e7eb;
}

.timeline-item {
    position: relative;
    margin-bottom: 24px;
    padding-bottom: 16px;
}

.timeline-item::before {
    content: '';
    position: absolute;
    left: -23px;
    top: 4px;
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background: #10b981;
    border: 3px solid white;
    box-shadow: 0 0 0 2px #10b981;
}

.timeline-item.current::before {
    background: #3b82f6;
    box-shadow: 0 0 0 2px #3b82f6;
}

.timeline-item.pending::before {
    background: #e5e7eb;
    box-shadow: 0 0 0 2px #e5e7eb;
}

.timeline-content {
    background: white;
    padding: 16px;
    border-radius: 8px;
    border: 1px solid #e5e7eb;
}

.timeline-date {
    font-size: 12px;
    color: #6b7280;
    margin-bottom: 8px;
}

.timeline-title {
    font-size: 14px;
    font-weight: 600;
    color: #374151;
    margin-bottom: 4px;
}

.timeline-desc {
    font-size: 14px;
    color: #6b7280;
    line-height: 1.5;
}

.current-status {
    background: #dbeafe;
    color: #1e40af;
    padding: 12px 16px;
    border-radius: 8px;
    margin-bottom: 24px;
    font-weight: 500;
    text-align: center;
}

@media (max-width: 768px) {
    .tracking-card {
        padding: 20px;
    }
    
    .order-details {
        grid-template-columns: 1fr;
    }
}
</style>
@endpush

@section('content')

<div class="page-title"><i class="fas fa-tools"></i> Detail Status Instalasi</div>
<div class="breadcrumb">
    <a href="{{ route('dashboard') }}" style="color: #3b82f6;">Dashboard</a>
    <span class="breadcrumb-separator">›</span> 
    <span>Status Instalasi</span>
</div>

<div class="tracking-card">
    <div class="order-info">
        <h3>Informasi Instalasi</h3>
        <div class="order-details">
            <div class="detail-item">
                <div class="detail-label">ID Instalasi</div>
                <div class="detail-value">INS2024013001</div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Tanggal Pesanan</div>
                <div class="detail-value">30 Jan 2024</div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Paket Internet</div>
                <div class="detail-value">Flash 30 Mbps</div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Status</div>
                <div class="detail-value">Instalasi Selesai</div>
            </div>
        </div>
    </div>

    <div class="current-status">
        <i class="fas fa-check-circle"></i> Instalasi internet telah selesai dan siap digunakan!
    </div>

    <div class="timeline">
        <div class="timeline-item">
            <div class="timeline-content">
                <div class="timeline-date">30 Jan 16:30</div>
                <div class="timeline-title">Instalasi Selesai</div>
                <div class="timeline-desc">Internet telah aktif dan siap digunakan. Selamat menikmati layanan DeltaNet!</div>
            </div>
        </div>

        <div class="timeline-item">
            <div class="timeline-content">
                <div class="timeline-date">30 Jan 15:45</div>
                <div class="timeline-title">Konfigurasi Jaringan</div>
                <div class="timeline-desc">Pengaturan modem dan pengecekan koneksi sedang dilakukan.</div>
            </div>
        </div>

        <div class="timeline-item">
            <div class="timeline-content">
                <div class="timeline-date">30 Jan 14:20</div>
                <div class="timeline-title">Proses Instalasi</div>
                <div class="timeline-desc">Penarikan kabel dan instalasi perangkat sedang dikerjakan.</div>
            </div>
        </div>

        <div class="timeline-item">
            <div class="timeline-content">
                <div class="timeline-date">30 Jan 13:00</div>
                <div class="timeline-title">Teknisi Tiba di Lokasi</div>
                <div class="timeline-desc">Teknisi telah tiba di lokasi. Proses persiapan pemasangan sedang dilakukan.</div>
            </div>
        </div>

        <div class="timeline-item">
            <div class="timeline-content">
                <div class="timeline-date">30 Jan 12:30</div>
                <div class="timeline-title">Teknisi Menuju Lokasi</div>
                <div class="timeline-desc">Teknisi kami sedang dalam perjalanan ke lokasi Anda. Mohon pastikan lokasi mudah diakses dan ada orang di tempat.</div>
            </div>
        </div>

        <div class="timeline-item">
            <div class="timeline-content">
                <div class="timeline-date">29 Jan 10:00</div>
                <div class="timeline-title">Jadwal Dikonfirmasi</div>
                <div class="timeline-desc">Jadwal pemasangan dikonfirmasi. Teknisi akan datang sesuai jadwal yang telah ditentukan.</div>
            </div>
        </div>

        <div class="timeline-item">
            <div class="timeline-content">
                <div class="timeline-date">28 Jan 14:15</div>
                <div class="timeline-title">Pesanan Diterima</div>
                <div class="timeline-desc">Pesanan diterima. Admin sedang memverifikasi data dan alamat pemasangan Anda.</div>
            </div>
        </div>
    </div>
</div>

@endsection