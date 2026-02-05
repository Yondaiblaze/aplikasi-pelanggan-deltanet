<?php

return [
    // Auth messages
    'auth.register_success' => 'Registrasi berhasil, silakan login via OTP',
    'auth.register_failed' => 'Gagal simpan data. Silakan coba lagi.',
    'auth.contact_not_registered' => 'Nomor tidak terdaftar',
    'auth.otp_sent' => 'OTP telah dikirim ke nomor Anda',
    'auth.otp_invalid' => 'OTP tidak valid atau sudah expired',
    'auth.login_success' => 'Login berhasil',
    'auth.login_failed' => 'Login gagal',
    'auth.logout_success' => 'Logout berhasil',
    'auth.fetch_profile' => 'Data profil berhasil diambil',
    'auth.password_reset_success' => 'Password berhasil direset',
    'auth.password_reset_failed' => 'Gagal reset password',
    'auth.password_set_success' => 'Password berhasil diatur',
    'auth.invalid_credentials' => 'Nomor atau password salah',
    'auth.password_already_set' => 'Password sudah diatur',

    // Commission messages
    'commission.withdraw_success' => 'Permintaan pencairan komisi berhasil dikirim ke admin',
    'commission.withdraw_failed' => 'Gagal membuat permintaan pencairan',
    'commission.insufficient_balance' => 'Saldo komisi tidak mencukupi',
    'commission.minimum_withdraw' => 'Minimum penarikan komisi adalah :amount',
    'commission.no_commissions' => 'Anda belum memiliki komisi',
    'commission.fetch_success' => 'Data komisi berhasil diambil',
    'commission.benefits_info' => 'Informasi keuntungan referral',

    // Referral messages
    'referral.no_referrals' => 'Anda belum memiliki referral',
    'referral.already_used' => 'Kode referral ini sudah digunakan',
    'referral.invalid' => 'Kode referral tidak valid',

    // Bank account messages
    'bank.account_added' => 'Rekening bank berhasil ditambahkan',
    'bank.account_updated' => 'Rekening bank berhasil diperbarui',
    'bank.account_deleted' => 'Rekening bank berhasil dihapus',
    'bank.account_failed' => 'Gagal menambahkan rekening bank',
    'bank.account_not_found' => 'Rekening bank tidak ditemukan',
    'bank.otp_required' => 'OTP diperlukan untuk perubahan rekening',
    'bank.otp_verified' => 'OTP berhasil diverifikasi',
    'bank.otp_invalid' => 'OTP tidak valid',
    'bank.fetch_success' => 'Data rekening bank berhasil diambil',
    'bank.no_primary_account' => 'Anda belum memiliki rekening bank utama',
    'bank.cannot_delete_primary' => 'Tidak bisa menghapus rekening utama jika masih ada rekening lain',

    // Validation messages
    'validation.required' => ':attribute tidak boleh kosong',
    'validation.email' => ':attribute harus berupa email yang valid',
    'validation.unique' => ':attribute sudah terdaftar',
    'validation.min' => ':attribute minimal :min karakter',
    'validation.numeric' => ':attribute harus berupa angka',
    'validation.confirmed' => ':attribute tidak cocok',

    // Session messages
    'session.fetch_success' => 'Data sesi berhasil diambil',
    'session.fetch_failed' => 'Gagal mengambil data sesi',
    'session.not_found' => 'Sesi tidak ditemukan',
    'session.logout_success' => 'Logout dari sesi berhasil',
    'session.logout_all_success' => 'Logout dari semua sesi berhasil',
    'session.logout_failed' => 'Gagal logout dari sesi',
    'settings.fetch_success' => 'Pengaturan berhasil diambil',
    'settings.fetch_failed' => 'Gagal mengambil pengaturan',
    'settings.update_success' => 'Pengaturan berhasil diperbarui',
    'settings.update_failed' => 'Gagal memperbarui pengaturan',
    'settings.not_found' => 'Pengaturan tidak ditemukan',
    'settings.theme_retrieved' => 'Tema aplikasi berhasil diambil',
    'success' => 'Sukses',
    'error' => 'Terjadi kesalahan',
    'warning' => 'Peringatan',
    'info' => 'Informasi',
    'unauthorized' => 'Anda tidak memiliki akses',
    'not_found' => 'Data tidak ditemukan',
    'server_error' => 'Terjadi kesalahan server',
];
