<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title', 'Dashboard') - DeltaNet</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Arial, sans-serif;
}

body{
    background:#f3f4f6;
}

/* HEADER */
.header{
    position:relative;
    display:flex;
    align-items:center;
    gap:15px;
    background:#fff;
    padding:14px 20px;
    margin:16px;
    border-radius:10px;
    box-shadow:0 2px 6px rgba(0,0,0,.08);
}

.logo{
    font-weight:bold;
    color:#2563eb;
    font-size:18px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.logo img {
    height: 32px;
    width: auto;
}

.hamburger{
    font-size:22px;
    background:none;
    border:none;
    cursor:pointer;
}

/* DROPDOWN MENU LEFT */
.dropdown-menu{
    position:absolute;
    top:60px;
    left:20px;
    width:220px;
    background:#fff;
    border-radius:12px;
    box-shadow:0 20px 40px rgba(0,0,0,.15);
    display:none;
    overflow:hidden;
    z-index:100;
}

.dropdown-menu.active{
    display:block;
}

.dropdown-menu a{
    display:block;
    padding:14px 18px;
    text-decoration:none;
    color:#374151;
    font-size:14px;
}

.dropdown-menu a:hover{
    background:#f3f4f6;
}

.dropdown-menu a.active{
    background:#3b82f6;
    color:#fff;
}

/* PROFILE */
.profile{
    margin-left:auto;
    cursor:pointer;
}

.avatar{
    width:38px;
    height:38px;
    background:#3b82f6;
    color:#fff;
    border-radius:50%;
    display:flex;
    align-items:center;
    justify-content:center;
    font-weight:bold;
}

/* PROFILE MENU */
.profile-menu{
    position:absolute;
    top:60px;
    right:20px;
    width:220px;
    background:#fff;
    border-radius:12px;
    box-shadow:0 20px 40px rgba(0,0,0,.15);
    display:none;
    overflow:hidden;
    z-index:200;
}

.profile-menu.active{
    display:block;
}

.profile-info{
    padding:14px 18px;
    border-bottom:1px solid #e5e7eb;
}

.profile-info small{
    color:#6b7280;
}

.profile-menu a{
    display:block;
    padding:14px 18px;
    text-decoration:none;
    color:#374151;
    font-size:14px;
}

.profile-menu a:hover{
    background:#f3f4f6;
}

.logout{
    color:#ef4444;
}

/* MAIN */
.main{
    padding:16px;
}

/* CARD */
.card{
    background:#fff;
    padding:20px;
    border-radius:12px;
    box-shadow:0 2px 6px rgba(0,0,0,.08);
    margin-bottom:20px;
}

/* RESPONSIVE */
@media(max-width:900px){
    .main{
        padding:12px;
    }
    
    .header{
        margin:12px;
        padding:12px 16px;
    }
}
</style>
@stack('styles')
</head>
<body>

<!-- HEADER -->
<div class="header">
    <button class="hamburger" id="hamburger">☰</button>
    <div class="logo">
        <img src="{{ asset('deltanet-logo.png') }}" alt="DeltaNet Logo">
    
    </div>

    <div class="profile" id="profileBtn">
        <div class="avatar">UD</div>
    </div>

    <!-- LEFT MENU -->
    <div class="dropdown-menu" id="menu">
        <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a>
        <a href="{{ route('paket') }}" class="{{ request()->routeIs('paket') ? 'active' : '' }}">Paket Internet</a>
        <a href="{{ route('profil') }}" class="{{ request()->routeIs('profil') ? 'active' : '' }}">Profil Saya</a>
        <a href="{{ route('tagihan') }}" class="{{ request()->routeIs('tagihan') ? 'active' : '' }}">Tagihan</a>
        <a href="{{ route('tiket') }}" class="{{ request()->routeIs('tiket') ? 'active' : '' }}">Tiket</a>
        <a href="{{ route('referral') }}" class="{{ request()->routeIs('referral') ? 'active' : '' }}">Referral</a>
        <a href="{{ route('komisi') }}" class="{{ request()->routeIs('komisi') ? 'active' : '' }}">Komisi</a>
    </div>

    <!-- PROFILE MENU -->
    <div class="profile-menu" id="profileMenu">
        <div class="profile-info">
            <strong>{{ session('user_name', 'User Demo') }}</strong><br>
            <small>{{ session('user_phone', '+62812345678') }}</small>
        </div>
        <a href="{{ route('profil') }}">Profil Saya</a>
        <a href="{{ route('pengaturan') }}">Pengaturan</a>
        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit" class="logout" style="background:none;border:none;width:100%;text-align:left;padding:14px 18px;cursor:pointer;">Keluar</button>
        </form>
    </div>
</div>

<!-- MAIN -->
<div class="main">
    @yield('content')
</div>

<script>
const hamburger = document.getElementById('hamburger');
const menu = document.getElementById('menu');
const profileBtn = document.getElementById('profileBtn');
const profileMenu = document.getElementById('profileMenu');

hamburger.onclick = (e) => {
    e.stopPropagation();
    menu.classList.toggle('active');
    profileMenu.classList.remove('active');
};

profileBtn.onclick = (e) => {
    e.stopPropagation();
    profileMenu.classList.toggle('active');
    menu.classList.remove('active');
};

document.addEventListener('click', () => {
    menu.classList.remove('active');
    profileMenu.classList.remove('active');
});
</script>
@stack('scripts')
</body>
</html>