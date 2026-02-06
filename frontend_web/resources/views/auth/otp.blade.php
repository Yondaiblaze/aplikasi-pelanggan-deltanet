<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Verifikasi OTP - DeltaNet</title>
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

        .otp-container {
            background-color: #e0e0e0;
            padding: 40px;
            border-radius: 10px;
            width: 400px;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .logo { margin-bottom: 30px; display: flex; align-items: center; justify-content: center; gap: 10px; }
        .logo img { height: 40px; width: auto; }

        .otp-info { margin-bottom: 30px; color: #666; }
        .otp-info h2 { color: #333; margin-bottom: 10px; }

        .otp-inputs {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-bottom: 30px;
        }

        .otp-input {
            width: 45px;
            height: 50px;
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            border: 2px solid #ddd;
            border-radius: 8px;
            background: white;
        }

        .otp-input:focus {
            border-color: #3b82f6;
            outline: none;
            box-shadow: 0 0 5px rgba(59, 130, 246, 0.5);
        }

        .verify-btn {
            width: 100%;
            padding: 12px;
            background-color: #3b82f6;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            margin-bottom: 20px;
        }

        .verify-btn:hover { background-color: #2563eb; }

        .resend-section { color: #666; font-size: 14px; }
        .resend-btn { color: #3b82f6; text-decoration: none; cursor: pointer; font-weight: bold; }
        .timer { color: #f59e0b; font-weight: bold; }

        .error-message {
            background-color: #fee2e2;
            color: #dc2626;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            font-size: 14px;
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
            <p>Kode OTP telah dikirim ke nomor WhatsApp</p>
            {{-- Mengambil nomor HP dari session agar dinamis --}}
            <p><strong>{{ session('otp_phone') ?? '+628**********' }}</strong></p>
        </div>

        {{-- Menampilkan pesan error jika kode OTP salah --}}
        @if($errors->any())
            <div class="error-message">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form action="{{ route('otp.verify') }}" method="POST" id="otp-form">
            @csrf
            {{-- Input tersembunyi untuk menggabungkan 6 digit menjadi 1 string --}}
            <input type="hidden" name="otp" id="full-otp">

            <div class="otp-inputs">
                <input type="text" class="otp-input" maxlength="1" pattern="\[0-9]*" inputmode="numeric" required>
                <input type="text" class="otp-input" maxlength="1" pattern="\[0-9]*" inputmode="numeric" required>
                <input type="text" class="otp-input" maxlength="1" pattern="\[0-9]*" inputmode="numeric" required>
                <input type="text" class="otp-input" maxlength="1" pattern="\[0-9]*" inputmode="numeric" required>
                <input type="text" class="otp-input" maxlength="1" pattern="\[0-9]*" inputmode="numeric" required>
                <input type="text" class="otp-input" maxlength="1" pattern="\[0-9]*" inputmode="numeric" required>
            </div>

            <button type="submit" class="verify-btn">Verifikasi Sekarang</button>
        </form>

        <div class="resend-section">
            <p id="timer-text">Tidak menerima kode? Kirim ulang dalam <span class="timer" id="timer">60</span>s</p>
            <form action="{{ route('otp.resend') }}" method="POST" id="resend-form" style="display: none;">
                @csrf
                <button type="submit" class="resend-btn" style="background:none; border:none; padding:0; font-family:inherit;">Kirim Ulang OTP</button>
            </form>
        </div>

        <div style="margin-top: 25px; border-top: 1px solid #ccc; padding-top: 15px;">
            <a href="{{ route('login') }}" style="color: #666; text-decoration: none; font-size: 13px;">← Kembali ke Login</a>
        </div>
    </div>

    <script>
        const otpInputs = document.querySelectorAll('.otp-input');
        const fullOtpInput = document.getElementById('full-otp');
        const otpForm = document.getElementById('otp-form');

        // Logic 1: Auto-focus dan Penggabungan Kode
        otpInputs.forEach((input, index) => {
            input.addEventListener('input', function() {
                if (this.value.length === 1 && index < otpInputs.length - 1) {
                    otpInputs[index + 1].focus();
                }
                combineOtp();
            });

            input.addEventListener('keydown', function(e) {
                if (e.key === 'Backspace' && this.value === '' && index > 0) {
                    otpInputs[index - 1].focus();
                }
            });
        });

        function combineOtp() {
            let combined = "";
            otpInputs.forEach(input => combined += input.value);
            fullOtpInput.value = combined;
        }

        // Logic 2: Timer Countdown
        let timeLeft = 60;
        const timerSpan = document.getElementById('timer');
        const timerText = document.getElementById('timer-text');
        const resendForm = document.getElementById('resend-form');

        const countdown = setInterval(() => {
            timeLeft--;
            timerSpan.textContent = timeLeft;

            if (timeLeft <= 0) {
                clearInterval(countdown);
                timerText.style.display = 'none';
                resendForm.style.display = 'block';
            }
        }, 1000);
    </script>
</body>
</html>
