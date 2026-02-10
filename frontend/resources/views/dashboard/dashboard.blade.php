@extends('layouts.app')
@section('title', 'Dashboard')
@push('styles')
  <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
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
      
      <!-- BANNER -->
      <div class="banner-carousel">
        <div class="banner-track" id="bannerTrack">
          <div class="banner-item banner-text">
            <div class="banner-content">
              <h2>Paket Hemat</h2>
              <p>Internet Cepat Mulai 100Mbps</p>
              <span class="banner-price">Rp 200.000/bulan</span>
            </div>
          </div>
          <div class="banner-item banner-text">
            <div class="banner-content">
              <h2>Paket Premium</h2>
              <p>Kecepatan Hingga 300Mbps</p>
              <span class="banner-price">Rp 350.000/bulan</span>
            </div>
          </div>
          <div class="banner-item banner-text">
            <div class="banner-content">
              <h2>Paket Unlimited</h2>
              <p>Tanpa Batas Kuota & FUP</p>
              <span class="banner-price">Rp 500.000/bulan</span>
            </div>
          </div>
        </div>
        <div class="banner-dots" id="bannerDots">
          <span class="dot active" data-index="0"></span>
          <span class="dot" data-index="1"></span>
          <span class="dot" data-index="2"></span>
        </div>
      </div>
      
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
          <div class="active-package-content">
            <div class="package-header">
              <h3>Paket Aktif</h3>
              <span class="status-badge">Aktif</span>
            </div>
            <span class="package-tag">Paket Istimewa</span>
            <div class="speed-info">
              Kecepatan: <strong>200</strong> Mbps
            </div>
            <div class="price-info">Rp 350.000/bulan</div>
            <hr class="package-divider">
            <ul class="package-features">
              <li>✓ Unlimited Kuota</li>
              <li>✓ Free Instalasi</li>
              <li>✓ Support 24/7</li>
            </ul>
            <button class="manage-btn">Kelola Paket</button>
          </div>
          
          <div class="duration-content">
            <div class="duration-header">
              <h3>Durasi Paket</h3>
            </div>
            <div class="duration-info">
              <div class="duration-label">Tanggal Mulai</div>
              <div class="duration-date">1 Januari 2024</div>
            </div>
            <div class="duration-info">
              <div class="duration-label">Tanggal Berakhir</div>
              <div class="duration-date">31 Januari 2024</div>
            </div>
            <div class="progress-section">
              <div class="progress-header">
                <span>Sisa Waktu</span>
                <span>21 Hari</span>
              </div>
              <div class="progress-bar">
                <div class="progress-fill" style="width: 70%"></div>
              </div>
              <div class="progress-footer">
                <span>10 hari terpakai</span>
                <span>21 hari tersisa</span>
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
            <span class="friends-count">5 teman bergabung</span>
          </div> 
          <div class="referral-content">
            <div class="commission-card">
              <div class="commission-content">
                <div class="commission-label">Total Komisi</div>
                <div class="commission-amount">450,000<sup>$</sup></div>
                <div class="commission-actions">
                  <button class="action-btn primary">Tarik Komisi</button>
                  <button class="settings-btn"><i class="fas fa-cog"></i></button>
                </div>
              </div>
              <div class="card-decoration"></div>
            </div>
            <div class="friends-list">
              <div class="friend-item">
                <div class="friend-avatar">
                  <i class="fas fa-user"></i>
                </div>
                <div class="friend-info">
                  <div class="friend-name">Ahmad Rizki</div>
                  <div class="friend-date">Bergabung 15 Jan 2024</div>
                </div>
                <div class="friend-status active">Aktif</div>
              </div>
              <div class="friend-item">
                <div class="friend-avatar">
                  <i class="fas fa-user"></i>
                </div>
                <div class="friend-info">
                  <div class="friend-name">Siti Nurhaliza</div>
                  <div class="friend-date">Bergabung 10 Jan 2024</div>
                </div>
                <div class="friend-status active">Aktif</div>
              </div>
              <div class="friend-item">
                <div class="friend-avatar">
                  <i class="fas fa-user"></i>
                </div>
                <div class="friend-info">
                  <div class="friend-name">Budi Santoso</div>
                  <div class="friend-date">Bergabung 5 Jan 2024</div>
                </div>
                <div class="friend-status active">Aktif</div>
              </div>
              <div class="friend-item">
                <div class="friend-avatar">
                  <i class="fas fa-user"></i>
                </div>
                <div class="friend-info">
                  <div class="friend-name">Dewi Lestari</div>
                  <div class="friend-date">Bergabung 3 Jan 2024</div>
                </div>
                <div class="friend-status active">Aktif</div>
              </div>
              <div class="friend-item">
                <div class="friend-avatar">
                  <i class="fas fa-user"></i>
                </div>
                <div class="friend-info">
                  <div class="friend-name">Eko Prasetyo</div>
                  <div class="friend-date">Bergabung 1 Jan 2024</div>
                </div>
                <div class="friend-status active">Aktif</div>
              </div>
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
                <circle cx="60" cy="60" r="50" stroke="#10b981" stroke-width="8" fill="none" stroke-dasharray="314" stroke-dashoffset="78" stroke-linecap="round"></circle>
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

