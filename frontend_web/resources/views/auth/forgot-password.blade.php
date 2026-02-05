<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password - DeltaNet</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background-color: #f5f5f5; display: flex; justify-content: center; align-items: center; min-height: 100vh; }
        .forgot-container { background-color: #e0e0e0; padding: 40px; border-radius: 10px; width: 400px; text-align: center; }
        .logo h1 { color: #1e3a8a; font-size: 24px; font-weight: bold; margin-bottom: 30px; }
        .logo span { color: #f59e0b; }
        .form-group { margin-bottom: 20px; text-align: left; }
        .form-group label { display: block; margin-bottom: 5px; color: #666; font-size: 14px; }
        .form-group input { width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 5px; background-color: white; font-size: 14px; }
        .forgot-btn { width: 100%; padding: 12px; background-color: #3b82f6; color: white; border: none; border-radius: 5px; font-size: 16px; cursor: pointer; margin-top: 10px; }
        .forgot-btn:hover { background-color: #2563eb; }
        .info-text { color: #666; font-size: 14px; margin-bottom: 20px; }
        .step { display: none; }
        .step.active { display: block; }
        .loading { opacity: 0.7; cursor: not-allowed; }
    </style>
</head>
<body>
    <div class="forgot-container">
        <div class="logo"><h1>Delta<span>Net</span></h1></div>

        <!-- Step 1: Input No HP -->
        <div id="step1" class="step active">
            <div class="info-text">Masukkan nomor WhatsApp untuk menerima kode OTP</div>
            <form id="forgotForm">
                <div class="form-group">
                    <label for="whatsapp">Nomor WhatsApp</label>
                    <div style="display: flex; gap: 5px;">
                        <select id="countryCode" style="width: 80px; padding: 12px; border: 1px solid #ccc; border-radius: 5px; background-color: white; font-size: 14px;">
                            <option value="+62">+62</option>
                            <option value="+60">+60</option>
                            <option value="+65">+65</option>
                            <option value="+66">+66</option>
                            <option value="+84">+84</option>
                            <option value="+1">+1</option>
                            <option value="+44">+44</option>
                        </select>
                        <input type="tel" id="whatsapp" placeholder="85755974915" required style="flex: 1;">
                    </div>
                </div>
                <button type="button" onclick="handleSendOtp()" class="forgot-btn" id="btnKirim">Kirim OTP</button>
            </form>
        </div>

        <!-- Step 2: Input OTP -->
        <div id="step2" class="step">
            <div class="info-text">Masukkan kode OTP yang dikirim ke WhatsApp Anda</div>
            <form id="otpForm">
                <div class="form-group">
                    <label for="otp">Kode OTP</label>
                    <input type="text" id="otp" placeholder="Masukkan 6 digit OTP" required>
                </div>
                <button type="button" onclick="handleVerifyOtp()" class="forgot-btn" id="btnVerify">Verifikasi OTP</button>
            </form>
        </div>

        <!-- Step 3: Reset Password -->
        <div id="step3" class="step">
            <div class="info-text">Masukkan password baru Anda</div>
            <form id="resetForm">
                <div class="form-group">
                    <label for="newPassword">Password Baru</label>
                    <input type="password" id="newPassword" placeholder="Masukkan password baru" required>
                </div>
                <div class="form-group">
                    <label for="confirmPassword">Konfirmasi Password</label>
                    <input type="password" id="confirmPassword" placeholder="Konfirmasi password baru" required>
                </div>
                <button type="button" onclick="handleResetPassword()" class="forgot-btn" id="btnReset">Reset Password</button>
            </form>
        </div>

        <div style="margin-top: 20px;">
            <p style="font-size: 14px;"><a href="{{ route('login') }}" style="color: #3b82f6; text-decoration: none;">Kembali ke Login</a></p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        let userContact = '';

        async function handleSendOtp() {
            const countryCode = document.getElementById('countryCode').value;
            const whatsappNumber = document.getElementById('whatsapp').value;
            const btn = document.getElementById('btnKirim');

            if (!whatsappNumber) return alert("Nomor WA harus diisi!");

            const whatsapp = countryCode + whatsappNumber;
            userContact = whatsapp;

            btn.innerText = "Mengirim...";
            btn.classList.add('loading');
            btn.disabled = true;

            try {
                await axios.post("http://127.0.0.1:8000/api/send-otp", { contact: whatsapp });
                alert("OTP berhasil dikirim ke WhatsApp Anda!");
                showStep(2);
            } catch (error) {
                alert("Gagal: " + (error.response ? error.response.data.message : "Server Backend Mati"));
            } finally {
                btn.innerText = "Kirim OTP";
                btn.classList.remove('loading');
                btn.disabled = false;
            }
        }

        async function handleVerifyOtp() {
            const otp = document.getElementById('otp').value;
            const btn = document.getElementById('btnVerify');

            if (!otp) return alert("Kode OTP harus diisi!");

            btn.innerText = "Memverifikasi...";
            btn.classList.add('loading');
            btn.disabled = true;

            try {
                await axios.post("http://127.0.0.1:8000/api/verify-otp", { contact: userContact, otp: otp });
                alert("OTP berhasil diverifikasi!");
                showStep(3);
            } catch (error) {
                alert("Error: " + (error.response ? error.response.data.message : "OTP tidak valid"));
            } finally {
                btn.innerText = "Verifikasi OTP";
                btn.classList.remove('loading');
                btn.disabled = false;
            }
        }

        async function handleResetPassword() {
            const newPassword = document.getElementById('newPassword').value;
            const confirmPassword = document.getElementById('confirmPassword').value;
            const btn = document.getElementById('btnReset');

            if (!newPassword || !confirmPassword) return alert("Semua field harus diisi!");
            if (newPassword !== confirmPassword) return alert("Password tidak cocok!");

            btn.innerText = "Mereset...";
            btn.classList.add('loading');
            btn.disabled = true;

            try {
                await axios.post("http://127.0.0.1:8000/api/reset-password", { contact: userContact, password: newPassword });
                alert("Password berhasil direset! Silakan login dengan password baru.");
                window.location.href = "{{ route('login') }}";
            } catch (error) {
                alert("Error: " + (error.response ? error.response.data.message : "Gagal reset password"));
            } finally {
                btn.innerText = "Reset Password";
                btn.classList.remove('loading');
                btn.disabled = false;
            }
        }

        function showStep(stepNumber) {
            document.querySelectorAll('.step').forEach(step => step.classList.remove('active'));
            document.getElementById('step' + stepNumber).classList.add('active');
        }
    </script>
</body>
</html>
