@extends('layouts.app')

@section('title', 'Dashboard')

@push('styles')
<style>
/* =====================
   GLOBAL
===================== */
* {
  box-sizing: border-box;
}

body {
  margin: 0;
  background: #f0f0f0;
  font-family: Arial, sans-serif;
}

/* =====================
   CONTAINER
===================== */
.dashboard-container {
  min-height: 100vh;
}

.dashboard-wrapper {
  max-width: 1440px;
  margin: 0 auto;
  padding: 20px;
}

/* =====================
   MAIN CONTENT
===================== */
.main-content {
  display: flex;
  flex-direction: column;
  gap: 20px;
}

/* =====================
   SEARCH BAR
===================== */
.top-bar {
  background: #fff;
  height: 79px;
  border-radius: 12px;
  display: flex;
  align-items: center;
  justify-content: center;
  box-shadow: 0 2px 8px rgba(0,0,0,.1);
  padding: 0 20px;
}

.search-container {
  position: relative;
  width: 100%;
  max-width: 600px;
  display: flex;
  align-items: center;
  margin: 0 auto;
}

.search-icon {
  position: absolute;
  left: 15px;
  color: #6b7280;
  z-index: 2;
}

.search-input {
  width: 100%;
  height: 45px;
  padding: 0 50px 0 45px;
  border: 2px solid #e5e7eb;
  border-radius: 25px;
  font-size: 16px;
  outline: none;
  transition: all 0.3s;
}

.search-input:focus {
  border-color: #2563eb;
  box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
}

.search-button {
  position: absolute;
  right: 5px;
  width: 35px;
  height: 35px;
  background: #2563eb;
  border: none;
  border-radius: 50%;
  color: white;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: background 0.2s;
}

.search-button:hover {
  background: #1d4ed8;
}

/* =====================
   BANNER
===================== */
.banner-area {
  width: 100%;
  height: 200px;
  background-color: #f8fafc;
  border-radius: 12px;
  position: relative;
  overflow: hidden;
}


/* =====================
   ICON GRID
===================== */
.icon-grid {
  display: grid;
  grid-template-columns: repeat(6, 1fr);
  gap: 12px;
}

.icon-item {
  background: transparent;
  height: 80px;
  border-radius: 10px;
  display: flex;
  align-items: center;
  justify-content: center;
  text-decoration: none;
  color: inherit;
  transition: transform 0.2s;
}

.icon-item:hover {
  transform: translateY(-2px);
}

.icon-content {
  text-align: center;
}

.icon-fa {
  font-size: 24px;
  color: #4a90e2;
  margin-bottom: 8px;
}

.icon-label {
  font-size: 12px;
  color: #374151;
  font-weight: 500;
}

/* =====================
   PACKAGE SECTION
===================== */
.package-section {
  display: block;
}

.package-unified-card {
  background: #fff;
  border-radius: 8px;
  padding: 15px;
  box-shadow: 0 2px 8px rgba(0,0,0,.1);
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 20px;
}

.active-package-content {
  border: 2px solid #10b981;
  border-radius: 6px;
  padding: 12px;
  background: linear-gradient(135deg, #f0fdf4, #dcfce7);
}

.duration-content {
  padding: 12px;
}

.package-header, .duration-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 12px;
  padding-bottom: 8px;
  border-bottom: 1px solid #e5e7eb;
}

.package-header h3, .duration-header h3 {
  color: #374151;
  font-size: 14px;
  margin: 0;
  display: flex;
  align-items: center;
  gap: 6px;
}

.status-badge {
  padding: 3px 6px;
  border-radius: 8px;
  font-size: 10px;
  font-weight: 600;
}

.status-badge.active {
  background: #dcfce7;
  color: #166534;
}

.duration-info {
  text-align: center;
  padding: 10px;
  background: #f8fafc;
  border-radius: 6px;
  margin-bottom: 12px;
}

.duration-label {
  font-size: 10px;
  color: #6b7280;
  margin-bottom: 3px;
}

.duration-date {
  font-size: 11px;
  font-weight: 600;
  color: #374151;
}

.progress-section {
  padding: 12px;
  background: #f8fafc;
  border-radius: 6px;
  margin-bottom: 12px;
}

