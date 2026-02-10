<!-- SIDEBAR -->
<div class="sidebar">
    <div class="sidebar-header">Menu</div>
    <nav class="sidebar-nav">
        <ul class="nav-menu">
            <li class="nav-item"><a class="nav-link" href="{{ route('dashboard') }}"><i class="fas fa-home"></i>Dashboard</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('paket') }}"><i class="fas fa-box"></i>Paket Internet</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('tagihan') }}"><i class="fas fa-credit-card"></i>Tagihan</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('tiket') }}"><i class="fas fa-ticket-alt"></i>Tiket</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('referral') }}"><i class="fas fa-users"></i>Referral</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('komisi') }}"><i class="fas fa-dollar-sign"></i>Komisi</a></li>
            <div class="nav-section-title">Pengaturan</div>
            <li class="nav-item"><a class="nav-link" href="{{ route('profil') }}"><i class="fas fa-user"></i>Profil</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('pengaturan') }}"><i class="fas fa-cog"></i>Pengaturan</a></li>
        </ul>
    </nav>
    <div class="sidebar-footer">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="nav-link" style="background:none;border:none;width:100%;text-align:left;">
                <i class="fas fa-sign-out-alt"></i> Logout
            </button>
        </form>
    </div>
</div>

<style>
.sidebar{
    width:260px;
    background:#fff;
    border-radius:6px;
    box-shadow:0 8px 20px rgba(0,0,0,.08);
    display:flex;
    flex-direction:column;
    position:sticky;
    top:20px;
    height:fit-content;
}
.sidebar-header{
    padding:18px 20px;
    border-bottom:1px solid #e5e7eb;
    font-weight:700;
    color:#2563eb;
}
.sidebar-nav{
    padding:15px;
}
.nav-menu{
    list-style:none;
    padding:0;
    margin:0;
}
.nav-item{
    margin-bottom:4px;
}
.nav-link{
    display:flex;
    align-items:center;
    gap:12px;
    padding:10px 15px;
    font-size:14px;
    color:#374151;
    text-decoration:none;
    border-radius:8px;
    cursor:pointer;
}
.nav-link:hover{
    background:#f3f4f6;
    color:#2563eb;
}
.nav-item.active .nav-link{
    background:#e0ecff;
    color:#2563eb;
    font-weight:600;
}
.nav-section-title{
    margin:15px 0 10px;
    font-weight:700;
    color:#2563eb;
    font-size:14px;
}
.sidebar-footer{
    margin-top:auto;
    padding:15px;
    border-top:1px solid #e5e7eb;
}
@media(max-width:768px){
    .sidebar{display:none;}
}
</style>