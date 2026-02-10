@extends('layouts.app')

@section('title', 'Profil Saya')

@push('styles')
<style>
.page-container{
    display:flex;
    gap:20px;
    min-height:100vh;
}

.main-content{
    flex:1;
}

/* GRID UTAMA */
.profile-grid{
    display:grid;
    grid-template-columns:300px 1fr;
    gap:20px;
}

/* CARD */
.card{
    background:#fff;
    padding:20px;
    border-radius:12px;
    box-shadow:0 4px 20px rgba(0,0,0,.05);
}

/* ================= PROFIL CARD ================= */
.profile-card{
    text-align:center;
}

.profile-avatar{
    width:120px;
    height:120px;
    border-radius:50%;
    background:#e5e7eb;
    margin:0 auto 15px;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:40px;
    color:#9ca3af;
}

.profile-name{
    font-size:18px;
    font-weight:700;
    color:#374151;
}

.profile-email{
    font-size:13px;
    color:#6b7280;
    margin-bottom:15px;
}

.profile-btn{
    display:inline-block;
    background:#3b82f6;
    color:#fff;
    padding:8px 18px;
    border-radius:6px;
    text-decoration:none;
    font-size:14px;
    font-weight:600;
}

.profile-btn:hover{
    background:#2563eb;
}

/* ================= FORM ================= */
.grid-2{
    display:grid;
    grid-template-columns:repeat(2,1fr);
    gap:15px;
}

.form-group{
    margin-bottom:15px;
}

.form-group label{
    font-size:14px;
    font-weight:600;
    margin-bottom:6px;
    display:block;
}

.form-group input,
.form-group textarea{
    width:100%;
    padding:10px 12px;
    border:1px solid #d1d5db;
    border-radius:6px;
    font-size:14px;
}

.form-group input[readonly]{
    background:#f3f4f6;
    color:#6b7280;
}

.save-btn{
    background:#3b82f6;
    color:#fff;
    padding:10px 22px;
    border:none;
    border-radius:6px;
    font-weight:600;
    cursor:pointer;
}

.save-btn:hover{
    background:#2563eb;
}

/* ================= INFO AKUN ================= */
.info-text{
    font-size:14px;
    color:#374151;
    margin-bottom:8px;
}

.status-active{
    color:#16a34a;
    font-weight:700;
}

@media(max-width:768px){
    .profile-grid{
        grid-template-columns:1fr;
    }
}
</style>
@endpush

@section('content')
<div class="page-container">

    @include('layouts.sidebar')

    {{-- MAIN --}}
    <div class="main-content">

        <div class="profile-grid">

            {{-- PROFIL --}}
            <div class="card profile-card">
                <div class="profile-avatar">
                    <i class="fas fa-user"></i>
                </div>
                <div class="profile-name">John Doe</div>
                <div class="profile-email">1234567890</div>
                <a href="#" class="profile-btn">Ganti Foto</a>
            </div>

            {{-- FORM --}}
            <div class="card">
                <h3 style="margin-bottom:15px;">Informasi Pribadi</h3>
                <form>
                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" value="John Doe" readonly>
                    </div>
                   
                    <div class="form-group">
                        <label>No WhatsApp</label>
                        <input type="text" value="+628123456789" readonly>
                    </div>

                    <div class="form-group">
                        <label>Kata Sandi</label>
                        <input type="password" value="password123" readonly>
                    </div>

                    <button class="save-btn">Simpan Perubahan</button>
                </form>
            </div>
        </div>

        {{-- INFO AKUN --}}
        <div class="card" style="margin-top:20px;">
            <h3>Informasi Akun</h3>
            <p class="info-text"><strong>Nomor Pelanggan:</strong> DLT001234</p>
            <p class="info-text"><strong>Tanggal Bergabung:</strong> 15 Januari 2024</p>
            <p class="info-text"><strong>Status:</strong> <span class="status-active">Aktif</span></p>
        </div>

    </div>
</div>
@endsection