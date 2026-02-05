@extends('layouts.app')

@section('title', 'Edit Tiket')

@push('styles')
<style>
.page-title {
    font-size: 28px;
    font-weight: 700;
    color: #1f2937;
    margin-bottom: 8px;
}

.breadcrumb {
    font-size: 14px;
    color: #6b7280;
    margin-bottom: 32px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.breadcrumb span {
    color: #3b82f6;
    font-weight: 500;
}

.breadcrumb-separator {
    color: #d1d5db;
}

.form-card {
    background: #ffffff;
    padding: 32px;
    border-radius: 16px;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    border: 1px solid #f3f4f6;
}

.form-group {
    margin-bottom: 24px;
}

.form-label {
    display: block;
    font-size: 14px;
    font-weight: 600;
    color: #374151;
    margin-bottom: 8px;
}

.form-input {
    width: 100%;
    padding: 12px 16px;
    border: 1px solid #d1d5db;
    border-radius: 8px;
    font-size: 14px;
    outline: none;
    transition: all 0.2s;
}

.form-input:focus {
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

.form-select {
    width: 100%;
    padding: 12px 16px;
    border: 1px solid #d1d5db;
    border-radius: 8px;
    font-size: 14px;
    outline: none;
    background: white;
    cursor: pointer;
}

.form-select:focus {
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

.form-textarea {
    width: 100%;
    padding: 12px 16px;
    border: 1px solid #d1d5db;
    border-radius: 8px;
    font-size: 14px;
    outline: none;
    resize: vertical;
    min-height: 120px;
    font-family: Arial, sans-serif;
}

.form-textarea:focus {
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

.form-actions {
    display: flex;
    gap: 12px;
    justify-content: flex-end;
    margin-top: 32px;
    padding-top: 24px;
    border-top: 1px solid #e5e7eb;
}

.btn {
    border: none;
    padding: 12px 24px;
    border-radius: 8px;
    cursor: pointer;
    font-weight: 500;
    font-size: 14px;
    transition: all 0.2s;
    display: inline-flex;
    align-items: center;
    gap: 8px;
}

.btn-primary {
    background: #3b82f6;
    color: white;
}

.btn-primary:hover {
    background: #2563eb;
    transform: translateY(-1px);
}

.btn-secondary {
    background: #f3f4f6;
    color: #374151;
    border: 1px solid #d1d5db;
}

.btn-secondary:hover {
    background: #e5e7eb;
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
}

.ticket-info {
    background: #f8fafc;
    padding: 16px;
    border-radius: 8px;
    margin-bottom: 24px;
    border-left: 4px solid #3b82f6;
}

.ticket-info h4 {
    color: #1f2937;
    font-size: 16px;
    margin-bottom: 8px;
}

.ticket-info p {
    color: #6b7280;
    font-size: 14px;
    margin: 0;
}

@media (max-width: 768px) {
    .form-row {
        grid-template-columns: 1fr;
    }
    
    .form-actions {
        flex-direction: column;
    }
    
    .form-card {
        padding: 20px;
    }
}
</style>
@endpush

@section('content')

<div class="page-title"><i class="fas fa-edit"></i> Edit Tiket</div>
<div class="breadcrumb">
    <span>Dashboard</span> 
    <span class="breadcrumb-separator">›</span> 
    <a href="{{ route('tiket') }}" style="color: #3b82f6;">Tiket</a>
    <span class="breadcrumb-separator">›</span> 
    <span>Edit Tiket</span>
</div>

<div class="form-card">
    <div class="ticket-info">
        <h4>ID Tiket: {{ $id }}</h4>
        <p>Dibuat pada: 10 Mei 2024 • Status: Terbuka</p>
    </div>

    <form action="{{ route('tiket.update', $id) }}" method="POST">
        @csrf
        
        <div class="form-group">
            <label class="form-label">Subjek Tiket</label>
            <input type="text" name="subjek" class="form-input" value="Masalah koneksi lambat" required>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label class="form-label">Kategori</label>
                <select name="kategori" class="form-select" required>
                    <option value="">Pilih Kategori</option>
                    <option value="teknis" selected>Masalah Teknis</option>
                    <option value="billing">Tagihan</option>
                    <option value="upgrade">Upgrade Paket</option>
                    <option value="instalasi">Instalasi Baru</option>
                    <option value="lainnya">Lainnya</option>
                </select>
            </div>

            <div class="form-group">
                <label class="form-label">Prioritas</label>
                <select name="prioritas" class="form-select" required>
                    <option value="">Pilih Prioritas</option>
                    <option value="rendah">Rendah</option>
                    <option value="sedang">Sedang</option>
                    <option value="tinggi" selected>Tinggi</option>
                    <option value="kritis">Kritis</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">Deskripsi Masalah</label>
            <textarea name="deskripsi" class="form-textarea" required>Saya mengalami masalah koneksi internet yang sangat lambat sejak kemarin. Kecepatan download hanya 1 Mbps padahal paket saya 100 Mbps. Mohon bantuan untuk memperbaiki masalah ini segera.</textarea>
        </div>

        <div class="form-actions">
            <button type="button" class="btn btn-secondary" onclick="window.location.href='{{ route('tiket') }}'">
                <i class="fas fa-arrow-left"></i> Batal
            </button>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Update Tiket
            </button>
        </div>
    </form>
</div>

@endsection