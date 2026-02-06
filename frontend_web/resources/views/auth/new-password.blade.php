<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Password Baru - DeltaNet</title>
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
        }
        .password-container {
            background-color: #e0e0e0;
            padding: 40px;
            border-radius: 10px;
            width: 400px;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .logo { margin-bottom: 30px; display: flex; justify-content: center; }
        .logo img { height: 40px; width: auto; }
        .info-text { color: #666; margin-bottom: 25px; font-size: 14px; }
        .form-group { margin-bottom: 20px; text-align: left; }
        .form-group label { display: block; margin-bottom: 5px; color: #666; font-size: 14px; font-weight: bold; }
        .password-wrapper { position: relative; }
        .password-wrapper input {
            width: 100%;
            padding: 12px 40px 12px 12px;
            border: none;
            border-radius: 5px;
            background-color: white;
            font-size: 14px;
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
        .submit-btn {
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
        }
        .submit-btn:hover { background-color: #2563eb; }
        .error-message { background-color: #fee2e2; color: #dc2626; padding: 10px; border-radius: 5px; margin-bottom: 20px; font-size: 14px; text-align: left; }
        .success-message { background-color: #d1fae5; color: #065f46; padding: 10px; border-radius: 5px; margin-bottom: 20px; font-size: 14px; }
    </style>
</head>
<body>
    <div class="password-container">
        <div class="logo">
            <img src="{{ asset('deltanet-logo.png') }}" alt="DeltaNet Logo">
        </div>

        <div class="info-text">
            <h3 style="color: #333; margin-bottom: 10px;">Buat Password Baru</h3>
            <p>Masukkan password baru untuk akun<br><strong>{{ session('otp_phone') }}</strong></p>
        </div>

        @if($errors->any())
            <div class="error-message">
                @foreach($errors->all() as $error)
                    <div>• {{ $error }}</div>
                @endforeach
            </div>
        @endif

        @if(session('success'))
            <div class="success-message">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('password.update') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="password">Password Baru</label>
                <div class="password-wrapper">
                    <input type="password" id="password" name="password" placeholder="Minimal 6 karakter" required autofocus>
                    <button type="button" class="toggle-password" onclick="togglePassword('password', this)">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
            </div>

            <div class="form-group">
                <label for="password_confirmation">Konfirmasi Password Baru</label>
                <div class="password-wrapper">
                    <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Ulangi password baru" required>
                    <button type="button" class="toggle-password" onclick="togglePassword('password_confirmation', this)">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
            </div>

            <button type="submit" class="submit-btn">Simpan Password Baru</button>
        </form>

        <div style="margin-top: 20px;">
            <a href="{{ route('login') }}" style="color: #666; text-decoration: none; font-size: 14px;">← Kembali ke Login</a>
        </div>
    </div>

    <script>
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

        // Validasi kecocokan password
        document.querySelector('form').addEventListener('submit', function(e) {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('password_confirmation').value;

            if (password !== confirmPassword) {
                e.preventDefault();
                alert('Konfirmasi password tidak cocok!');
                return false;
            }
        });
    </script>
</body>
</html>
