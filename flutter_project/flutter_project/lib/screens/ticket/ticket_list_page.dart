// lib/screens/ticket/ticket_list_page.dart
import 'package:flutter/material.dart';
import '../../widgets/custom_app_bar.dart';
import '../../widgets/status_badge.dart';
import 'ticket_buat_page.dart';
import 'ticket_ubah_page.dart';

class TicketListPage extends StatelessWidget {
  const TicketListPage({super.key});

  @override
  Widget build(BuildContext context) {
    return Column(
      children: [
        const CustomAppBar(userName: 'Selamat pagi', phoneNumber: '089525311228'),
        Expanded(
          child: ListView(
            padding: const EdgeInsets.all(16),
            children: [
              Row(
                mainAxisAlignment: MainAxisAlignment.spaceBetween,
                children: [
                  const Text('Riwayat Ticket', style: TextStyle(fontSize: 22, fontWeight: FontWeight.bold)),
                  ElevatedButton.icon(
                    onPressed: () => Navigator.push(context, MaterialPageRoute(builder: (_) => const TicketBuatPage())),
                    icon: const Icon(Icons.add, size: 18),
                    label: const Text('Buat'),
                    style: ElevatedButton.styleFrom(
                      backgroundColor: Colors.pink,
                      foregroundColor: Colors.white,
                      shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(8)),
                    ),
                  ),
                ],
              ),
              const SizedBox(height: 16),
              _buildTicketCard(context, 'Internet Lambat', '15 Jan 2024', 'Proses', Colors.orange),
              _buildTicketCard(context, 'Gangguan Koneksi', '10 Jan 2024', 'Selesai', Colors.green),
              _buildTicketCard(context, 'Tagihan Tidak Sesuai', '5 Jan 2024', 'Selesai', Colors.green),
            ],
          ),
        ),
      ],
    );
  }

  Widget _buildTicketCard(BuildContext context, String title, String date, String status, Color statusColor) {
    return Container(
      margin: const EdgeInsets.only(bottom: 12),
      padding: const EdgeInsets.all(16),
      decoration: BoxDecoration(
        color: Colors.white,
        borderRadius: BorderRadius.circular(12),
        boxShadow: [BoxShadow(color: Colors.black.withOpacity(0.05), blurRadius: 10)],
      ),
      child: InkWell(
        onTap: () => Navigator.push(context, MaterialPageRoute(builder: (_) => const TicketUbahPage())),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            Row(
              mainAxisAlignment: MainAxisAlignment.spaceBetween,
              children: [
                Expanded(child: Text(title, style: const TextStyle(fontSize: 16, fontWeight: FontWeight.bold))),
                StatusBadge(text: status, color: statusColor),
              ],
            ),
            const SizedBox(height: 8),
            Row(
              children: [
                Icon(Icons.calendar_today, size: 14, color: Colors.grey),
                const SizedBox(width: 6),
                Text(date, style: TextStyle(color: Colors.grey, fontSize: 13)),
              ],
            ),
          ],
        ),
      ),
    );
  }
}
