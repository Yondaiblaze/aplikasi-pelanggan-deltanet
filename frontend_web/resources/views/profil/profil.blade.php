@extends('layouts.app')

@section('title', 'Profil Saya')

@push('styles')
<style>
.card{
    background:#fff;
    padding:20px;
    border-radius:12px;
    box-shadow:0 4px 20px rgba(0,0,0,.05);
    margin-bottom:20px;
}

.form-group {
    margin-bottom: 15px;
}

.form-group label {
    display: block;
    margin-bottom: 6px;
    color: #374151;
    font-weight: 600;
}

.form-group input,
.form-group textarea {
    width: 100%;
    padding: 10px 12px;
    border: 1px solid #d1d5db;
    border-radius: 6px;
    font-size:14px;
}

.form-group textarea{
    resize:none;
}

.form-group input[readonly]{
    background:#f3f4f6;
    color:#6b7280;
    cursor:not-allowed;
}

.save-btn {
    background-color: #3b82f6;
    color: white;
    padding: 10px 22px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-weight:600;
}

.save-btn:hover{
    background:#2563eb;
}

.info-text {
    color: #6b7280;
    margin-bottom: 8px;
    font-size:14px;
}

.status-active {
    color: #059669;
    font-weight: bold;
}

.grid-2{
    display:grid;
    grid-template-columns:repeat(2,1fr);
    gap:15px;
}

@media(max-width:768px){
    .grid-2{grid-template-columns:1fr;}
}
</style>
@endpush

@section('content')

{{-- INFORMASI PRIBADI --}}
<div class="card">
    <h3 style="margin-bottom:15px;color:#374151;">Informasi Pribadi</h3>

    <form enctype="multipart/form-data">
        <div class="grid-2">

            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" value="John Doe" readonly>
            </div>

            <div class="form-group">
                <label>No. SIM / NIK / Kartu Pelajar</label>
                <input type="text" placeholder="Masukkan Nomor Identitas">
            </div>

            <div class="form-group">
                <label>Tempat Lahir</label>
                <input type="text" placeholder="Masukkan Tempat Lahir">
            </div>

            <div class="form-group">
                <label>Tanggal Lahir</label>
                <input type="date">
            </div>

            {{-- NO WA OTOMATIS --}}
            <div class="form-group">
                <label>No. WhatsApp</label>
                <input type="tel" value="+6281234567890" readonly>
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" placeholder="email@example.com">
            </div>

            {{-- TANGGAL PEMASANGAN --}}
            <div class="form-group">
                <label>Tanggal Pemasangan yang Diinginkan</label>
                <input type="date">
            </div>

            {{-- FOTO RUMAH --}}
            <div class="form-group">
                <label>Foto Rumah</label>
                <input type="file" accept="image/*">
            </div>

            {{-- FOTO IDENTITAS --}}
            <div class="form-group">
                <label>Foto SIM / KTP / Kartu Pelajar</label>
                <input type="file" accept="image/*">
            </div>

        </div>

        <div class="form-group">
            <label>Alamat Lengkap</label>
            <textarea rows="3" placeholder="Masukkan alamat lengkap"></textarea>
        </div>

        <button type="submit" class="save-btn">Simpan Perubahan</button>
    </form>
</div>

{{-- INFORMASI AKUN --}}
<div class="card">
    <h3 style="margin-bottom:15px;color:#374151;">Informasi Akun</h3>

    <p class="info-text"><strong>Nomor Pelanggan:</strong> DLT001234</p>
    <p class="info-text"><strong>Tanggal Bergabung:</strong> 15 Januari 2024</p>
    <p class="info-text">
        <strong>Status Akun:</strong>
        <span class="status-active">Aktif</span>
    </p>
</div>

@endsection
