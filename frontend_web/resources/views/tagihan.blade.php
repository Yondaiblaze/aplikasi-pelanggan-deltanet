<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tagihan - DeltaNet</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }
        
        .dashboard-container {
            display: flex;
            min-height: 100vh;
        }
        
        .sidebar {
            width: 250px;
            background-color: #f8f9fa;
            padding: 0;
            border-right: 1px solid #e5e7eb;
        }
        
        .logo {
            text-align: left;
            padding: 20px;
            border-bottom: 1px solid #e5e7eb;
        }
        
        .logo h1 {
            color: #1e3a8a;
            font-size: 18px;
            font-weight: bold;
        }
        
        .logo span {
            color: #f59e0b;
        }
        
        .menu-item {
            padding: 12px 20px;
            color: #6b7280;
            cursor: pointer;
            font-size: 14px;
            background-color: transparent;
            border: none;
            width: 100%;
            text-align: left;
        }
        
        .menu-item:hover {
            background-color: #f3f4f6;
            color: #374151;
        }
        
        .menu-item.active {
            background-color: #3b82f6;
            color: #ffffff;
        }
        
        .main-content {
            flex: 1;
            padding: 0;
        }
        
        .header {
            background-color: #374151;
            color: white;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .header h2 {
            font-size: 18px;
        }
        
        .logout-btn {
            background-color: #dc2626;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }
        
        .content-area {
            padding: 20px;
            background-color: white;
            min-height: calc(100vh - 60px);
        }
        
        .tagihan-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 15px;
            margin-bottom: 20px;
        }
        
        .tagihan-card {
            background-color: #3b82f6;
            color: white;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
        }
        
        .tagihan-card h3 {
            font-size: 16px;
            margin-bottom: 10px;
        }
        
        .tagihan-card .amount {
            font-size: 24px;
            font-weight: bold;
        }
        
        .info-grid {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr;
            gap: 15px;
            margin-bottom: 20px;
        }
        
        .info-card {
            background-color: #e5e7eb;
            padding: 15px;
            border-radius: 8px;
        }
        
        .info-card h4 {
            color: #374151;
            margin-bottom: 10px;
        }
        
        .bottom-section {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 20px;
        }
        
        .table-section {
            background-color: #f9fafb;
            padding: 20px;
            border-radius: 8px;
        }
        
        .table-section h3 {
            color: #374151;
            margin-bottom: 15px;
        }
        
        .table-row {
            padding: 10px 0;
            border-bottom: 1px solid #e5e7eb;
            color: #666;
        }
        
        .chart-section {
            background-color: #f9fafb;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
        }
        
        .chart-section h3 {
            color: #374151;
            margin-bottom: 15px;
        }
        
        .chart-placeholder {
            width: 100px;
            height: 100px;
            background-color: #e5e7eb;
            border-radius: 50%;
            margin: 20px auto;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <div class="sidebar">
            <div class="logo">
                <h1>Delta<span>Net</span></h1>
            </div>
            
            <a href="{{ route('dashboard') }}" class="menu-item">Dashboard</a>
            <div class="menu-item">Pelanggan</div>
            <div class="menu-item">Layanan</div>
            <div class="menu-item">Laporan</div>
            <div class="menu-item active">Tagihan</div>
            <div class="menu-item">Pengaturan</div>
        </div>
        
        <div class="main-content">
            <div class="header">
                <h2>Tagihan</h2>
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="logout-btn">Logout</button>
                </form>
            </div>
            
            <div class="content-area">
                <div class="tagihan-grid">
                    <div class="tagihan-card">
                        <h3>Total Tagihan</h3>
                        <div class="amount">Rp 2.500.000</div>
                    </div>
                    <div class="tagihan-card">
                        <h3>Terbayar</h3>
                        <div class="amount">Rp 1.800.000</div>
                    </div>
                    <div class="tagihan-card">
                        <h3>Tertunggak</h3>
                        <div class="amount">Rp 700.000</div>
                    </div>
                    <div class="tagihan-card">
                        <h3>Bulan Ini</h3>
                        <div class="amount">Rp 350.000</div>
                    </div>
                </div>
                
                <div class="info-grid">
                    <div class="info-card">
                        <h4>Informasi Tagihan</h4>
                        <p>Status pembayaran dan detail tagihan pelanggan</p>
                    </div>
                    <div class="info-card">
                        <h4>Jatuh Tempo</h4>
                        <p>15 hari lagi</p>
                    </div>
                    <div class="info-card">
                        <h4>Metode Bayar</h4>
                        <p>Transfer Bank</p>
                    </div>
                </div>
                
                <div class="bottom-section">
                    <div class="table-section">
                        <h3>Riwayat Tagihan</h3>
                        <div class="table-row">Januari 2024 - Rp 350.000 - Lunas</div>
                        <div class="table-row">Februari 2024 - Rp 350.000 - Lunas</div>
                        <div class="table-row">Maret 2024 - Rp 350.000 - Tertunggak</div>
                        <div class="table-row">April 2024 - Rp 350.000 - Tertunggak</div>
                        <div class="table-row">Mei 2024 - Rp 350.000 - Pending</div>
                    </div>
                    
                    <div class="chart-section">
                        <h3>Status Pembayaran</h3>
                        <div class="chart-placeholder"></div>
                        <p style="color: #666;">72% Terbayar</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>