.progress-header {
  display: flex;
  justify-content: space-between;
  margin-bottom: 6px;
}

.progress-label {
  font-size: 11px;
  color: #6b7280;
}

.progress-value {
  font-size: 11px;
  font-weight: 600;
  color: #2563eb;
}

.progress-bar {
  width: 100%;
  height: 4px;
  background: #e5e7eb;
  border-radius: 2px;
  overflow: hidden;
  margin-bottom: 5px;
}

.progress-fill {
  height: 100%;
  background: linear-gradient(90deg, #10b981, #34d399);
  border-radius: 2px;
  transition: width 0.3s ease;
}

.progress-footer {
  display: flex;
  justify-content: space-between;
  font-size: 9px;
  color: #6b7280;
}

.usage-stats {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 8px;
  margin-bottom: 12px;
}

.stat-item {
  text-align: center;
  padding: 8px;
  background: #f8fafc;
  border-radius: 4px;
}

.stat-label {
  font-size: 9px;
  color: #6b7280;
  margin-bottom: 2px;
}

.stat-value {
  font-size: 11px;
  font-weight: 600;
  color: #374151;
}

.extend-btn {
  width: 100%;
  background: #10b981;
  color: white;
  border: none;
  padding: 8px 12px;
  border-radius: 4px;
  font-size: 11px;
  font-weight: 600;
  cursor: pointer;
  transition: background 0.2s;
}

.extend-btn:hover {
  background: #059669;
}

/* =====================
   CONTENT SECTION
===================== */
.content-section {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 20px;
}

.content-card {
  background: #fff;
  border-radius: 12px;
  padding: 20px;
  box-shadow: 0 2px 8px rgba(0,0,0,.1);
}

/* PACKAGE STYLING */
.package-badge {
    background: #2563eb;
    color: white;
    padding: 8px 16px;
    border-radius: 4px;
    font-size: 14px;
    font-weight: 600;
    display: inline-block;
    margin-bottom: 20px;
}

.package-speed {
    margin-bottom: 20px;
}

.speed-label {
    font-size: 14px;
    color: #374151;
}

.speed-number {
    font-size: 32px;
    font-weight: bold;
    color: #2563eb;
    margin: 0 5px;
}

.speed-unit {
    font-size: 18px;
    font-weight: bold;
    color: #2563eb;
}

.package-price {
    margin-bottom: 15px;
}

.package-price strong {
    font-size: 16px;
    color: #374151;
}

.package-price span {
    font-size: 12px;
    color: #6b7280;
}

.package-divider {
    border: none;
    border-top: 1px solid #e5e7eb;
    margin: 15px 0;
}

.package-features {
    margin-bottom: 15px;
}

.feature-item {
    display: flex;
    align-items: center;
    margin-bottom: 8px;
    font-size: 12px;
    color: #374151;
}

.feature-icon {
    color: #2563eb;
    width: 16px;
    margin-right: 8px;
}

.package-button {
    width: 100%;
    background: #2563eb;
    color: white;
    border: none;
    padding: 8px 12px;
    border-radius: 4px;
    font-size: 11px;
    font-weight: 600;
    cursor: pointer;
    transition: background 0.2s;
}

.package-button:hover {
    background: #1d4ed8;
}

/* =====================
   REFERRAL SECTION
===================== */
.referral-section {
  background: #fff;
  border-radius: 12px;
  box-shadow: 0 2px 8px rgba(0,0,0,.1);
}

.referral-card {
  padding: 25px;
}

.referral-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 25px;
  padding-bottom: 15px;
  border-bottom: 1px solid #e5e7eb;
}

.referral-header h3 {
  color: #374151;
  font-size: 18px;
  margin: 0;
  display: flex;
  align-items: center;
  gap: 8px;
}

.friends-count {
  font-size: 12px;
  color: #6b7280;
  background: #f3f4f6;
  padding: 4px 8px;
  border-radius: 12px;
}

.referral-content {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 25px;
}

.referral-stats {
  display: flex;
  flex-direction: column;
  gap: 15px;
}

