// lib/screens/referral/list_teman_page.dart
import 'package:flutter/material.dart';
import '../../widgets/status_badge.dart';

class ListTemanPage extends StatelessWidget {
  const ListTemanPage({super.key});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('Daftar Teman'),
        backgroundColor: Colors.white,
        foregroundColor: Colors.black,
        elevation: 0,
      ),
      body: ListView(
        padding: const EdgeInsets.all(16),
        children: [
          _buildTemanCard('Budi Santoso', '10 Jan 2024', 'Aktif', Colors.green),
          _buildTemanCard('Siti Aminah', '15 Jan 2024', 'Aktif', Colors.green),
          _buildTemanCard('Ahmad Yani', '20 Jan 2024', 'Pending', Colors.orange),
        ],
      ),
    );
  }

  Widget _buildTemanCard(String name, String date, String status, Color statusColor) {
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
          CircleAvatar(
            radius: 25,
            backgroundColor: Colors.pink[100],
            child: Text(name[0], style: const TextStyle(fontSize: 20, fontWeight: FontWeight.bold, color: Colors.pink)),
          ),
          const SizedBox(width: 12),
          Expanded(
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                Text(name, style: const TextStyle(fontSize: 15, fontWeight: FontWeight.bold)),
                const SizedBox(height: 4),
                Text('Bergabung: $date', style: TextStyle(fontSize: 12, color: Colors.grey)),
              ],
            ),
          ),
          StatusBadge(text: status, color: statusColor),
        ],
      ),
    );
  }
}
