<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - DeltaNet</title>
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
        
        .login-container {
            background-color: #e0e0e0;
            padding: 40px;
            border-radius: 10px;
            width: 400px;
            text-align: center;
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
        
        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #666;
            font-size: 14px;
        }
        
        .phone-input {
            display: flex;
            gap: 5px;
        }
        
        .country-select {
            width: 80px;
            padding: 12px 8px;
            border: none;
            border-radius: 5px;
            background-color: white;
            font-size: 12px;
        }
        
        .phone-number {
            flex: 1;
            padding: 12px;
            border: none;
            border-radius: 5px;
            background-color: white;
            font-size: 14px;
        }
        
        .form-group input {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 5px;
            background-color: white;
            font-size: 14px;
        }
        
        .login-btn {
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
        
        .login-btn:hover {
            background-color: #2563eb;
        }
        
        .success-message {
            background-color: #d1fae5;
            color: #065f46;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        
        .error-message {
            background-color: #fee2e2;
            color: #dc2626;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
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
        
        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 20px;
            text-align: left;
        }
        
        .checkbox-group input[type="checkbox"] {
            width: auto;
            margin: 0;
        }
        
        .checkbox-group label {
            font-size: 14px;
            color: #666;
            cursor: pointer;
        }
            color: #1e40af;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="logo">
            <img src="{{ asset('deltanet-logo.png') }}" alt="DeltaNet Logo">
            
        </div>
        
       
        
        @if(session('success'))
            <div class="success-message">
                {{ session('success') }}
            </div>
        @endif
        
        @if($errors->any())
            <div class="error-message">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif
        
        <form action="{{ route('login.send-otp') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label for="phone">Nomor WhatsApp</label>
                <div class="phone-input">
                    <select name="country_code" id="country_code" class="country-select">
                        <option value="+62">ID +62</option>
                        <option value="+60">MY  +60</option>
                        <option value="+65">SG +65</option>
                        <option value="+1">US +1</option>
                        <option value="+44">GB +44</option>
                        <option value="+86">CN +86</option>
                        <option value="+81">JP +81</option>
                        <option value="+82">KR +82</option>
                        <option value="+91">IN +91</option>
                        <option value="+66">TH +66</option>
                    </select>
                    <input type="tel" id="phone" name="phone" placeholder="812345678" value="{{ old('phone') }}" class="phone-number" required>
                </div>
                <div id="phone-warning" class="warning-message">
                    Nomor WhatsApp hanya boleh berisi angka!
                </div>
            </div>

            <div class="form-group">
                <label for="password">Kata Sandi</label>
                <input type="password" id="password" name="password" required>
            </div>
            
            <div class="checkbox-group">
                <input type="checkbox" id="remember" name="remember">
                <label for="remember">Ingatkan Saya</label>
            </div>
            
            <button type="submit" class="login-btn">Kirim OTP & Login</button>
        </form>
        
        <div style="margin-top: 15px; text-align: center;">
            <p style="color: #666; font-size: 14px;"><a href="{{ route('forgot') }}" style="color: #3b82f6; text-decoration: none;">Lupa Kata Sandi? (WhatsApp)</a></p>
        </div>
        
        <div style="margin-top: 20px; text-align: center;">
            <p style="color: #666; font-size: 14px;">Belum punya akun? <a href="{{ route('register') }}" style="color: #3b82f6; text-decoration: none;">Daftar di sini</a></p>
        </div>
    </div>
    
    <script>
        document.getElementById('phone').addEventListener('input', function(e) {
            const value = e.target.value;
            const warning = document.getElementById('phone-warning');
            
            // Remove non-numeric characters
            let numericValue = value.replace(/[^0-9]/g, '');
            
            // Remove leading zeros
            numericValue = numericValue.replace(/^0+/, '');
            
            if (value !== numericValue) {
                warning.style.display = 'block';
                warning.textContent = numericValue === '' ? 'Nomor telepon tidak boleh dimulai dengan 0!' : 'Nomor telepon hanya boleh berisi angka!';
                e.target.value = numericValue;
            } else {
                warning.style.display = 'none';
            }
        });
    </script>
</body>
</html>