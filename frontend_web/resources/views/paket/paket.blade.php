@extends('layouts.app')

@section('title', 'Paket Internet')

@push('styles')
<style>
.page-title {
    text-align: center;
    margin-bottom: 30px;
}

.page-title h1 {
    color: #1e3a8a;
    font-size: 28px;
    margin-bottom: 8px;
}

.page-title p {
    color: #666;
    font-size: 14px;
}

.packages-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
    gap: 20px;
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
<div class="page-title">
    <h1>Paket Internet DeltaNet</h1>
    <p>Pilih paket internet yang sesuai dengan kebutuhan Anda</p>
</div>

<div class="packages-grid">
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
@endsection