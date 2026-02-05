<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Lupa Password - DeltaNet</title>
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
        
        .forgot-container {
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
        
        .forgot-btn {
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
        
        .forgot-btn:hover {
            background-color: #2563eb;
        }
        
        .success-message {
            background-color: #d1fae5;
            color: #065f46;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        
        .info-box {
            background-color: #dbeafe;
            color: #1e40af;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            font-size: 14px;
            text-align: left;
        }
    </style>
</head>
<body>
    <div class="forgot-container">
        <div class="logo">
            <img src="{{ asset('deltanet-logo.png') }}" alt="DeltaNet Logo">
           
        </div>
        
        <div class="info-box">
            <strong> Reset Kata Sandi Melalui WhatsApp</strong><br>
            Masukkan nomor Anda, kami akan mengirimkan kode otp Kata Sandi melalui WhatsApp.
        </div>
        
        @if(session('success'))
            <div class="success-message">
                {{ session('success') }}
            </div>
        @endif
        
        <form action="{{ route('forgot.post') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label for="whatsapp">Nomor WhatsApp</label>
                <div class="phone-input">
                    <select name="country_code" id="country_code" class="country-select">
                        <option value="+62">ID +62</option>
                        <option value="+60">MY +60</option>
                        <option value="+65">SG +65</option>
                        <option value="+1">US +1</option>
                        <option value="+44">GB +44</option>
                        <option value="+86">CN +86</option>
                        <option value="+81">JP +81</option>
                        <option value="+82">KR +82</option>
                        <option value="+91">IN +91</option>
                        <option value="+66">TH +66</option>
                    </select>
                    <input type="tel" id="whatsapp" name="whatsapp" placeholder="812345678" class="phone-number" required>
                </div>
            </div>
            
            <button type="submit" class="forgot-btn">Kirim Link Reset</button>
        </form>
        
        <div style="margin-top: 20px; text-align: center;">
            <a href="{{ route('login') }}" style="color: #666; text-decoration: none; font-size: 14px;">← Kembali ke Login</a>
        </div>
    </div>
    <script>
        document.getElementById('whatsapp').addEventListener('input', function(e) {
            const value = e.target.value;
            
            // Remove non-numeric characters
            let numericValue = value.replace(/[^0-9]/g, '');
            
            // Remove leading zeros
            numericValue = numericValue.replace(/^0+/, '');
            
            if (value !== numericValue) {
                e.target.value = numericValue;
            }
        });
    </script>
</body>
</html>