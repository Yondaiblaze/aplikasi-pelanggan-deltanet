<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - DeltaNet</title>
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
    </style>
</head>
<body>
    <div class="register-container">
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

        <form action="{{ route('register.post') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="name">Nama Lengkap</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required>
            </div>

            <div class="form-group">
                <label for="nomor">Masukan No WhatsApp</label>
                <div class="phone-input">
                    <select name="country_code" id="country_code" class="country-select">
                        <option value="+62">🇮🇩 +62</option>
                        <option value="+60">🇲🇾 +60</option>
                        <option value="+65">🇸🇬 +65</option>
                        <option value="+1">🇺🇸 +1</option>
                        <option value="+44">🇬🇧 +44</option>
                        <option value="+86">🇨🇳 +86</option>
                        <option value="+81">🇯🇵 +81</option>
                        <option value="+82">🇰🇷 +82</option>
                        <option value="+91">🇮🇳 +91</option>
                        <option value="+66">🇹🇭 +66</option>
                    </select>
                    <input type="tel" id="nomor" name="phone" placeholder="812345678" value="{{ old('nomor') }}" class="phone-number" required>
                </div>
                <div id="nomor-warning" class="warning-message">
                    Nomor WhatsApp hanya boleh berisi angka!
                </div>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>

           <div class="mb-3">
                <label class="form-label">Kode Referral (Opsional)</label>
                <input type="text" name="referred_by" class="form-control" placeholder="Contoh: AB123X">
                <small class="text-muted">Masukkan kode teman jika ada untuk mendapatkan promo.</small>
            </div>

            <button type="submit" class="register-btn">Register</button>
        </form>
    </div>

    <script>
        document.getElementById('nomor').addEventListener('input', function(e) {
            const value = e.target.value;
            const warning = document.getElementById('nomor-warning');

            // Remove non-numeric characters
            const numericValue = value.replace(/[^0-9]/g, '');

            if (value !== numericValue) {
                warning.style.display = 'block';
                e.target.value = numericValue;
            } else {
                warning.style.display = 'none';
            }
        });
    </script>
</body>
</html>
