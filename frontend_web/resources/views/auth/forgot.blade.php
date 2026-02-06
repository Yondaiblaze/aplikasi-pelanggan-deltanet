<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Lupa Password - DeltaNet</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .forgot-container {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 12px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            text-align: center;
        }
        .logo img { height: 50px; margin-bottom: 20px; }
        .info-box {
            background-color: #eff6ff;
            color: #1e40af;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 25px;
            font-size: 14px;
            text-align: left;
            border-left: 4px solid #3b82f6;
        }
        .form-group { margin-bottom: 20px; text-align: left; }
        .form-group label { display: block; margin-bottom: 8px; color: #4b5563; font-weight: 600; font-size: 14px; }
        .phone-input { display: flex; gap: 8px; }
        .country-select {
            width: 90px;
            padding: 12px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            background-color: #f9fafb;
            font-size: 14px;
        }
        .phone-number {
            flex: 1;
            padding: 12px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 15px;
        }
        .forgot-btn {
            width: 100%;
            padding: 13px;
            background-color: #2563eb;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s;
        }
        .forgot-btn:hover { background-color: #1d4ed8; }
        .error-message { color: #dc2626; font-size: 13px; margin-top: 5px; }
        .success-message {
            background-color: #d1fae5;
            color: #065f46;
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 20px;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="forgot-container">
        <div class="logo">
            <img src="{{ asset('deltanet-logo.png') }}" alt="DeltaNet Logo">
        </div>

        <div class="info-box">
            <strong>Reset Kata Sandi via WhatsApp</strong><br>
            Masukkan nomor yang terdaftar. Kami akan mengirimkan kode OTP untuk verifikasi akun Anda.
        </div>

        @if(session('success'))
            <div class="success-message">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('forgot.post') }}" method="POST">
            @csrf <div class="form-group">
                <label for="whatsapp">Nomor WhatsApp Pelanggan</label>
                <div class="phone-input">
                    <select name="country_code" class="country-select">
                        <option value="+62">ID +62</option>
                        <option value="+60">MY +60</option>
                        <option value="+65">SG +65</option>
                    </select>
                    <input type="tel" id="whatsapp" name="whatsapp"
                           placeholder="812345678" class="phone-number"
                           value="{{ old('whatsapp') }}" required autofocus>
                </div>
                @error('whatsapp')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="forgot-btn">Kirim Kode OTP</button>
        </form>

        <div style="margin-top: 25px;">
            <a href="{{ route('login') }}" style="color: #6b7280; text-decoration: none; font-size: 14px;">
                ← Kembali ke Login
            </a>
        </div>
    </div>

    <script>
        // Script untuk membersihkan input nomor HP (hapus angka 0 di depan)
        document.getElementById('whatsapp').addEventListener('input', function(e) {
            let value = e.target.value.replace(/[^0-9]/g, ''); // Hanya angka
            value = value.replace(/^0+/, ''); // Hapus 0 di depan agar format +628... konsisten
            e.target.value = value;
        });
    </script>
</body>
</html>
