<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi OTP - DeltaNet</title>
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
        
        .otp-container {
            background-color: #e0e0e0;
            padding: 40px;
            border-radius: 10px;
            width: 400px;
            text-align: center;
        }
        
        .logo {
            margin-bottom: 30px;
            padding: 10px 20px;
            border: 2px solid #3b82f6;
            border-radius: 5px;
            display: inline-block;
        }
        
        .logo h1 {
            color: #1e3a8a;
            font-size: 20px;
            font-weight: bold;
        }
        
        .logo span {
            color: #f59e0b;
        }
        
        .info-text {
            color: #666;
            font-size: 14px;
            margin-bottom: 20px;
            text-align: center;
        }
        
        .phone-display {
            background-color: #6b7280;
            color: white;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            font-size: 14px;
        }
        
        .otp-label {
            color: #666;
            font-size: 14px;
            margin-bottom: 10px;
            text-align: left;
        }
        
        .otp-inputs {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-bottom: 20px;
        }
        
        .otp-input {
            width: 50px;
            height: 50px;
            border: none;
            border-radius: 5px;
            background-color: white;
            text-align: center;
            font-size: 18px;
            font-weight: bold;
        }
        
        .verify-btn {
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
        
        .verify-btn:hover {
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
    <div class="otp-container">
        <div class="logo">
            <h1>Delta<span>Net</span></h1>
        </div>
        
        <div class="info-text">
            Kode OTP telah dikirim ke nomor WhatsApp Anda
        </div>
        
        <div class="phone-display">
            +62 {{ session('whatsapp', '8xxxxxxxxxx') }}
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
        
        <form action="{{ route('otp.verify') }}" method="POST">
            @csrf
            
            <div class="otp-label">Masukkan Kode OTP:</div>
            
            <div class="otp-inputs">
                <input type="text" class="otp-input" name="otp1" maxlength="1" pattern="[0-9]" inputmode="numeric" oninput="this.value = this.value.replace(/[^0-9]/g, ''); moveToNext(this, 'otp2')" required>
                <input type="text" class="otp-input" name="otp2" maxlength="1" pattern="[0-9]" inputmode="numeric" oninput="this.value = this.value.replace(/[^0-9]/g, ''); moveToNext(this, 'otp3')" required>
                <input type="text" class="otp-input" name="otp3" maxlength="1" pattern="[0-9]" inputmode="numeric" oninput="this.value = this.value.replace(/[^0-9]/g, ''); moveToNext(this, 'otp4')" required>
                <input type="text" class="otp-input" name="otp4" maxlength="1" pattern="[0-9]" inputmode="numeric" oninput="this.value = this.value.replace(/[^0-9]/g, ''); moveToNext(this, 'otp5')" required>
                <input type="text" class="otp-input" name="otp5" maxlength="1" pattern="[0-9]" inputmode="numeric" oninput="this.value = this.value.replace(/[^0-9]/g, ''); moveToNext(this, 'otp6')" required>
                <input type="text" class="otp-input" name="otp6" maxlength="1" pattern="[0-9]" inputmode="numeric" oninput="this.value = this.value.replace(/[^0-9]/g, '')" required>
            </div>
            
            <button type="submit" class="verify-btn">Verifikasi</button>
        </form>
        
        <div style="margin-top: 20px; text-align: center;">
            <p style="color: #666; font-size: 14px;"><a href="{{ route('forgot') }}" style="color: #3b82f6; text-decoration: none;">Kirim Ulang OTP</a></p>
        </div>
    </div>
    
    <script>
        function moveToNext(current, nextFieldId) {
            if (current.value.length >= current.maxLength) {
                const nextField = document.getElementsByName(nextFieldId)[0];
                if (nextField) {
                    nextField.focus();
                }
            }
        }
    </script>
</body>
</html>