.commission-card {
  background: linear-gradient(135deg, #10b3b9, #34d399);
  color: white;
  padding: 25px;
  border-radius: 16px;
  margin-bottom: 15px;
  position: relative;
  overflow: hidden;
}

.commission-content {
  position: relative;
  z-index: 2;
}

.commission-label {
  font-size: 14px;
  opacity: 0.9;
  margin-bottom: 8px;
  font-weight: 400;
}

.commission-amount {
  font-size: 32px;
  font-weight: bold;
  margin-bottom: 8px;
  line-height: 1;
}

.commission-amount sup {
  font-size: 18px;
  vertical-align: top;
}

.commission-change {
  font-size: 12px;
  opacity: 0.8;
  margin-bottom: 20px;
}

.commission-actions {
  display: flex;
  align-items: center;
  gap: 12px;
}

.action-btn {
  padding: 8px 16px;
  border: none;
  border-radius: 20px;
  font-size: 12px;
  font-weight: 500;
  cursor: pointer;
  transition: all 0.2s;
}

.action-btn.primary {
  background: rgba(0,0,0,0.2);
  color: white;
}

.action-btn.secondary {
  background: rgba(255,255,255,0.2);
  color: white;
}

.action-btn:hover {
  transform: translateY(-1px);
}

.settings-btn {
  width: 32px;
  height: 32px;
  border: none;
  border-radius: 50%;
  background: rgba(255,255,255,0.2);
  color: white;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-left: auto;
}

.card-decoration {
  position: absolute;
  top: -50px;
  right: -50px;
  width: 150px;
  height: 150px;
  background: rgba(255,255,255,0.1);
  border-radius: 50%;
  z-index: 1;
}

.card-decoration::before {
  content: '';
  position: absolute;
  top: 30px;
  left: 30px;
  width: 80px;
  height: 80px;
  background: rgba(255,255,255,0.05);
  border-radius: 50%;
}

.commission-icon {
  width: 50px;
  height: 50px;
  background: rgba(255,255,255,0.2);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 20px;
}

.invite-card {
  background: #f8fafc;
  border: 2px dashed #3b82f6;
  padding: 15px;
  border-radius: 12px;
  display: flex;
  align-items: center;
  gap: 12px;
}

.invite-icon {
  width: 40px;
  height: 40px;
  background: #3b82f6;
  color: white;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 16px;
}

.invite-info {
  flex: 1;
}

.invite-label {
  font-size: 14px;
  font-weight: 600;
  color: #374151;
  margin-bottom: 2px;
}

.invite-desc {
  font-size: 12px;
  color: #6b7280;
}

.invite-btn {
  background: #3b82f6;
  color: white;
  border: none;
  padding: 8px 16px;
  border-radius: 6px;
  font-size: 12px;
  cursor: pointer;
  transition: background 0.2s;
}

.invite-btn:hover {
  background: #2563eb;
}

.friends-list {
  display: flex;
  flex-direction: column;
  gap: 12px;
}

.friends-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 20px;
  padding-bottom: 10px;
  border-bottom: 1px solid #e5e7eb;
}

.friends-header h4 {
  color: #374151;
  font-size: 16px;
  margin: 0;
}

.friend-item {
  display: flex;
  align-items: center;
  gap: 12px;
  padding: 12px 0;
  border-bottom: 1px solid #f3f4f6;
}

.friend-item:last-child {
  border-bottom: none;
}

.friend-avatar {
  width: 40px;
  height: 40px;
  background: #e5e7eb;
  color: #6b7280;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 16px;
}

.friend-info {
  flex: 1;
}

.friend-name {
  font-size: 14px;
  font-weight: 500;
  color: #374151;
  margin-bottom: 2px;
}

.friend-date {
  font-size: 12px;
  color: #6b7280;
}

.friend-status {
  font-size: 12px;
  padding: 4px 8px;
  border-radius: 12px;
  font-weight: 500;
}

.friend-status.active {
  background: #dcfce7;
  color: #166534;
}

/* =====================
   TRACKING PESANAN
===================== */
.tracking-card {
  background: #fff;
  border-radius: 12px;
  padding: 25px;
  box-shadow: 0 2px 8px rgba(0,0,0,.1);
}

.tracking-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 25px;
}

.tracking-header h3 {
  color: #374151;
  font-size: 18px;
  margin: 0;
  display: flex;
  align-items: center;
  gap: 8px;
}

.order-date {
  color: #6b7280;
  font-size: 14px;
}

