@extends('layouts.app')

@section('title', 'Kelola Tiket')

@push('styles')
<style>
/* GLOBAL */
*{
    box-sizing: border-box;
}

/* HEADER */
.page-title{
    font-size: 28px;
    font-weight: 700;
    color: #1f2937;
    margin-bottom: 8px;
    letter-spacing: -0.025em;
}
.breadcrumb{
    font-size: 14px;
    color: #6b7280;
    margin-bottom: 32px;
    display: flex;
    align-items: center;
    gap: 8px;
}
.breadcrumb span{
    color: #3b82f6;
    font-weight: 500;
}
.breadcrumb-separator{
    color: #d1d5db;
}

/* CARD */
.card-box{
    background: #ffffff;
    padding: 32px;
    border-radius: 16px;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    border: 1px solid #f3f4f6;
}

/* TOP BAR */
.table-top{
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 16px;
    margin-bottom: 24px;
    flex-wrap: wrap;
}
.entries-control{
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 14px;
    color: #374151;
}
.entries-control select{
    padding: 8px 12px;
    border-radius: 8px;
    border: 1px solid #d1d5db;
    outline: none;
    font-size: 14px;
    background: white;
    cursor: pointer;
}
.entries-control select:focus{
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}
.controls-right{
    display: flex;
    align-items: center;
    gap: 12px;
}
.search-box{
    position: relative;
}
.search-box input{
    padding: 10px 16px 10px 40px;
    border-radius: 10px;
    border: 1px solid #d1d5db;
    outline: none;
    font-size: 14px;
    width: 280px;
    background: #f9fafb;
}
.search-box input:focus{
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    background: white;
}
.search-icon{
    position: absolute;
    left: 12px;
    top: 50%;
    transform: translateY(-50%);
    color: #9ca3af;
    font-size: 16px;
}

