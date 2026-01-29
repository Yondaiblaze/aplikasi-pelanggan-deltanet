<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - DeltaNet</title>
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
            padding: 20px;
        }
        
        .header {
            background-color: white;
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
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
        
        .content-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }
        
        .card {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .card-large {
            background-color: #93c5fd;
            height: 200px;
            border: 2px solid #3b82f6;
        }
        
        .card-small {
            background-color: #e5e7eb;
            height: 120px;
        }
        
        .bottom-section {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 20px;
        }
        
        .table-section {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .chart-section {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            text-align: center;
        }
        
        .chart-circle {
            width: 120px;
            height: 120px;
            border: 15px solid #e5e7eb;
            border-top: 15px solid #6b7280;
            border-radius: 50%;
            margin: 20px auto;
        }
        
        .table-row {
            padding: 10px 0;
            border-bottom: 1px solid #e5e7eb;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <div class="sidebar">
            <div class="logo">
                <h1>Delta<span>Net</span></h1>
            </div>
            
            <a href="{{ route('dashboard') }}" class="menu-item active">Dashboard</a>
            <div class="menu-item">Pelanggan</div>
            <div class="menu-item">Layanan</div>
            <div class="menu-item">Laporan</div>
            <a href="{{ route('tagihan') }}" class="menu-item">Tagihan</a>
            <div class="menu-item">Pengaturan</div>
        </div>
        
        <div class="main-content">
            <div class="header">
                <h2>Dashboard</h2>
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="logout-btn">Logout</button>
                </form>
            </div>
            
            <div class="content-grid">
                <div class="card card-large"></div>
                <div class="card card-small"></div>
            </div>
            
            <div class="bottom-section">
                <div class="table-section">
                    <h3 style="margin-bottom: 15px; color: #374151;">Data Pelanggan</h3>
                    <div class="table-row">Pelanggan 1 - Status Aktif</div>
                    <div class="table-row">Pelanggan 2 - Status Aktif</div>
                    <div class="table-row">Pelanggan 3 - Status Pending</div>
                    <div class="table-row">Pelanggan 4 - Status Aktif</div>
                    <div class="table-row">Pelanggan 5 - Status Nonaktif</div>
                </div>
                
                <div class="chart-section">
                    <h3 style="margin-bottom: 15px; color: #374151;">Statistik</h3>
                    <div class="chart-circle"></div>
                    <p style="color: #666;">Total Pelanggan: 150</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>