.progress-container {
  display: flex;
  align-items: center;
  margin-bottom: 20px;
}

.progress-step {
  display: flex;
  flex-direction: column;
  align-items: center;
  position: relative;
}

.step-circle {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 14px;
  margin-bottom: 8px;
}

.progress-step.completed .step-circle {
  background: #10b981;
  color: white;
}

.progress-step.active .step-circle {
  background: #3b82f6;
  color: white;
}

.progress-step .step-circle {
  background: #e5e7eb;
  color: #9ca3af;
}

.step-label {
  font-size: 12px;
  color: #6b7280;
  text-align: center;
  white-space: nowrap;
}

.progress-line {
  flex: 1;
  height: 3px;
  margin: 0 10px;
  margin-bottom: 32px;
}

.progress-line.completed {
  background: #10b981;
}

.progress-line.active {
  background: linear-gradient(to right, #10b981 50%, #e5e7eb 50%);
}

.progress-line {
  background: #e5e7eb;
}

.tracking-summary {
  background: #f0fdf4;
  padding: 15px;
  border-radius: 8px;
  border-left: 4px solid #10b981;
}

.tracking-summary p {
  margin: 0 0 10px 0;
  color: #374151;
  font-size: 14px;
}

.btn-detail {
  background: #3b82f6;
  color: white;
  border: none;
  padding: 8px 16px;
  border-radius: 6px;
  font-size: 12px;
  cursor: pointer;
  transition: background 0.2s;
}

.btn-detail:hover {
  background: #2563eb;
}

/* =====================
   STATS CARD
===================== */
.stats-card {
  background: #fff;
  border-radius: 12px;
  padding: 25px;
  box-shadow: 0 2px 8px rgba(0,0,0,.1);
  text-align: center;
}

.stats-header {
  margin-bottom: 25px;
}

.stats-header h3 {
  color: #374151;
  font-size: 18px;
  margin: 0;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 8px;
}

.progress-circle-container {
  display: flex;
  justify-content: center;
  margin-bottom: 20px;
  position: relative;
}

.progress-circle {
  position: relative;
}

.progress-text {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  text-align: center;
}

.progress-value {
  display: block;
  font-size: 24px;
  font-weight: bold;
  color: #10b981;
}

.progress-label {
  font-size: 12px;
  color: #6b7280;
}

.stats-info {
  display: flex;
  flex-direction: column;
  gap: 12px;
}

.stat-item {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 8px 0;
  border-bottom: 1px solid #f3f4f6;
}

.stat-item:last-child {
  border-bottom: none;
}

.stat-label {
  font-size: 14px;
  color: #6b7280;
}

.stat-value {
  font-size: 14px;
  font-weight: 600;
  color: #374151;
}

/* =====================
   BOTTOM SECTION
===================== */
.bottom-section {
  display: grid;
  grid-template-columns: 2fr 1fr;
  gap: 20px;
}

.bottom-card {
  background: #fff;
  border-radius: 12px;
  padding: 25px;
  box-shadow: 0 2px 8px rgba(0,0,0,.1);
}

.bottom-header {
  height: 12px;
  width: 30%;
  background: #e0e0e0;
  border-radius: 6px;
  margin-bottom: 20px;
}

.bottom-lines {
  display: flex;
  flex-direction: column;
  gap: 12px;
}

.bottom-line {
  height: 10px;
  background: #f0f0f0;
  border-radius: 4px;
}

/* =====================
   RESPONSIVE
===================== */
@media (max-width: 768px) {
  .package-unified-card {
    grid-template-columns: 1fr;
    gap: 15px;
  }
  
  .usage-stats {
    grid-template-columns: 1fr;
    gap: 6px;
  }
  
  .speed-number {
    font-size: 24px;
  }
  
  .speed-unit {
    font-size: 14px;
  }
}

@media (max-width: 1200px) {
  .icon-grid {
    grid-template-columns: repeat(6, 1fr);
  }

  .bottom-section,
  .package-unified-card {
    grid-template-columns: 1fr;
  }
  
  .referral-content {
    grid-template-columns: 1fr;
  }
}
</style>
@endpush

@section('content')
<div class="dashboard-container">
  <div class="dashboard-wrapper">

    <div class="main-content">

      <!-- SEARCH BAR -->
  
        <div class="search-container">
          <i class="fas fa-search search-icon"></i>
          <input type="text" class="search-input" placeholder="Cari paket internet, layanan, atau informasi...">
          <button class="search-button">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>

      <!-- BANNER -->
      <div class="banner-area"></div>

      <!-- ICON GRID -->
      <div class="icon-grid">
        <a href="{{ route('profil') }}" class="icon-item">
          <div class="icon-content">
            <i class="fas fa-user icon-fa"></i>
            <div class="icon-label">Profil</div>
          </div>
        </a>
        <a href="{{ route('tagihan') }}" class="icon-item">
          <div class="icon-content">
            <i class="fas fa-credit-card icon-fa"></i>
            <div class="icon-label">Tagihan</div>
          </div>
        </a>
        <a href="{{ route('tiket') }}" class="icon-item">
          <div class="icon-content">
            <i class="fas fa-ticket-alt icon-fa"></i>
            <div class="icon-label">Tiket</div>
          </div>
        </a>
        <a href="{{ route('referral') }}" class="icon-item">
          <div class="icon-content">
            <i class="fas fa-users icon-fa"></i>
            <div class="icon-label">Referral</div>
          </div>
        </a>
        <a href="{{ route('komisi') }}" class="icon-item">
          <div class="icon-content">
            <i class="fas fa-dollar-sign icon-fa"></i>
            <div class="icon-label">Komisi</div>
          </div>
        </a>
        <a href="{{ route('pengaturan') }}" class="icon-item">
          <div class="icon-content">
            <i class="fas fa-cog icon-fa"></i>
            <div class="icon-label">Pengaturan</div>
          </div>
        </a>
      </div>

      <!-- CONTENT : PAKET AKTIF -->
      <div class="package-section">
        <div class="package-unified-card">
          <!-- Paket Aktif Saya -->
          <div class="active-package-content">
            <div class="package-header">
              <h3><i class="fas fa-wifi"></i> Paket Aktif Saya</h3>
              <span class="status-badge active">Aktif</span>
            </div>
            
            <div class="package-badge">Flash</div>
            
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
            
            <button class="package-button">Kelola Paket</button>
          </div>

          <!-- Durasi Paket -->
          <div class="duration-content">
            <div class="duration-header">
              <h3><i class="fas fa-calendar-alt"></i> Durasi Paket</h3>
            </div>
            
            <div class="duration-info">
              <div class="duration-label">Periode Aktif</div>
              <div class="duration-date">15 Jan 2024 - 15 Feb 2024</div>
            </div>
            
            <div class="progress-section">
              <div class="progress-header">
                <span class="progress-label">Sisa Waktu</span>
                <span class="progress-value">18 hari</span>
              </div>
              <div class="progress-bar">
                <div class="progress-fill" style="width: 60%"></div>
              </div>
              <div class="progress-footer">
                <span>Mulai</span>
                <span>Berakhir</span>
              </div>
            </div>
            
            <div class="usage-stats">
              <div class="stat-item">
                <div class="stat-label">Data Terpakai</div>
                <div class="stat-value">Unlimited</div>
              </div>
              <div class="stat-item">
                <div class="stat-label">Kecepatan Rata-rata</div>
                <div class="stat-value">28.5 Mbps</div>
              </div>
            </div>
            
            <button class="extend-btn">Perpanjang Paket</button>
          </div>
        </div>
      </div>

      <!-- REFERRAL SECTION -->
      <div class="referral-section">
        <div class="referral-card">
          <div class="referral-header">
            <h3><i class="fas fa-users"></i> Program Referral</h3>
            <span class="friends-count">{{ $data['commission_summary']['total_referrals'] ?? 0 }} teman bergabung</span>
          </div>
          
          <div class="referral-content">
            <div class="referral-stats">
              <div class="commission-card">
                <div class="commission-content">
                  <div class="commission-label">Total Komisi</div>
                  <div class="commission-amount">{{ number_format($data['commission_summary']['total_earned'] ?? 0, 0, ',', '.') }}<sup>Rp</sup></div>
                  <div class="commission-change">Pending: Rp {{ number_format($data['commission_summary']['pending_commission'] ?? 0, 0, ',', '.') }}</div>
                  
                  <div class="commission-actions">
                    <button class="action-btn primary" onclick="window.location.href='{{ route('komisi') }}'">Kelola</button>
                    <button class="action-btn secondary" onclick="window.location.href='{{ route('referral') }}'">Referral</button>
                    <button class="settings-btn"><i class="fas fa-cog"></i></button>
                  </div>
                </div>
                <div class="card-decoration"></div>
              </div>
              
              <div class="invite-card">
                <div class="invite-icon">
                  <i class="fas fa-user-plus"></i>
                </div>
                <div class="invite-info">
                  <div class="invite-label">Ajak Teman</div>
                  <div class="invite-desc">Dapatkan komisi dari referral</div>
                </div>
                <button class="invite-btn" onclick="window.location.href='{{ route('referral') }}'">Ajak</button>
              </div>
            </div>

            <div class="friends-list">
              @if(isset($data['recent_referrals']) && count($data['recent_referrals']) > 0)
                @foreach($data['recent_referrals'] as $referral)
                <div class="friend-item">
                  <div class="friend-avatar">
                    <i class="fas fa-user"></i>
                  </div>
                  <div class="friend-info">
                    <div class="friend-name">{{ $referral['name'] }}</div>
                    <div class="friend-date">Bergabung {{ date('d M Y', strtotime($referral['created_at'])) }}</div>
                  </div>
                  <div class="friend-status active">{{ $referral['status'] ?? 'Aktif' }}</div>
                </div>
                @endforeach
              @else
              <div class="friend-item">
                <div class="friend-avatar">
                  <i class="fas fa-user-plus"></i>
                </div>
                <div class="friend-info">
                  <div class="friend-name">Belum ada referral</div>
                  <div class="friend-date">Mulai ajak teman untuk mendapatkan komisi</div>
                </div>
              </div>
              @endif
            </div>
          </div>
        </div>
      </div>

      <!-- TRACKING PESANAN -->
      <div class="bottom-section">
        <div class="tracking-card">
          <div class="tracking-header">
            <h3><i class="fas fa-tools"></i> Status Instalasi Internet</h3>
            <span class="order-date">30 Jan 2024</span>
          </div>
          
          <div class="progress-container">
            <div class="progress-step completed">
              <div class="step-circle"><i class="fas fa-check"></i></div>
              <div class="step-label">Pesanan Diterima</div>
            </div>
            <div class="progress-line completed"></div>
            <div class="progress-step completed">
              <div class="step-circle"><i class="fas fa-check"></i></div>
              <div class="step-label">Jadwal Dikonfirmasi</div>
            </div>
            <div class="progress-line active"></div>
            <div class="progress-step active">
              <div class="step-circle"><i class="fas fa-wrench"></i></div>
              <div class="step-label">Instalasi Selesai</div>
            </div>
          </div>
          
          <div class="tracking-summary">
            <p><strong>Instalasi internet telah selesai dan siap digunakan!</strong></p>
            <button class="btn-detail" onclick="window.location.href='{{ route('tracking.detail') }}'">Lihat Detail Lengkap</button>
          </div>
        </div>

        <div class="stats-card">
          <div class="stats-header">
            <h3><i class="fas fa-chart-pie"></i> Statistik Layanan</h3>
          </div>
          
          <div class="progress-circle-container">
            <div class="progress-circle">
              <svg width="120" height="120">
                <circle cx="60" cy="60" r="50" stroke="#e5e7eb" stroke-width="8" fill="none"></circle>
                <circle cx="60" cy="60" r="50" stroke="#10b981" stroke-width="8" fill="none" 
                        stroke-dasharray="314" stroke-dashoffset="78" stroke-linecap="round"></circle>
              </svg>
              <div class="progress-text">
                <span class="progress-value">75%</span>
                <span class="progress-label">Uptime</span>
              </div>
            </div>
          </div>
          
          <div class="stats-info">
            <div class="stat-item">
              <span class="stat-label">Kecepatan Rata-rata</span>
              <span class="stat-value">28.5 Mbps</span>
            </div>
            <div class="stat-item">
              <span class="stat-label">Ping</span>
              <span class="stat-value">15ms</span>
            </div>
          </div>
        </div>
      </div>

    </div>

  </div>
</div>
@endsection