/* BUTTONS */
.btn{
    border: none;
    padding: 10px 16px;
    border-radius: 10px;
    cursor: pointer;
    font-weight: 500;
    font-size: 14px;
    transition: all 0.2s;
    display: inline-flex;
    align-items: center;
    gap: 6px;
}
.btn:hover{
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}
.btn-primary{
    background: linear-gradient(135deg, #3b82f6, #1d4ed8);
    color: white;
}
.btn-success{
    background: linear-gradient(135deg, #10b981, #059669);
    color: white;
}
.btn-info{
    background: linear-gradient(135deg, #06b6d4, #0891b2);
    color: white;
}
.btn-secondary{
    background: #f3f4f6;
    color: #374151;
    border: 1px solid #d1d5db;
}

/* TABLE */
.table-container{
    overflow-x: auto;
    border-radius: 12px;
    border: 1px solid #e5e7eb;
}
.table{
    width: 100%;
    border-collapse: collapse;
    background: white;
}
.table thead{
    background: linear-gradient(135deg, #f8fafc, #f1f5f9);
}
.table th{
    padding: 16px 20px;
    text-align: left;
    font-size: 13px;
    font-weight: 600;
    color: #374151;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    border-bottom: 2px solid #e5e7eb;
}
.table td{
    padding: 16px 20px;
    border-bottom: 1px solid #f3f4f6;
    font-size: 14px;
    color: #374151;
    vertical-align: middle;
}
.table tbody tr{
    transition: all 0.2s;
}
.table tbody tr:hover{
    background: #f8fafc;
    transform: scale(1.001);
}
.table tbody tr:last-child td{
    border-bottom: none;
}

/* STATUS */
.status{
    padding: 6px 14px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.025em;
    display: inline-block;
}
.status.open{
    background: linear-gradient(135deg, #dbeafe, #bfdbfe);
    color: #1e40af;
    border: 1px solid #93c5fd;
}
.status.closed{
    background: linear-gradient(135deg, #dcfce7, #bbf7d0);
    color: #166534;
    border: 1px solid #86efac;
}
.status.pending{
    background: linear-gradient(135deg, #fef3c7, #fde68a);
    color: #92400e;
    border: 1px solid #fcd34d;
}

/* ACTION BUTTONS */
.action-buttons{
    display: flex;
    gap: 6px;
}
.btn-action{
    border: none;
    padding: 8px 12px;
    border-radius: 8px;
    cursor: pointer;
    font-size: 12px;
    font-weight: 500;
    transition: all 0.2s;
    display: inline-flex;
    align-items: center;
    gap: 4px;
}
.btn-action:hover{
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
}
.btn-view{
    background: linear-gradient(135deg, #06b6d4, #0891b2);
    color: white;
}
.btn-edit{
    background: linear-gradient(135deg, #3b82f6, #1d4ed8);
    color: white;
}
.btn-delete{
    background: linear-gradient(135deg, #ef4444, #dc2626);
    color: white;
}

/* FOOTER */
.table-footer{
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 24px;
    padding-top: 20px;
    border-top: 1px solid #f3f4f6;
    font-size: 14px;
    color: #6b7280;
}
.pagination{
    display: flex;
    gap: 4px;
}
.pagination button{
    padding: 8px 12px;
    border: 1px solid #d1d5db;
    background: white;
    border-radius: 6px;
    cursor: pointer;
    font-size: 14px;
    transition: all 0.2s;
}
.pagination button:hover{
    background: #f3f4f6;
    border-color: #9ca3af;
}
.pagination button.active{
    background: #3b82f6;
    color: white;
    border-color: #3b82f6;
}

/* MODAL */
.modal{
    display: none;
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.6);
    backdrop-filter: blur(4px);
    animation: fadeIn 0.3s ease;
}
.modal-content{
    background: white;
    margin: 3% auto;
    padding: 0;
    border-radius: 20px;
    width: 90%;
    max-width: 700px;
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    animation: slideIn 0.3s ease;
    overflow: hidden;
}
.modal-header{
    padding: 24px 32px;
    background: linear-gradient(135deg, #f8fafc, #f1f5f9);
    border-bottom: 1px solid #e5e7eb;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.modal-header h3{
    margin: 0;
    font-size: 20px;
    font-weight: 700;
    color: #1f2937;
    display: flex;
    align-items: center;
    gap: 8px;
}
.modal-icon{
    width: 24px;
    height: 24px;
    background: linear-gradient(135deg, #3b82f6, #1d4ed8);
    border-radius: 6px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 12px;
}
.close{
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background: #f3f4f6;
    border: none;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
    color: #6b7280;
    transition: all 0.2s;
}
.close:hover{
    background: #e5e7eb;
    color: #374151;
    transform: rotate(90deg);
}
.modal-body{
    padding: 32px;
}
.detail-grid{
    display: grid;
    gap: 20px;
}
.detail-item{
    display: flex;
    flex-direction: column;
    gap: 6px;
}
.detail-label{
    font-size: 12px;
    font-weight: 600;
    color: #6b7280;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}
.detail-value{
    font-size: 16px;
    color: #1f2937;
    font-weight: 500;
}
.detail-description{
    background: #f8fafc;
    padding: 16px;
    border-radius: 12px;
    border-left: 4px solid #3b82f6;
    font-size: 14px;
    line-height: 1.6;
    color: #374151;
    margin-top: 8px;
}
.modal-footer{
    padding: 24px 32px;
    background: #f8fafc;
    border-top: 1px solid #e5e7eb;
    display: flex;
    justify-content: flex-end;
    gap: 12px;
}

/* ANIMATIONS */
@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}
@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateY(-20px) scale(0.95);
    }
    to {
        opacity: 1;
        transform: translateY(0) scale(1);
    }
}

/* RESPONSIVE */
@media (max-width: 768px) {
    .card-box{
        padding: 20px;
    }
    .table-top{
        flex-direction: column;
        align-items: stretch;
    }
    .controls-right{
        justify-content: space-between;
    }
    .search-box input{
        width: 100%;
    }
    .modal-content{
        margin: 10px;
        width: calc(100% - 20px);
    }
    .modal-body{
        padding: 20px;
    }
    .action-buttons{
        flex-direction: column;
    }
}
</style>
@endpush

@section('content')

<div class="page-title"><i class="fas fa-clipboard-list"></i> Kelola Tiket</div>
<div class="breadcrumb">
    <span>Dashboard</span>
    <span class="breadcrumb-separator">›</span>
    <span>Tiket</span>
</div>

<div class="card-box">

    <!-- TOP BAR -->
    <div class="table-top">
        <div class="entries-control">
            <span>Tampilkan</span>
            <select>
                <option>10</option>
                <option>25</option>
                <option>50</option>
            </select>
            <span>entri per halaman</span>
        </div>

        <div class="controls-right">
            <button class="btn btn-info"><i class="fas fa-download"></i> Export</button>
            <button class="btn btn-secondary"><i class="fas fa-sync-alt"></i> Refresh</button>
            <button class="btn btn-success" onclick="window.location.href='{{ route('tiket.buat') }}'"><i class="fas fa-plus"></i> Tambah Tiket</button>

            <div class="search-box">
                <span class="search-icon"><i class="fas fa-search"></i></span>
                <input type="text" placeholder="Cari tiket...">
            </div>
        </div>
    </div>

    <!-- TABLE -->
    <div class="table-container">
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>ID Tiket</th>
                    <th>Subjek</th>
                    <th>Tanggal Dibuat</th>
                    <th>Status</th>
                    <th>Prioritas</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>1</strong></td>
                    <td><code>#TKT001</code></td>
                    <td>Masalah koneksi lambat</td>
                    <td>10 Mei 2024</td>
                    <td><span class="status open">Terbuka</span></td>
                    <td><span class="status pending">Tinggi</span></td>
                    <td>
                        <div class="action-buttons">
                            <button class="btn-action btn-view" onclick="showTicketDetail('#TKT001', 'Masalah koneksi lambat', '10 Mei 2024', 'Terbuka', 'Tinggi', 'Saya mengalami masalah koneksi internet yang sangat lambat sejak kemarin. Kecepatan download hanya 1 Mbps padahal paket saya 100 Mbps. Mohon bantuan untuk memperbaiki masalah ini segera.')">
                                <i class="fas fa-eye"></i> Lihat
                            </button>
                            <button class="btn-action btn-edit" onclick="window.location.href='{{ route('tiket.edit', 'TKT001') }}'"><i class="fas fa-edit"></i> Edit</button>
                            <button class="btn-action btn-delete"><i class="fas fa-trash"></i> Hapus</button>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td><strong>2</strong></td>
                    <td><code>#TKT002</code></td>
                    <td>Permintaan upgrade paket</td>
                    <td>5 Mei 2024</td>
                    <td><span class="status closed">Selesai</span></td>
                    <td><span class="status open">Sedang</span></td>
                    <td>
                        <div class="action-buttons">
                            <button class="btn-action btn-view" onclick="showTicketDetail('#TKT002', 'Permintaan upgrade paket', '5 Mei 2024', 'Selesai', 'Sedang', 'Saya ingin mengupgrade paket internet saya dari 50 Mbps ke 100 Mbps. Mohon informasi mengenai biaya tambahan dan proses upgrade yang diperlukan.')">
                                <i class="fas fa-eye"></i> Lihat
                            </button>
                            <button class="btn-action btn-edit" onclick="window.location.href='{{ route('tiket.edit', 'TKT002') }}'"><i class="fas fa-edit"></i> Edit</button>
                            <button class="btn-action btn-delete"><i class="fas fa-trash"></i> Hapus</button>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td><strong>3</strong></td>
                    <td><code>#TKT003</code></td>
                    <td>Gangguan jaringan area Jakarta</td>
                    <td>8 Mei 2024</td>
                    <td><span class="status open">Terbuka</span></td>
                    <td><span class="status pending">Kritis</span></td>
                    <td>
                        <div class="action-buttons">
                            <button class="btn-action btn-view" onclick="showTicketDetail('#TKT003', 'Gangguan jaringan area Jakarta', '8 Mei 2024', 'Terbuka', 'Kritis', 'Terjadi gangguan jaringan massal di area Jakarta Selatan sejak pagi ini. Banyak pelanggan yang mengeluh tidak bisa mengakses internet sama sekali. Mohon segera ditindaklanjuti.')">
                                <i class="fas fa-eye"></i> Lihat
                            </button>
                            <button class="btn-action btn-edit" onclick="window.location.href='{{ route('tiket.edit', 'TKT003') }}'"><i class="fas fa-edit"></i> Edit</button>
                            <button class="btn-action btn-delete"><i class="fas fa-trash"></i> Hapus</button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- FOOTER -->
    <div class="table-footer">
        <div>Menampilkan <strong>1-3</strong> dari <strong>3</strong> entri</div>
        <div class="pagination">
            <button><i class="fas fa-chevron-left"></i> Sebelumnya</button>
            <button class="active">1</button>
            <button>Selanjutnya <i class="fas fa-chevron-right"></i></button>
        </div>
    </div>

</div>

<!-- Modal Detail Tiket -->
<div id="ticketModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3>
                <div class="modal-icon"><i class="fas fa-ticket-alt"></i></div>
                Detail Tiket
            </h3>
            <button class="close" onclick="closeModal()"><i class="fas fa-times"></i></button>
        </div>
        <div class="modal-body">
            <div class="detail-grid">
                <div class="detail-item">
                    <div class="detail-label">ID Tiket</div>
                    <div class="detail-value" id="modalTicketId"></div>
                </div>

                <div class="detail-item">
                    <div class="detail-label">Subjek</div>
                    <div class="detail-value" id="modalSubject"></div>
                </div>

                <div class="detail-item">
                    <div class="detail-label">Tanggal Dibuat</div>
                    <div class="detail-value" id="modalDate"></div>
                </div>

                <div class="detail-item">
                    <div class="detail-label">Status</div>
                    <div class="detail-value" id="modalStatus"></div>
                </div>

                <div class="detail-item">
                    <div class="detail-label">Prioritas</div>
                    <div class="detail-value" id="modalPriority"></div>
                </div>

                <div class="detail-item">
                    <div class="detail-label">Deskripsi Masalah</div>
                    <div class="detail-description" id="modalDescription"></div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary" onclick="closeModal()"><i class="fas fa-arrow-left"></i> Tutup</button>
            <button class="btn btn-primary"><i class="fas fa-edit"></i> Edit Tiket</button>
        </div>
    </div>
</div>

<script>
function showTicketDetail(id, subject, date, status, priority, description) {
    document.getElementById('modalTicketId').textContent = id;
    document.getElementById('modalSubject').textContent = subject;
    document.getElementById('modalDate').textContent = date;
    document.getElementById('modalStatus').innerHTML = `<span class="status ${status.toLowerCase() === 'terbuka' ? 'open' : 'closed'}">${status}</span>`;
    document.getElementById('modalPriority').innerHTML = `<span class="status ${priority.toLowerCase() === 'kritis' ? 'pending' : priority.toLowerCase() === 'tinggi' ? 'pending' : 'open'}">${priority}</span>`;
    document.getElementById('modalDescription').textContent = description;
    document.getElementById('ticketModal').style.display = 'block';
    document.body.style.overflow = 'hidden';
}

function closeModal() {
    document.getElementById('ticketModal').style.display = 'none';
    document.body.style.overflow = 'auto';
}

window.onclick = function(event) {
    const modal = document.getElementById('ticketModal');
    if (event.target == modal) {
        closeModal();
    }
}

// Keyboard support
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        closeModal();
    }
});
</script>

@endsection
