📘 Dokumentasi API - Deltanet Backend (Lumen)
Base URL: http://192.168.1.15:8000/api
Headers Wajib: Accept: application/json

1. Fitur Autentikasi (Public)
A. Registrasi Pelanggan
Endpoint: /register

Method: POST

Body (JSON):

JSON
{
    "name": "Nama Lengkap",
    "contact": "08123456789",
    "email": "email@example.com"
}
B. Kirim OTP (WhatsApp)
Endpoint: /send-otp

Method: POST

Body (JSON):

JSON
{
    "contact": "08123456789"
}
C. Login / Verifikasi OTP
Endpoint: /login

Method: POST

Body (JSON):

JSON
{
    "contact": "08123456789",
    "otp": "123456"
}
Response Sukses: Akan memberikan token JWT. Simpan token ini di Session/Cookie Frontend.

2. Fitur Terproteksi (Butuh Login)
Header Tambahan: Authorization: Bearer <TOKEN_JWT_KAMU>

A. Ambil Data Profil (Me)
Endpoint: /me

Method: GET

B. Logout
Endpoint: /logout

Method: POST

3. Catatan untuk Yusuf (WhatsApp Gateway)
Backend Lumen akan menembak script Node.js kamu di alamat:
http://localhost:3000/send-message

Tolong siapkan endpoint tersebut untuk menerima:

JSON
{
    "number": "08123456789",
    "message": "Isi pesan OTP di sini"
}