<script>
const track = document.getElementById('bannerTrack');
const dots = document.querySelectorAll('.dot');
const items = document.querySelectorAll('.banner-item');
let currentIndex = 0;
let autoSlideInterval;
const totalItems = items.length;
let startX = 0;
let currentX = 0;
let isDragging = false;

// Clone all items for infinite loop
for (let i = 0; i < totalItems; i++) {
  const clone = items[i].cloneNode(true);
  track.appendChild(clone);
}
const lastClone = items[totalItems - 1].cloneNode(true);
track.insertBefore(lastClone, items[0]);

function updateCarousel(transition = true) {
  if (!transition) track.style.transition = 'none';

  const containerWidth = track.parentElement.offsetWidth;
  const itemWidth = 790;
  const gap = 20;
  const centerOffset = (containerWidth - itemWidth) / 2;
  const moveDistance = (currentIndex + 1) * (itemWidth + gap);
  
  track.style.transform = `translateX(${centerOffset - moveDistance}px)`;

  if (!transition) {
    track.offsetHeight;
    track.style.transition = 'transform 0.5s ease';
  }

  dots.forEach((dot, i) =>
    dot.classList.toggle('active', i === currentIndex)
  );
}

dots.forEach(dot => {
  dot.addEventListener('click', () => {
    currentIndex = parseInt(dot.dataset.index);
    updateCarousel();
    clearInterval(autoSlideInterval);
    startAutoSlide();
  });
});

track.addEventListener('transitionend', () => {
  if (currentIndex >= totalItems) {
    currentIndex = 0;
    updateCarousel(false);
  } else if (currentIndex < 0) {
    currentIndex = totalItems - 1;
    updateCarousel(false);
  }
});

// Touch & Mouse events
track.addEventListener('mousedown', dragStart);
track.addEventListener('touchstart', dragStart);
track.addEventListener('mousemove', drag);
track.addEventListener('touchmove', drag);
track.addEventListener('mouseup', dragEnd);
track.addEventListener('touchend', dragEnd);
track.addEventListener('mouseleave', dragEnd);

function dragStart(e) {
  isDragging = true;
  startX = e.type.includes('mouse') ? e.pageX : e.touches[0].clientX;
  clearInterval(autoSlideInterval);
  track.style.cursor = 'grabbing';
}

function drag(e) {
  if (!isDragging) return;
  e.preventDefault();
  currentX = e.type.includes('mouse') ? e.pageX : e.touches[0].clientX;
}

function dragEnd() {
  if (!isDragging) return;
  isDragging = false;
  track.style.cursor = 'grab';
  
  const diff = startX - currentX;
  if (Math.abs(diff) > 50) {
    if (diff > 0) {
      currentIndex++;
    } else {
      currentIndex--;
    }
    updateCarousel();
  }
  
  startAutoSlide();
}

function nextSlide() {
  currentIndex++;
  updateCarousel();
}

function startAutoSlide() {
  autoSlideInterval = setInterval(nextSlide, 4000);
}

function togglePackageActions(card) {
  const actions = card.querySelector('.package-actions');
  actions.classList.toggle('show');
}

track.style.cursor = 'grab';
updateCarousel(false);
startAutoSlide();
</script>



@endsection
