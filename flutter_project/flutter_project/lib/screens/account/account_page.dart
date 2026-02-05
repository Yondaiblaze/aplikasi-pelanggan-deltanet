import 'package:flutter/material.dart';
import '../profile/profile_page.dart';

class AccountPage extends StatelessWidget {
  const AccountPage({super.key});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: Colors.grey[50],
      body: SafeArea(
        child: SingleChildScrollView(
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              // Header
              Padding(
                padding: const EdgeInsets.all(16),
                child: Row(
                  mainAxisAlignment: MainAxisAlignment.spaceBetween,
                  children: [
                    const Text('Akun', style: TextStyle(fontSize: 24, fontWeight: FontWeight.bold)),
                    Row(
                      children: [
                        IconButton(icon: const Icon(Icons.notifications_outlined), onPressed: () {}),
                        IconButton(icon: const Icon(Icons.chat_bubble_outline), onPressed: () {}),
                      ],
                    ),
                  ],
                ),
              ),

              // Profile Card
              GestureDetector(
                onTap: () {
                  Navigator.push(
                    context,
                    MaterialPageRoute(builder: (context) => const ProfilePage()),
                  );
                },
                child: Container(
                  margin: const EdgeInsets.symmetric(horizontal: 16),
                  padding: const EdgeInsets.all(16),
                  decoration: BoxDecoration(
                    color: Colors.white,
                    borderRadius: BorderRadius.circular(16),
                  ),
                  child: Row(
                    children: [
                      CircleAvatar(
                        radius: 35,
                        backgroundColor: Colors.grey[300],
                        child: const Icon(Icons.person, size: 40, color: Colors.grey),
                      ),
                      const SizedBox(width: 16),
                      Expanded(
                        child: Column(
                          crossAxisAlignment: CrossAxisAlignment.start,
                          children: [
                            Row(
                              children: [
                                const Text('Selamat pagi', style: TextStyle(fontSize: 16, fontWeight: FontWeight.bold)),
                                const SizedBox(width: 8),
                                Icon(Icons.edit, size: 16, color: Colors.grey[600]),
                              ],
                            ),
                            const Text('089525311228', style: TextStyle(fontSize: 14, color: Colors.grey)),
                          ],
                        ),
                      ),
                    ],
                  ),
                ),
              ),

              const SizedBox(height: 16),

              // Verifikasi Email
              Container(
                margin: const EdgeInsets.symmetric(horizontal: 16),
                padding: const EdgeInsets.all(16),
                decoration: BoxDecoration(
                  color: Colors.orange[50],
                  borderRadius: BorderRadius.circular(16),
                ),
                child: Row(
                  children: [
                    Container(
                      padding: const EdgeInsets.all(8),
                      decoration: BoxDecoration(
                        color: Colors.yellow[700],
                        borderRadius: BorderRadius.circular(8),
                      ),
                      child: const Icon(Icons.email, color: Colors.white, size: 20),
                    ),
                    const SizedBox(width: 12),
                    const Expanded(
                      child: Text('Verifikasi alamat email kamu', style: TextStyle(fontSize: 14)),
                    ),
                    ElevatedButton(
                      onPressed: () {},
                      style: ElevatedButton.styleFrom(
                        backgroundColor: Colors.deepOrange,
                        shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(20)),
                      ),
                      child: const Text('Verifikasi'),
                    ),
                  ],
                ),
              ),

              const SizedBox(height: 20),

              // Informasi SIM
              const Padding(
                padding: EdgeInsets.symmetric(horizontal: 16),
                child: Text('', style: TextStyle(fontSize: 18, fontWeight: FontWeight.bold)),
              ),
              const SizedBox(height: 12),

              _buildInfoCard(
                icon: Icons.shield,
                title: 'Tetap Terlindung dengan Anti Spam/Scam',
                color: Colors.grey,
              ),

              const SizedBox(height: 12),

              // Cards Row
              Padding(
                padding: const EdgeInsets.symmetric(horizontal: 16),
                child: Row(
                  children: [
                    Expanded(
                      child: _buildSmallCard(
                        icon: Icons.star,
                        title: '',
                        subtitle: '360 point',
                        color: Colors.orange[700]!,
                      ),
                    ),
                    const SizedBox(width: 12),
                    Expanded(
                      child: _buildSmallCard(
                        icon: Icons.card_giftcard,
                        title: '',
                        subtitle: '10 xp',
                        color: Colors.cyan,
                        badge: 'NEWBIE',
                      ),
                    ),
                    const SizedBox(width: 12),
                    Expanded(
                      child: _buildSmallCard(
                        icon: Icons.confirmation_number,
                        title: '',
                        subtitle: '0 ',
                        color: Colors.grey[300]!,
                        textColor: Colors.black,
                      ),
                    ),
                  ],
                ),
              ),

              const SizedBox(height: 20),

              // Metode Pembayaran
              Padding(
                padding: const EdgeInsets.symmetric(horizontal: 16),
                child: Row(
                  mainAxisAlignment: MainAxisAlignment.spaceBetween,
                  children: [
                    const Text('Metode Pembayaran', style: TextStyle(fontSize: 18, fontWeight: FontWeight.bold)),
                    TextButton(
                      onPressed: () {},
                      child: const Text('Lihat detail', style: TextStyle(color: Colors.deepOrange)),
                    ),
                  ],
                ),
              ),

              Padding(
                padding: const EdgeInsets.symmetric(horizontal: 16),
                child: Row(
                  children: [
                    Expanded(
                      child: _buildPaymentCard(
                        icon: Icons.phone_android,
                        title: '',
                        subtitle: 'Aktif hingga\n28/01/2027',
                        amount: 'Rp482',
                        badge: 'Utama',
                      ),
                    ),
                    const SizedBox(width: 12),
                    Expanded(
                      child: _buildPaymentCard(
                        icon: Icons.account_balance_wallet,
                        title: 'GoPay',
                        subtitle: 'Bayar pakai\nsaldo GoPay',
                        buttonText: 'Hubungkan',
                      ),
                    ),
                  ],
                ),
              ),

              const SizedBox(height: 20),

              // Informasi Akun
              const Padding(
                padding: EdgeInsets.symmetric(horizontal: 16),
                child: Text('Informasi Akun', style: TextStyle(fontSize: 18, fontWeight: FontWeight.bold)),
              ),
              const SizedBox(height: 12),

              _buildMenuItem(Icons.settings, 'Pengaturan'),
              _buildMenuItem(Icons.help_outline, 'Bantuan'),
              _buildMenuItem(Icons.privacy_tip_outlined, 'Kebijakan Privasi'),
              _buildMenuItem(Icons.logout, 'Keluar', color: Colors.red),

              const SizedBox(height: 80),
            ],
          ),
        ),
      ),
    );
  }

  Widget _buildInfoCard({required IconData icon, required String title, required Color color}) {
    return Container(
      margin: const EdgeInsets.symmetric(horizontal: 16),
      padding: const EdgeInsets.all(16),
      decoration: BoxDecoration(
        color: color.withOpacity(0.2),
        borderRadius: BorderRadius.circular(16),
      ),
      child: Row(
        children: [
          Icon(icon, color: color),
          const SizedBox(width: 12),
          Expanded(child: Text(title, style: const TextStyle(fontSize: 14))),
          Icon(Icons.chevron_right, color: Colors.grey[600]),
        ],
      ),
    );
  }

  Widget _buildSmallCard({
    required IconData icon,
    required String title,
    required String subtitle,
    required Color color,
    Color textColor = Colors.white,
    String? badge,
  }) {
    return Container(
      padding: const EdgeInsets.all(16),
      decoration: BoxDecoration(
        color: color,
        borderRadius: BorderRadius.circular(16),
      ),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Row(
            mainAxisAlignment: MainAxisAlignment.spaceBetween,
            children: [
              Icon(icon, color: textColor, size: 24),
              if (badge != null)
                Container(
                  padding: const EdgeInsets.symmetric(horizontal: 6, vertical: 2),
                  decoration: BoxDecoration(
                    color: Colors.pink,
                    borderRadius: BorderRadius.circular(8),
                  ),
                  child: Text(badge, style: const TextStyle(color: Colors.white, fontSize: 8)),
                ),
            ],
          ),
          const SizedBox(height: 12),
          Text(title, style: TextStyle(color: textColor, fontSize: 12)),
          const SizedBox(height: 4),
          Text(subtitle, style: TextStyle(color: textColor, fontSize: 16, fontWeight: FontWeight.bold)),
        ],
      ),
    );
  }

  Widget _buildPaymentCard({
    required IconData icon,
    required String title,
    required String subtitle,
    String? amount,
    String? badge,
    String? buttonText,
  }) {
    return Container(
      padding: const EdgeInsets.all(16),
      decoration: BoxDecoration(
        color: Colors.white,
        borderRadius: BorderRadius.circular(16),
        border: Border.all(color: Colors.grey[300]!),
      ),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Row(
            mainAxisAlignment: MainAxisAlignment.spaceBetween,
            children: [
              Icon(icon, size: 28),
              if (badge != null)
                Container(
                  padding: const EdgeInsets.symmetric(horizontal: 8, vertical: 4),
                  decoration: BoxDecoration(
                    color: Colors.cyan,
                    borderRadius: BorderRadius.circular(12),
                  ),
                  child: Text(badge, style: const TextStyle(color: Colors.white, fontSize: 10)),
                ),
            ],
          ),
          const SizedBox(height: 8),
          Text(title, style: const TextStyle(fontWeight: FontWeight.bold)),
          const SizedBox(height: 4),
          Text(subtitle, style: TextStyle(fontSize: 11, color: Colors.grey[600])),
          const SizedBox(height: 8),
          if (amount != null)
            Text(amount, style: const TextStyle(fontSize: 18, fontWeight: FontWeight.bold)),
          if (buttonText != null)
            ElevatedButton(
              onPressed: () {},
              style: ElevatedButton.styleFrom(
                backgroundColor: Colors.cyan,
                minimumSize: const Size(double.infinity, 36),
              ),
              child: Text(buttonText),
            ),
        ],
      ),
    );
  }

  Widget _buildMenuItem(IconData icon, String title, {Color? color}) {
    return Container(
      margin: const EdgeInsets.symmetric(horizontal: 16, vertical: 4),
      child: ListTile(
        leading: Icon(icon, color: color ?? Colors.grey[700]),
        title: Text(title, style: TextStyle(color: color)),
        trailing: Icon(Icons.chevron_right, color: Colors.grey[400]),
        onTap: () {},
      ),
    );
  }
}
