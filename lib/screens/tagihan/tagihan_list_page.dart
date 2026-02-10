// lib/screens/tagihan/tagihan_list_page.dart
import 'package:flutter/material.dart';
import '../../widgets/custom_app_bar.dart';
import '../../widgets/status_badge.dart';
import 'tagihan_detail_page.dart';

class TagihanListPage extends StatelessWidget {
  const TagihanListPage({super.key});

  @override
  Widget build(BuildContext context) {
    return Column(
      children: [
        const CustomAppBar(userName: 'Selamat pagi', phoneNumber: '089525311228'),
        Expanded(
          child: ListView(
            padding: const EdgeInsets.all(16),
            children: [
              const Text('Daftar Tagihan', style: TextStyle(fontSize: 22, fontWeight: FontWeight.bold)),
              const SizedBox(height: 16),
              _buildTagihanCard(context, 'Januari 2024', 'Rp 125.000', 'Belum Dibayar', Colors.red, true),
              _buildTagihanCard(context, 'Februari 2024', 'Rp 125.000', 'Belum Dibayar', Colors.red, true),
              _buildTagihanCard(context, 'Desember 2023', 'Rp 125.000', 'Lunas', Colors.green, false),
              _buildTagihanCard(context, 'November 2023', 'Rp 125.000', 'Lunas', Colors.green, false),
            ],
          ),
        ),
      ],
    );
  }

  Widget _buildTagihanCard(BuildContext context, String periode, String nominal, String status, Color statusColor, bool showButton) {
    return Container(
      margin: const EdgeInsets.only(bottom: 12),
      padding: const EdgeInsets.all(16),
      decoration: BoxDecoration(
        color: Colors.white,
        borderRadius: BorderRadius.circular(12),
        boxShadow: [BoxShadow(color: Colors.black.withOpacity(0.05), blurRadius: 10)],
      ),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Row(
            mainAxisAlignment: MainAxisAlignment.spaceBetween,
            children: [
              Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  Text(periode, style: const TextStyle(fontSize: 16, fontWeight: FontWeight.bold)),
                  const SizedBox(height: 4),
                  Text(nominal, style: const TextStyle(fontSize: 20, fontWeight: FontWeight.bold, color: Colors.pink)),
                ],
              ),
              StatusBadge(text: status, color: statusColor),
            ],
          ),
          if (showButton) ...[
            const SizedBox(height: 12),
            SizedBox(
              width: double.infinity,
              child: ElevatedButton(
                onPressed: () => Navigator.push(context, MaterialPageRoute(builder: (_) => const TagihanDetailPage())),
                style: ElevatedButton.styleFrom(
                  backgroundColor: Colors.pink,
                  foregroundColor: Colors.white,
                  padding: const EdgeInsets.symmetric(vertical: 12),
                  shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(8)),
                ),
                child: const Text('Lihat Detail', style: TextStyle(fontWeight: FontWeight.bold)),
              ),
            ),
          ],
        ],
      ),
    );
  }
}
