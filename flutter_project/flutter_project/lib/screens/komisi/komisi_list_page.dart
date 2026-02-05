// lib/screens/komisi/komisi_list_page.dart
import 'package:flutter/material.dart';
import '../../widgets/custom_app_bar.dart';
import 'komisi_pencairan_page.dart';

class KomisiListPage extends StatelessWidget {
  const KomisiListPage({super.key});

  @override
  Widget build(BuildContext context) {
    return Column(
      children: [
        const CustomAppBar(userName: 'Selamat pagi', phoneNumber: '089525311228'),
        Expanded(
          child: ListView(
            padding: const EdgeInsets.all(16),
            children: [
              const Text('Komisi Saya', style: TextStyle(fontSize: 22, fontWeight: FontWeight.bold)),
              const SizedBox(height: 16),
              Container(
                padding: const EdgeInsets.all(20),
                decoration: BoxDecoration(
                  gradient: const LinearGradient(colors: [Colors.green, Colors.teal]),
                  borderRadius: BorderRadius.circular(16),
                ),
                child: Column(
                  children: [
                    const Text('Saldo Komisi', style: TextStyle(color: Colors.white70, fontSize: 14)),
                    const SizedBox(height: 8),
                    const Text('Rp 150.000', 
                      style: TextStyle(color: Colors.white, fontSize: 36, fontWeight: FontWeight.bold)),
                    const SizedBox(height: 16),
                    SizedBox(
                      width: double.infinity,
                      child: ElevatedButton(
                        onPressed: () => Navigator.push(context, MaterialPageRoute(builder: (_) => const KomisiPencairanPage())),
                        style: ElevatedButton.styleFrom(
                          backgroundColor: Colors.white,
                          foregroundColor: Colors.green,
                          padding: const EdgeInsets.symmetric(vertical: 14),
                          shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(8)),
                        ),
                        child: const Text('Cairkan Komisi', style: TextStyle(fontWeight: FontWeight.bold)),
                      ),
                    ),
                  ],
                ),
              ),
              const SizedBox(height: 24),
              const Text('Riwayat Komisi', style: TextStyle(fontSize: 18, fontWeight: FontWeight.bold)),
              const SizedBox(height: 12),
              _buildKomisiCard('Referral - Budi Santoso', 'Rp 50.000', '10 Jan 2024', Colors.green, Icons.arrow_upward),
              _buildKomisiCard('Referral - Siti Aminah', 'Rp 50.000', '15 Jan 2024', Colors.green, Icons.arrow_upward),
              _buildKomisiCard('Pencairan', 'Rp 100.000', '5 Jan 2024', Colors.red, Icons.arrow_downward),
            ],
          ),
        ),
      ],
    );
  }

  Widget _buildKomisiCard(String title, String amount, String date, Color color, IconData icon) {
    return Container(
      margin: const EdgeInsets.only(bottom: 12),
      padding: const EdgeInsets.all(16),
      decoration: BoxDecoration(
        color: Colors.white,
        borderRadius: BorderRadius.circular(12),
        boxShadow: [BoxShadow(color: Colors.black.withOpacity(0.05), blurRadius: 10)],
      ),
      child: Row(
        children: [
          Container(
            padding: const EdgeInsets.all(10),
            decoration: BoxDecoration(
              color: color.withOpacity(0.1),
              borderRadius: BorderRadius.circular(8),
            ),
            child: Icon(icon, color: color, size: 24),
          ),
          const SizedBox(width: 12),
          Expanded(
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                Text(title, style: const TextStyle(fontSize: 14, fontWeight: FontWeight.bold)),
                const SizedBox(height: 4),
                Text(date, style: TextStyle(fontSize: 12, color: Colors.grey)),
              ],
            ),
          ),
          Text(amount, style: TextStyle(fontSize: 16, fontWeight: FontWeight.bold, color: color)),
        ],
      ),
    );
  }
}
