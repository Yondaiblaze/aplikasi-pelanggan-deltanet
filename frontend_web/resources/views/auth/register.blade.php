<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Register - DeltaNet</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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

        .register-container {
            background-color: #e0e0e0;
            padding: 40px;
            border-radius: 10px;
            width: 400px;
            text-align: center;
        }

        .logo {
            margin-bottom: 30px;
            display: flex;
            justify-content: center;
        }

        .logo img {
            height: 40px;
        }

        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }

        .form-group label {
            display: block;
            margin-bottom: 6px;
            color: #555;
            font-size: 14px;
        }

        .required {
            color: #dc2626;
            font-size: 12px;
            margin-left: 3px;
        }

        .phone-input {
            display: flex;
            gap: 6px;
        }

        .country-select {
            width: 80px;
            padding: 12px 8px;
            border: none;
            border-radius: 5px;
            background: #fff;
            font-size: 12px;
        }

        .form-group input,
        .phone-number {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 5px;
            background: #fff;
            font-size: 14px;
        }

        .register-btn {
            width: 100%;
            padding: 12px;
            background-color: #3b82f6;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 10px;
        }

        .register-btn:hover {
            background-color: #2563eb;
        }

        .warning-message {
            background-color: #fef3c7;
            color: #d97706;
            padding: 8px;
            border-radius: 5px;
            margin-top: 5px;
            font-size: 12px;
            display: none;
        }

        .password-wrapper {
            position: relative;
        }

        .password-wrapper input {
            padding-right: 40px;
        }

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
    </style>
</head>
<body>

<div class="register-container">
    <div class="logo">
        <img src="{{ asset('deltanet-logo.png') }}" alt="DeltaNet Logo">
    </div>

    <form action="{{ route('register.post') }}" method="POST">
        @csrf

        <!-- Nama -->
        <div class="form-group">
            <label for="name">
                Nama Lengkap <span class="required">*</span>
            </label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required>
        </div>

        <!-- Nomor -->
        <div class="form-group">
            <label for="nomor">
                Nomor WhatsApp <span class="required">*</span>
            </label>
            <div class="phone-input">
                <select name="country_code" class="country-select">
                    <option value="+62">ID +62</option>
                    <option value="+60">MY +60</option>
                    <option value="+65">SG +65</option>
                </select>
                <input type="tel" id="nomor" name="nomor" class="phone-number"
                       placeholder="812345678" value="{{ old('nomor') }}" required>
            </div>
            <div id="nomor-warning" class="warning-message">
                Nomor WhatsApp hanya boleh berisi angka!
            </div>
        </div>

        <!-- Password -->
        <div class="form-group">
            <label for="password">
                Kata Sandi <span class="required">*</span>
            </label>
            <div class="password-wrapper">
                <input type="password" id="password" name="password" required>
                <button type="button" class="toggle-password"
                        onclick="togglePassword('password', this)">
                    <i class="fas fa-eye"></i>
                </button>
            </div>
        </div>

        <!-- Konfirmasi Password -->
        <div class="form-group">
            <label for="password_confirmation">
                Konfirmasi Kata Sandi <span class="required">*</span>
            </label>
            <div class="password-wrapper">
                <input type="password" id="password_confirmation"
                       name="password_confirmation" required>
                <button type="button" class="toggle-password"
                        onclick="togglePassword('password_confirmation', this)">
                    <i class="fas fa-eye"></i>
                </button>
            </div>
        </div>

        <!-- Referral (tidak wajib) -->
        <div class="form-group">
            <label for="referral">
                Kode Referral Teman Anda
            </label>
            <input type="text" id="referral" name="referral"
                   value="{{ old('referral') }}" placeholder="Contoh: REF123456">
        </div>

        <button type="submit" class="register-btn">Register</button>
    </form>
</div>

<script>
    document.getElementById('nomor').addEventListener('input', function (e) {
        let value = e.target.value.replace(/[^0-9]/g, '').replace(/^0+/, '');
        e.target.value = value;
        document.getElementById('nomor-warning').style.display =
            value ? 'none' : 'block';
    });

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
    
    // Handle form submission with validation
    document.querySelector('form').addEventListener('submit', function(e) {
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('password_confirmation').value;
        
        if (password !== confirmPassword) {
            e.preventDefault();
            if (typeof showMessage === 'function') {
                showMessage('Konfirmasi password tidak cocok!', 'error');
            } else {
                alert('Konfirmasi password tidak cocok!');
            }
            return false;
        }
    });
</script>

</body>
</html>
