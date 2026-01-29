<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    </style>
</head>
<body>
    <div class="login-container">
        <div class="logo">
            <h1>Delta<span>Net</span></h1>
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
        
        <form action="{{ route('login.post') }}" method="POST">
            @csrf
            
           <div class="form-group">
    <label for="nomor">Nomor</label>
    <input type="tel" id="nomor" name="nomor" value="{{ old('nomor') }}" required>
</div>

            
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            
            <button type="submit" class="login-btn">Login</button>
        </form>
        
        <div style="margin-top: 15px; text-align: center;">
            <p style="color: #666; font-size: 14px;"><a href="{{ route('forgot') }}" style="color: #3b82f6; text-decoration: none;">Lupa Password? (WhatsApp)</a></p>
        </div>
        
        <div style="margin-top: 20px; text-align: center;">
            <p style="color: #666; font-size: 14px;">Belum punya akun? <a href="{{ route('register') }}" style="color: #3b82f6; text-decoration: none;">Daftar di sini</a></p>
        </div>
    </div>
</body>
</html>