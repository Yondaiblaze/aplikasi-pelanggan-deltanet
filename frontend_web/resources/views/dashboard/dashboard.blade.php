@extends('layouts.app')

@section('title', 'Dashboard - DeltaNet')

@push('styles')
<style>
    /* =====================
       GLOBAL & LAYOUT
    ===================== */
    * { box-sizing: border-box; }
    body { margin: 0; background: #f0f0f0; font-family: 'Inter', Arial, sans-serif; }

    .dashboard-container { min-height: 100vh; padding-bottom: 40px; }
    .dashboard-wrapper { max-width: 1200px; margin: 0 auto; padding: 20px; }

    .main-content { display: flex; flex-direction: column; gap: 25px; }

    /* =====================
       SEARCH BAR
    ===================== */
    .search-section { display: flex; justify-content: center; margin-bottom: 10px; }
    .search-container {
        position: relative;
        width: 100%;
        max-width: 600px;
        display: flex;
        align-items: center;
    }
    .search-icon { position: absolute; left: 18px; color: #9ca3af; z-index: 2; }
    .search-input {
        width: 100%;
        height: 50px;
        padding: 0 60px 0 50px;
        border: none;
        border-radius: 30px;
        font-size: 15px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        outline: none;
        transition: all 0.3s;
    }
    .search-input:focus { box-shadow: 0 4px 20px rgba(37, 99, 235, 0.15); }
    .search-button {
        position: absolute;
        right: 6px;
        width: 38px;
        height: 38px;
        background: #2563eb;
        border: none;
        border-radius: 50%;
        color: white;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* =====================
       BANNER
    ===================== */
    .banner-area {
        width: 100%;
        height: 180px;
        background: linear-gradient(135deg, #1e293b, #334155);
        border-radius: 15px;
        overflow: hidden;
        position: relative;
        /* Tambahkan background image di sini jika ada asset */
        background-image: url('{{ asset("images/banner-promo.jpg") }}');
        background-size: cover;
        background-position: center;
    }

    /* =====================
       ICON GRID (Navigasi Cepat)
    ===================== */
    .icon-grid {
        display: grid;
        grid-template-columns: repeat(6, 1fr);
        gap: 15px;
    }
    .icon-item {
        background: white;
        padding: 15px 10px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        transition: all 0.2s;
        box-shadow: 0 2px 6px rgba(0,0,0,0.05);
    }
    .icon-item:hover { transform: translateY(-3px); box-shadow: 0 6px 15px rgba(0,0,0,0.1); }
    .icon-content { text-align: center; }
    .icon-fa { font-size: 22px; color: #2563eb; margin-bottom: 8px; display: block; }
    .icon-label { font-size: 12px; color: #4b5563; font-weight: 600; }

    /* =====================
       PACKAGE SECTION (Unified Card)
    ===================== */
    .package-unified-card {
        background: #fff;
        border-radius: 15px;
        padding: 20px;
        box-shadow: 0 4px 15px rgba(0,0,0,.05);
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 25px;
    }
    .active-package-content {
        border: 2px solid #10b981;
        border-radius: 12px;
        padding: 20px;
        background: linear-gradient(135deg, #f0fdf4, #ffffff);
    }
    .package-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px; }
    .package-header h3 { font-size: 16px; color: #1f2937; margin: 0; display: flex; align-items: center; gap: 8px; }
    .status-badge.active { background: #dcfce7; color: #166534; padding: 4px 10px; border-radius: 20px; font-size: 11px; font-weight: 700; }

    .package-badge { background: #2563eb; color: white; padding: 5px 12px; border-radius: 6px; font-size: 12px; font-weight: 600; display: inline-block; margin-bottom: 10px; }
    .speed-number { font-size: 36px; font-weight: 800; color: #1e293b; }
    .speed-unit { font-size: 18px; color: #64748b; }

    .feature-item { display: flex; align-items: center; gap: 10px; margin-bottom: 8px; font-size: 13px; color: #4b5563; }
    .feature-icon { color: #10b981; font-size: 14px; }

    .duration-content { display: flex; flex-direction: column; justify-content: center; }
    .progress-bar { width: 100%; height: 8px; background: #e5e7eb; border-radius: 4px; overflow: hidden; margin: 10px 0; }
    .progress-fill { height: 100%; background: #10b981; transition: width 0.5s; }
    .extend-btn { background: #10b981; color: white; border: none; padding: 12px; border-radius: 8px; font-weight: 600; cursor: pointer; margin-top: 15px; }

    /* =====================
       REFERRAL SECTION
    ===================== */
    .referral-section { background: white; border-radius: 15px; padding: 25px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
    .referral-header { display: flex; justify-content: space-between; margin-bottom: 20px; }
    .commission-card {
        background: linear-gradient(135deg, #0ea5e9, #10b981);
        color: white;
        padding: 25px;
        border-radius: 16px;
        position: relative;
        overflow: hidden;
    }
    .commission-amount { font-size: 32px; font-weight: 800; margin: 5px 0; }
    .action-btn { background: rgba(255,255,255,0.2); border: none; color: white; padding: 8px 16px; border-radius: 20px; cursor: pointer; font-size: 12px; }

    .friend-item { display: flex; align-items: center; gap: 12px; padding: 12px 0; border-bottom: 1px solid #f3f4f6; }
    .friend-avatar { width: 35px; height: 35px; background: #e5e7eb; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #6b7280; }

    /* =====================
       TRACKING & STATS
    ===================== */
    .bottom-section { display: grid; grid-template-columns: 2fr 1fr; gap: 20px; }
    .tracking-card, .stats-card { background: white; border-radius: 15px; padding: 25px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }

    .progress-container { display: flex; align-items: center; justify-content: space-between; margin: 30px 0; }
    .step-circle { width: 35px; height: 35px; border-radius: 50%; background: #e5e7eb; display: flex; align-items: center; justify-content: center; font-size: 12px; z-index: 2; }
    .progress-step.completed .step-circle { background: #10b981; color: white; }
    .progress-step.active .step-circle { background: #2563eb; color: white; }
    .progress-line { flex: 1; height: 3px; background: #e5e7eb; margin: 0 -5px 15px -5px; }
    .progress-line.completed { background: #10b981; }

    /* =====================
       RESPONSIVE
    ===================== */
    @media (max-width: 992px) {
        .icon-grid { grid-template-columns: repeat(3, 1fr); }
        .package-unified-card, .bottom-section, .referral-content { grid-template-columns: 1fr; }
    }
</style>
@endpush

@section('content')
<div class="dashboard-container">
    <div class="dashboard-wrapper">
        <div class="main-content">

            <div class="search-section">
                <div class="search-container">
                    <i class="fas fa-search search-icon"></i>
                    <input type="text" class="search-input" placeholder="Cari paket internet, tagihan, atau bantuan...">
                    <button class="search-button"><i class="fas fa-search"></i></button>
                </div>
            </div>

            <div class="banner-area"></div>

            <div class="icon-grid">
                <a href="{{ route('profil') }}" class="icon-item">
                    <div class="icon-content">
                        <i class="fas fa-user-circle icon-fa"></i>
                        <span class="icon-label">Profil</span>
                    </div>
                </a>
                <a href="{{ route('tagihan') }}" class="icon-item">
                    <div class="icon-content">
                        <i class="fas fa-receipt icon-fa"></i>
                        <span class="icon-label">Tagihan</span>
                    </div>
                </a>
                <a href="{{ route('tiket.index') }}" class="icon-item">
                    <div class="icon-content">
                        <i class="fas fa-headset icon-fa"></i>
                        <span class="icon-label">Bantuan</span>
                    </div>
                </a>
                <a href="{{ route('referral') }}" class="icon-item">
                    <div class="icon-content">
                        <i class="fas fa-gift icon-fa"></i>
                        <span class="icon-label">Referral</span>
                    </div>
                </a>
                <a href="{{ route('komisi') }}" class="icon-item">
                    <div class="icon-content">
                        <i class="fas fa-wallet icon-fa"></i>
                        <span class="icon-label">Komisi</span>
                    </div>
                </a>
                <a href="{{ route('pengaturan') }}" class="icon-item">
                    <div class="icon-content">
                        <i class="fas fa-user-cog icon-fa"></i>
                        <span class="icon-label">Setting</span>
                    </div>
                </a>
            </div>

            <div class="package-section">
                <div class="package-unified-card">
                    <div class="active-package-content">
                        <div class="package-header">
                            <h3><i class="fas fa-wifi"></i> Paket Internet Saya</h3>
                            <span class="status-badge active">Aktif</span>
                        </div>
                        <div class="package-badge">Flash Pro</div>
                        <div class="package-speed">
                            <span class="speed-number">30</span><span class="speed-unit"> Mbps</span>
                        </div>
                        <div style="margin: 15px 0;">
                            <div class="feature-item"><i class="fas fa-check-circle feature-icon"></i> Unlimited Kuota</div>
                            <div class="feature-item"><i class="fas fa-check-circle feature-icon"></i> Prioritas Jaringan</div>
                        </div>
                        <button class="extend-btn" style="width: 100%;" onclick="window.location.href='{{ route('tagihan') }}'">Kelola Layanan</button>
                    </div>

                    <div class="duration-content">
                        <h4 style="font-size: 14px; color: #64748b; margin-bottom: 5px;">Masa Aktif Paket</h4>
                        <p style="font-weight: 700; color: #1e293b; margin-bottom: 15px;">15 Jan 2024 - 15 Feb 2024</p>

                        <div class="progress-section">
                            <div style="display: flex; justify-content: space-between; font-size: 12px; color: #64748b;">
                                <span>Sisa Waktu</span>
                                <span style="color: #2563eb; font-weight: bold;">18 Hari Lagi</span>
                            </div>
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: 60%"></div>
                            </div>
                        </div>

                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-top: 15px;">
                            <div style="background: #f8fafc; padding: 10px; border-radius: 8px; text-align: center;">
                                <small style="color: #64748b; font-size: 10px;">Ping</small>
                                <div style="font-weight: bold; font-size: 13px;">15 ms</div>
                            </div>
                            <div style="background: #f8fafc; padding: 10px; border-radius: 8px; text-align: center;">
                                <small style="color: #64748b; font-size: 10px;">Uptime</small>
                                <div style="font-weight: bold; font-size: 13px;">99.9%</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="referral-section">
                <div class="referral-header">
                    <h3 style="font-size: 18px;"><i class="fas fa-users" style="color: #2563eb;"></i> Program Referral</h3>
                    <span style="font-size: 12px; color: #64748b;">3 Teman Bergabung</span>
                </div>

                <div class="referral-content" style="display: grid; grid-template-columns: 1.5fr 1fr; gap: 25px;">
                    <div class="commission-card">
                        <small>Total Komisi Anda</small>
                        <div class="commission-amount">Rp 450.000</div>
                        <p style="font-size: 11px; margin-bottom: 15px; opacity: 0.9;">Dapatkan Rp 50.000 setiap teman yang aktif!</p>
                        <div style="display: flex; gap: 10px;">
                            <button class="action-btn" style="background: white; color: #0ea5e9; font-weight: bold;">Tarik Saldo</button>
                            <button class="action-btn">Riwayat</button>
                        </div>
                    </div>

                    <div class="friends-list">
                        <h4 style="font-size: 13px; margin-bottom: 10px;">Teman Terbaru</h4>
                        <div class="friend-item">
                            <div class="friend-avatar"><i class="fas fa-user"></i></div>
                            <div style="flex: 1;"><div style="font-size: 13px; font-weight: 600;">Ahmad Rizki</div><small style="color: #94a3b8;">Aktif</small></div>
                        </div>
                        <div class="friend-item">
                            <div class="friend-avatar"><i class="fas fa-user"></i></div>
                            <div style="flex: 1;"><div style="font-size: 13px; font-weight: 600;">Siti Nurhaliza</div><small style="color: #94a3b8;">Aktif</small></div>
                        </div>
                        <button onclick="window.location.href='{{ route('referral') }}'" style="width: 100%; border: none; background: none; color: #2563eb; font-size: 12px; font-weight: bold; padding-top: 10px; cursor: pointer;">Lihat Semua</button>
                    </div>
                </div>
            </div>

            <div class="bottom-section">
                <div class="tracking-card">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                        <h3 style="font-size: 16px;"><i class="fas fa-tools"></i> Tracking Instalasi</h3>
                        <span style="font-size: 12px; color: #64748b;">ID: #DLT9921</span>
                    </div>

                    <div class="progress-container">
                        <div class="progress-step completed">
                            <div class="step-circle"><i class="fas fa-check"></i></div>
                            <div style="font-size: 10px; margin-top: 5px; text-align: center;">Diterima</div>
                        </div>
                        <div class="progress-line completed"></div>
                        <div class="progress-step completed">
                            <div class="step-circle"><i class="fas fa-check"></i></div>
                            <div style="font-size: 10px; margin-top: 5px; text-align: center;">Jadwal</div>
                        </div>
                        <div class="progress-line" style="background: linear-gradient(to right, #10b981 50%, #e5e7eb 50%);"></div>
                        <div class="progress-step active">
                            <div class="step-circle"><i class="fas fa-wrench"></i></div>
                            <div style="font-size: 10px; margin-top: 5px; text-align: center;">Proses</div>
                        </div>
                    </div>

                    <div style="background: #f0fdf4; padding: 15px; border-radius: 10px; border-left: 4px solid #10b981;">
                        <p style="font-size: 13px; color: #166534; margin: 0;">Teknisi dalam perjalanan ke lokasi Anda.</p>
                    </div>
                </div>

                <div class="stats-card">
                    <h3 style="font-size: 16px; margin-bottom: 20px;">Statistik Layanan</h3>
                    <div style="position: relative; display: flex; justify-content: center;">
                        <svg width="100" height="100">
                            <circle cx="50" cy="50" r="40" stroke="#f1f5f9" stroke-width="8" fill="none"></circle>
                            <circle cx="50" cy="50" r="40" stroke="#10b981" stroke-width="8" fill="none" stroke-dasharray="251" stroke-dashoffset="50" stroke-linecap="round"></circle>
                        </svg>
                        <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); text-align: center;">
                            <div style="font-size: 18px; font-weight: 800; color: #1e293b;">75%</div>
                            <small style="font-size: 9px; color: #64748b;">Uptime</small>
                        </div>
                    </div>
                    <div style="margin-top: 15px; font-size: 12px; color: #4b5563;">
                        <div style="display: flex; justify-content: space-between; padding: 5px 0;">
                            <span>Kualitas Sinyal</span>
                            <span style="color: #10b981; font-weight: bold;">Sangat Baik</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
