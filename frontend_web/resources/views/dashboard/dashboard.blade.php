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
    font-size: 48px;
    font-weight: bold;
    color: #2563eb;
    margin: 0 5px;
}

.speed-unit {
    font-size: 24px;
    font-weight: bold;
    color: #2563eb;
}

.package-price {
    margin-bottom: 20px;
}

.package-price strong {
    font-size: 20px;
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
}

.feature-item {
    display: flex;
    align-items: center;
    margin-bottom: 12px;
    font-size: 14px;
    color: #374151;
}

.feature-icon {
    color: #2563eb;
    width: 20px;
    margin-right: 12px;
}

.package-button {
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

.package-button:hover {
    background: #1d4ed8;
}

/* =====================
   LIST SECTION
===================== */
.list-section {
  background: #fff;
  border-radius: 12px;
  padding: 20px;
  box-shadow: 0 2px 8px rgba(0,0,0,.1);
}

.list-header {
  height: 12px;
  width: 40%;
  background: #e0e0e0;
  border-radius: 6px;
  margin-bottom: 20px;
}

.list-item {
  display: flex;
  align-items: center;
  gap: 15px;
  margin-bottom: 15px;
}

.list-thumb {
  width: 80px;
  height: 50px;
  background: #b0d4f1;
  border-radius: 8px;
  position: relative;
}

.list-thumb::after {
  content: '';
  position: absolute;
  bottom: 5px;
  right: 5px;
  width: 20px;
  height: 8px;
  background: #4a90e2;
  border-radius: 3px;
}

.list-content {
  flex: 1;
}

.list-title {
  height: 10px;
  width: 80%;
  background: #e0e0e0;
  border-radius: 4px;
  margin-bottom: 8px;
}

.list-desc {
  height: 8px;
  width: 60%;
  background: #f0f0f0;
  border-radius: 4px;
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
@media (max-width: 1200px) {
  .icon-grid {
    grid-template-columns: repeat(6, 1fr);
  }

  .content-section,
  .bottom-section {
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
      <div class="top-bar">
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

      <!-- CONTENT : PAKET WIFI -->
      <div class="content-section">

          {{-- PAKET 20 MBPS --}}
          <div class="content-card">
              <div class="package-badge">Flash</div>
              
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
              
              <button class="package-button">Langganan Sekarang</button>
          </div>

          {{-- PAKET 30 MBPS --}}
          <div class="content-card">
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
              
              <button class="package-button">Langganan Sekarang</button>
          </div>

          {{-- PAKET 40 MBPS --}}
          <div class="content-card">
              <div class="package-badge">Flash</div>
              
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
              
              <button class="package-button">Langganan Sekarang</button>
          </div>

      </div>

      <!-- LIST -->
      <div class="list-section">
        <div class="list-header"></div>

        @for ($i = 0; $i < 2; $i++)
          <div class="list-item">
            <div class="list-thumb"></div>
            <div class="list-content">
              <div class="list-title"></div>
              <div class="list-desc"></div>
            </div>
          </div>
        @endfor
      </div>

      <!-- BOTTOM -->
      <div class="bottom-section">
        <div class="bottom-card">
          <div class="bottom-header"></div>
          <div class="bottom-lines">
            @for ($i = 0; $i < 5; $i++)
              <div class="bottom-line"></div>
            @endfor
          </div>
        </div>

        <div class="bottom-card">
          <div class="bottom-header"></div>
          <div class="chart-container">
            <div class="chart"></div>
          </div>
        </div>
      </div>

    </div>

  </div>
</div>
@endsection