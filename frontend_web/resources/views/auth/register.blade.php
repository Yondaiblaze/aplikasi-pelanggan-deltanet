<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Register - DeltaNet</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .register-container {
            background-color: #e0e0e0;
            padding: 40px;
            border-radius: 10px;
            width: 100%;
            max-width: 420px;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .logo { margin-bottom: 25px; display: flex; justify-content: center; }
        .logo img { height: 40px; width: auto; }

        .form-group { margin-bottom: 18px; text-align: left; }
        .form-group label { display: block; margin-bottom: 6px; color: #555; font-size: 14px; font-weight: bold; }

        .required { color: #dc2626; margin-left: 3px; }

        .phone-input { display: flex; gap: 6px; }
        .country-select {
            width: 85px;
            padding: 12px 5px;
            border: none;
            border-radius: 5px;
            background: #fff;
            font-size: 12px;
        }

        .form-group input, .phone-number {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 5px;
            background: #fff;
            font-size: 14px;
        }

        .register-btn {
            width: 100%;
            padding: 13px;
            background-color: #3b82f6;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            margin-top: 10px;
        }

        .register-btn:hover { background-color: #2563eb; }

        /* Style Error & Warning */
        .error-box { background-color: #fee2e2; color: #dc2626; padding: 10px; border-radius: 5px; margin-bottom: 20px; font-size: 13px; text-align: left; }
        .warning-message { background-color: #fef3c7; color: #d97706; padding: 8px; border-radius: 5px; margin-top: 5px; font-size: 12px; display: none; }

        .password-wrapper { position: relative; }
        .password-wrapper input { padding-right: 40px; }
        .toggle-password {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #6b7280;
            cursor: pointer;
        }

        .footer-link { margin-top: 20px; font-size: 14px; color: #666; }
        .footer-link a { color: #3b82f6; text-decoration: none; font-weight: bold; }
    </style>
</head>
<body>

<div class="register-container">
    <div class="logo">
        <img src="{{ asset('deltanet-logo.png') }}" alt="DeltaNet Logo">
    </div>

    {{-- Tampilkan Error dari Backend --}}
    @if($errors->any())
        <div class="error-box">
            @foreach($errors->all() as $error)
                <div>• {{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form action="{{ route('register.post') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">Nama Lengkap <span class="required">*</span></label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Contoh: Daiva" required autofocus>
        </div>

        <div class="form-group">
            <label for="nomor">Nomor WhatsApp <span class="required">*</span></label>
            <div class="phone-input">
                <select name="country_code" class="country-select">
                    <option value="+62">ID +62</option>
                    <option value="+60">MY +60</option>
                    <option value="+65">SG +65</option>
                </select>
                <input type="tel" id="nomor" name="contact" class="phone-number"
                       placeholder="812345678" value="{{ old('contact') }}" required>
            </div>
            <div id="nomor-warning" class="warning-message">
                Nomor WhatsApp hanya boleh berisi angka!
            </div>
        </div>

        <div class="form-group">
            <label for="password">Kata Sandi <span class="required">*</span></label>
            <div class="password-wrapper">
                <input type="password" id="password" name="password" placeholder="Minimal 8 karakter" required>
                <button type="button" class="toggle-password" onclick="togglePassword('password', this)">
                    <i class="fas fa-eye"></i>
                </button>
            </div>
        </div>

        <div class="form-group">
            <label for="password_confirmation">Konfirmasi Kata Sandi <span class="required">*</span></label>
            <div class="password-wrapper">
                <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Ulangi kata sandi" required>
                <button type="button" class="toggle-password" onclick="togglePassword('password_confirmation', this)">
                    <i class="fas fa-eye"></i>
                </button>
            </div>
        </div>

        <div class="form-group">
    <label for="referral">Kode Referral</label>
    <input type="text" id="referral" name="referral_code"
           value="{{ old('referral_code') }}"
           placeholder="Contoh: REF123456"
           style="border: 2px solid #000; border-radius: 8px; padding: 15px;">

        <button type="submit" class="register-btn">Daftar Akun</button>
    </form>

    <div class="footer-link">
        Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a>
    </div>
</div>

<script>
    // Logic 1: Bersihkan input nomor HP (Hanya angka & hapus 0 di depan)
    document.getElementById('nomor').addEventListener('input', function (e) {
        let originalValue = e.target.value;
        let cleanedValue = originalValue.replace(/[^0-9]/g, '').replace(/^0+/, '');

        e.target.value = cleanedValue;

        // Munculkan warning jika user mengetik karakter non-angka atau angka 0 di depan
        document.getElementById('nomor-warning').style.display =
            (originalValue !== cleanedValue && originalValue !== "") ? 'block' : 'none';
    });

    // Logic 2: Toggle Show/Hide Password
    function togglePassword(id, btn) {
        const input = document.getElementById(id);
        const icon = btn.querySelector('i');
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.replace('fa-eye', 'fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.replace('fa-eye-slash', 'fa-eye');
        }
    }

    // Logic 3: Validasi kecocokan password sebelum kirim ke server
    document.querySelector('form').addEventListener('submit', function(e) {
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('password_confirmation').value;

        if (password !== confirmPassword) {
            e.preventDefault();
            alert('Konfirmasi kata sandi tidak cocok!');
            return false;
        }
    });
</script>

</body>
</html>
