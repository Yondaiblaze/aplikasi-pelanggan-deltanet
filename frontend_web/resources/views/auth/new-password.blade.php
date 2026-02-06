<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Password Baru - DeltaNet</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .password-container {
            background-color: #e0e0e0;
            padding: 40px;
            border-radius: 10px;
            width: 400px;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .logo {
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .logo img {
            height: 40px;
            width: auto;
        }

        .logo h1 {
            color: #1e3a8a;
            font-size: 24px;
            font-weight: bold;
        }

        .logo span {
            color: #f59e0b;
        }

        .info-text {
            color: #555;
            font-size: 14px;
            margin-bottom: 25px;
            line-height: 1.4;
        }

        .form-group {
            margin-bottom: 18px;
            text-align: left;
        }

        .form-group label {
            display: block;
            margin-bottom: 6px;
            color: #444;
            font-size: 14px;
            font-weight: 600;
        }

        .form-group input {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            background-color: white;
        }

        .form-group input:focus {
            outline: 2px solid #3b82f6;
        }

        .save-btn {
            width: 100%;
            padding: 12px;
            background-color: #3b82f6;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            margin-top: 10px;
            transition: background 0.3s;
        }

        .save-btn:hover {
            background-color: #2563eb;
        }

        .success-message {
            background-color: #d1fae5;
            color: #065f46;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .error-message {
            background-color: #fee2e2;
            color: #dc2626;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            text-align: left;
            font-size: 13px;
        }
    </style>
</head>
<body>
    <div class="password-container">
        <div class="logo">
            <img src="{{ asset('deltanet-logo.png') }}" alt="DeltaNet Logo">
            <h1>Delta<span>Net</span></h1>
        </div>

        <div class="info-text">
            <strong>Verifikasi Berhasil!</strong><br>
            Silakan buat password baru yang kuat untuk akun Anda.
        </div>

        {{-- Tampilkan Pesan Sukses --}}
        @if(session('success'))
            <div class="success-message">
                {{ session('success') }}
            </div>
        @endif

        {{-- Tampilkan Error Validasi (Misal: Password kurang dari 8 karakter) --}}
        @if($errors->any())
            <div class="error-message">
                @foreach($errors->all() as $error)
                    <div>• {{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form action="{{ route('password.update') }}" method="POST">
            @csrf

            {{-- Token ini sangat penting untuk keamanan proses reset --}}
            <input type="hidden" name="token" value="{{ $token ?? session('reset_token') }}">
            {{-- Kita juga kirimkan nomor HP/kontak agar backend tahu siapa yang diupdate --}}
            <input type="hidden" name="contact" value="{{ session('otp_phone') }}">

            <div class="form-group">
                <label for="password">Password Baru</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Minimal 8 karakter"
                    required
                    autofocus
                >
            </div>

            <div class="form-group">
                <label for="password_confirmation">Konfirmasi Password</label>
                <input
                    type="password"
                    id="password_confirmation"
                    name="password_confirmation"
                    placeholder="Ulangi password baru"
                    required
                >
            </div>

            <button type="submit" class="save-btn">
                Simpan Password Baru
            </button>
        </form>

        <div style="margin-top: 20px; text-align: center;">
            <a href="{{ route('login') }}" style="color: #666; text-decoration: none; font-size: 13px;">
                Batal dan kembali ke Login
            </a>
        </div>
    </div>
</body>
</html>
