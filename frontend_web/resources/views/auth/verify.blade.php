<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi OTP - DeltaNet</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f5f5f5; display: flex; justify-content: center; align-items: center; min-height: 100vh; margin: 0; }
        .otp-container { background-color: #e0e0e0; padding: 40px; border-radius: 10px; width: 400px; text-align: center; }
        .logo h1 { color: #1e3a8a; margin-bottom: 20px; }
        .form-group { margin-bottom: 20px; text-align: left; }
        .form-group label { display: block; margin-bottom: 8px; color: #666; font-size: 14px; }
        .otp-input { width: 100%; padding: 12px; border: none; border-radius: 5px; font-size: 20px; text-align: center; letter-spacing: 5px; }
        .verify-btn { width: 100%; padding: 12px; background-color: #10b981; color: white; border: none; border-radius: 5px; font-size: 16px; cursor: pointer; }
        .verify-btn:hover { background-color: #059669; }
        .info { font-size: 13px; color: #666; margin-bottom: 20px; }
        .error-message { background-color: #fee2e2; color: #dc2626; padding: 10px; border-radius: 5px; margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="otp-container">
        <div class="logo"><h1>Delta<span>Net</span></h1></div>

        @if($errors->any())
            <div class="error-message">{{ $errors->first() }}</div>
        @endif

        <div class="info">
            Masukkan 6 digit kode OTP yang dikirim ke nomor:<br>
            <strong>{{ session('otp_phone') }}</strong>
        </div>

        <form action="{{ route('otp.verify.post') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="otp_code">Kode OTP</label>
                <input type="text" id="otp_code" name="otp_code" maxlength="6" placeholder="000000" class="otp-input" required autofocus>
            </div>
            <button type="submit" class="verify-btn">Verifikasi Kode</button>
        </form>
    </div>
</body>
</html>
