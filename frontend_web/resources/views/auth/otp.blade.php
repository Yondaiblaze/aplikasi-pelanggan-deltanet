<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
        
        .otp-info {
            margin-bottom: 30px;
            color: #666;
        }
        
        .otp-info h2 {
            color: #333;
            margin-bottom: 10px;
        }
        
        .otp-inputs {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-bottom: 30px;
        }
        
        .otp-input {
            width: 50px;
            height: 50px;
            text-align: center;
            font-size: 20px;
            border: 2px solid #ddd;
            border-radius: 8px;
            background: white;
        }
        
        .otp-input:focus {
            border-color: #3b82f6;
            outline: none;
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
            margin-bottom: 20px;
        }
        
        .verify-btn:hover {
            background-color: #2563eb;
        }
        
        .resend-section {
            color: #666;
            font-size: 14px;
        }
        
        .resend-btn {
            color: #3b82f6;
            text-decoration: none;
            cursor: pointer;
        }
        
        .resend-btn:hover {
            text-decoration: underline;
        }
        
        .timer {
            color: #f59e0b;
            font-weight: bold;
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
            <img src="{{ asset('deltanet-logo.png') }}" alt="DeltaNet Logo">
           
        </div>
        
        <div class="otp-info">
            <h2>Verifikasi OTP</h2>
            <p>Kode OTP telah dikirim ke nomor</p>
            <p><strong>{{ session('phone') ?? '+62812345678' }}</strong></p>
        </div>
        
        @if($errors->any())
            <div class="error-message">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif
        
        <form action="{{ route('otp.verify') }}" method="POST">
            @csrf
            <div class="otp-inputs">
                <input type="text" class="otp-input" maxlength="1" name="otp1" required>
                <input type="text" class="otp-input" maxlength="1" name="otp2" required>
                <input type="text" class="otp-input" maxlength="1" name="otp3" required>
                <input type="text" class="otp-input" maxlength="1" name="otp4" required>
                <input type="text" class="otp-input" maxlength="1" name="otp5" required>
                <input type="text" class="otp-input" maxlength="1" name="otp6" required>
            </div>
            
            <button type="submit" class="verify-btn">Verifikasi OTP</button>
        </form>
        
        <div class="resend-section">
            <p>Tidak menerima kode? <span class="timer" id="timer">60</span>s</p>
            <a href="#" class="resend-btn" id="resend-btn" style="display: none;">Kirim Ulang OTP</a>
        </div>
        
        <div style="margin-top: 20px;">
            <a href="{{ route('login') }}" style="color: #666; text-decoration: none; font-size: 14px;">← Kembali ke Login</a>
        </div>
    </div>
    
    <script>
        // Auto focus next input
        const otpInputs = document.querySelectorAll('.otp-input');
        otpInputs.forEach((input, index) => {
            input.addEventListener('input', function() {
                if (this.value.length === 1 && index < otpInputs.length - 1) {
                    otpInputs[index + 1].focus();
                }
            });
            
            input.addEventListener('keydown', function(e) {
                if (e.key === 'Backspace' && this.value === '' && index > 0) {
                    otpInputs[index - 1].focus();
                }
            });
        });
        
        // Timer countdown
        let timeLeft = 60;
        const timer = document.getElementById('timer');
        const resendBtn = document.getElementById('resend-btn');
        
        const countdown = setInterval(() => {
            timeLeft--;
            timer.textContent = timeLeft;
            
            if (timeLeft <= 0) {
                clearInterval(countdown);
                timer.parentElement.style.display = 'none';
                resendBtn.style.display = 'inline';
            }
        }, 1000);
        
        // Resend OTP
        resendBtn.addEventListener('click', function(e) {
            e.preventDefault();
            // Reset timer
            timeLeft = 60;
            timer.textContent = timeLeft;
            timer.parentElement.style.display = 'block';
            resendBtn.style.display = 'none';
            
            // Start countdown again
            const newCountdown = setInterval(() => {
                timeLeft--;
                timer.textContent = timeLeft;
                
                if (timeLeft <= 0) {
                    clearInterval(newCountdown);
                    timer.parentElement.style.display = 'none';
                    resendBtn.style.display = 'inline';
                }
            }, 1000);
            
            // Here you would make an AJAX call to resend OTP
            alert('OTP telah dikirim ulang!');
        });
    </script>
</body>
</html>