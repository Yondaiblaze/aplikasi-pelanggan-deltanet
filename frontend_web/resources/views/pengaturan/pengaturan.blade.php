@extends('layouts.app')

@section('title', 'Pengaturan')

@push('styles')
<style>
.settings-grid {
    display: grid;
    gap: 20px;
}

.setting-section {
    border-bottom: 1px solid #e5e7eb;
    padding-bottom: 20px;
}

.setting-section:last-child {
    border-bottom: none;
    padding-bottom: 0;
}

.setting-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px 0;
    border-bottom: 1px solid #f3f4f6;
}

.setting-item:last-child {
    border-bottom: none;
}

.setting-info h4 {
    color: #374151;
    margin-bottom: 5px;
}

.setting-info p {
    color: #6b7280;
    font-size: 14px;
}

.toggle-switch {
    position: relative;
    width: 50px;
    height: 24px;
    background: #d1d5db;
    border-radius: 12px;
    cursor: pointer;
    transition: background 0.3s;
}

.toggle-switch.active {
    background: #3b82f6;
}

.toggle-switch::after {
    content: '';
    position: absolute;
    top: 2px;
    left: 2px;
    width: 20px;
    height: 20px;
    background: white;
    border-radius: 50%;
    transition: transform 0.3s;
}

.toggle-switch.active::after {
    transform: translateX(26px);
}

.btn-secondary {
    background: #6b7280;
    color: white;
    padding: 8px 16px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-size: 14px;
}

.btn-danger {
    background: #dc2626;
    color: white;
    padding: 8px 16px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-size: 14px;
}

.form-group {
    margin-bottom: 15px;
}

.form-group label {
    display: block;
    margin-bottom: 5px;
    color: #374151;
    font-weight: bold;
}

.form-group input,
.form-group select {
    width: 100%;
    padding: 10px;
    border: 1px solid #d1d5db;
    border-radius: 5px;
}

.save-btn {
    background: #3b82f6;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}
</style>
@endpush

@section('content')
<div class="card">
    <h3 style="margin-bottom: 20px; color: #374151;">Notifikasi</h3>
    <div class="setting-section">
        <div class="setting-item">
            <div class="setting-info">
                <h4>Email Tagihan</h4>
                <p>Terima notifikasi tagihan via email</p>
            </div>
            <div class="toggle-switch active" onclick="toggleSwitch(this)"></div>
        </div>
        <div class="setting-item">
            <div class="setting-info">
                <h4>WhatsApp Reminder</h4>
                <p>Pengingat pembayaran via WhatsApp</p>
            </div>
            <div class="toggle-switch active" onclick="toggleSwitch(this)"></div>
        </div>
        <div class="setting-item">
            <div class="setting-info">
                <h4>Notifikasi Gangguan</h4>
                <p>Pemberitahuan jika ada gangguan jaringan</p>
            </div>
            <div class="toggle-switch" onclick="toggleSwitch(this)"></div>
        </div>
    </div>
</div>

<div class="card">
    <h3 style="margin-bottom: 20px; color: #374151;">Keamanan</h3>
    <div class="setting-section">
        <div class="setting-item">
            <div class="setting-info">
                <h4>Ubah Password</h4>
                <p>Terakhir diubah: 15 Januari 2024</p>
            </div>
            <button class="btn-secondary">Ubah</button>
        </div>
        <div class="setting-item">
            <div class="setting-info">
                <h4>Verifikasi 2 Langkah</h4>
                <p>Tambahan keamanan untuk akun Anda</p>
            </div>
            <div class="toggle-switch" onclick="toggleSwitch(this)"></div>
        </div>
    </div>
</div>

<div class="card">
    <h3 style="margin-bottom: 20px; color: #374151;">Pembayaran</h3>
    <form>
        <div class="form-group">
            <label for="bank">Bank Utama</label>
            <select id="bank">
                <option>BCA - 1234567890</option>
                <option>Mandiri - 0987654321</option>
                <option>BNI - 1122334455</option>
            </select>
        </div>
        <div class="form-group">
            <label for="autopay">Auto Payment</label>
            <div style="display: flex; align-items: center; gap: 10px;">
                <div class="toggle-switch" onclick="toggleSwitch(this)"></div>
                <span style="color: #6b7280; font-size: 14px;">Pembayaran otomatis setiap bulan</span>
            </div>
        </div>
        <button type="submit" class="save-btn">Simpan Pengaturan</button>
    </form>
</div>

<div class="card">
    <h3 style="margin-bottom: 20px; color: #374151;">Zona Bahaya</h3>
    <div style="background: #fef2f2; padding: 15px; border-radius: 8px; border-left: 4px solid #dc2626;">
        <div class="setting-item" style="border: none; padding: 10px 0;">
            <div class="setting-info">
                <h4 style="color: #dc2626;">Hapus Akun</h4>
                <p style="color: #991b1b;">Tindakan ini tidak dapat dibatalkan</p>
            </div>
            <button class="btn-danger">Hapus Akun</button>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function toggleSwitch(element) {
    element.classList.toggle('active');
}
</script>
@endpush
