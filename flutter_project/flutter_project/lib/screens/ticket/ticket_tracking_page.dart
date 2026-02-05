import 'package:flutter/material.dart';

class TicketTrackingPage extends StatelessWidget {
  final String ticketId;
  final String status;

  const TicketTrackingPage({
    super.key,
    required this.ticketId,
    required this.status,
  });

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: Colors.grey[50],
      appBar: AppBar(
        backgroundColor: Colors.white,
        elevation: 0,
        leading: IconButton(
          icon: const Icon(Icons.arrow_back, color: Colors.blue),
          onPressed: () => Navigator.pop(context),
        ),
        title: const Text('Tracking Tiket', style: TextStyle(color: Colors.black)),
        centerTitle: true,
      ),
      body: SingleChildScrollView(
        child: Column(
          children: [
            Container(
              margin: const EdgeInsets.all(16),
              padding: const EdgeInsets.all(16),
              decoration: BoxDecoration(
                color: Colors.white,
                borderRadius: BorderRadius.circular(12),
              ),
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  Text('Tiket #$ticketId', style: const TextStyle(fontSize: 16, fontWeight: FontWeight.bold)),
                  const SizedBox(height: 12),
                  _buildProgressBar(),
                ],
              ),
            ),
            Container(
              margin: const EdgeInsets.symmetric(horizontal: 16),
              padding: const EdgeInsets.all(16),
              decoration: BoxDecoration(
                color: Colors.white,
                borderRadius: BorderRadius.circular(12),
              ),
              child: Column(
                children: [
                  _buildTimelineItem(
                    time: '11 Jan 10:25',
                    title: 'Teknisi telah menyelesaikan perbaikan',
                    isActive: true,
                    isFirst: true,
                  ),
                  _buildTimelineItem(
                    time: '11 Jan 09:56',
                    title: 'Teknisi sedang melakukan perbaikan',
                    isActive: false,
                  ),
                  _buildTimelineItem(
                    time: '11 Jan 09:24',
                    title: 'Teknisi dalam perjalanan ke lokasi Anda',
                    isActive: false,
                  ),
                  _buildTimelineItem(
                    time: '11 Jan 08:15',
                    title: 'Tiket telah disetujui oleh Admin',
                    isActive: false,
                  ),
                  _buildTimelineItem(
                    time: '10 Jan 22:47',
                    title: 'Tiket sedang diproses',
                    isActive: false,
                  ),
                  _buildTimelineItem(
                    time: '10 Jan 22:30',
                    title: 'Tiket telah dibuat',
                    isActive: false,
                    isLast: true,
                  ),
                ],
              ),
            ),
            const SizedBox(height: 20),
          ],
        ),
      ),
    );
  }

  Widget _buildProgressBar() {
    return Row(
      children: [
        _buildProgressStep('Dibuat', true),
        _buildProgressLine(true),
        _buildProgressStep('Disetujui', true),
        _buildProgressLine(true),
        _buildProgressStep('Selesai', true),
      ],
    );
  }

  Widget _buildProgressStep(String label, bool isActive) {
    return Column(
      children: [
        Container(
          width: 24,
          height: 24,
          decoration: BoxDecoration(
            color: isActive ? Colors.teal : Colors.grey[300],
            shape: BoxShape.circle,
          ),
          child: isActive ? const Icon(Icons.check, color: Colors.white, size: 16) : null,
        ),
        const SizedBox(height: 4),
        Text(label, style: TextStyle(fontSize: 10, color: isActive ? Colors.teal : Colors.grey)),
      ],
    );
  }

  Widget _buildProgressLine(bool isActive) {
    return Expanded(
      child: Container(
        height: 2,
        margin: const EdgeInsets.only(bottom: 20),
        color: isActive ? Colors.teal : Colors.grey[300],
      ),
    );
  }

  Widget _buildTimelineItem({
    required String time,
    required String title,
    required bool isActive,
    bool isFirst = false,
    bool isLast = false,
  }) {
    return Row(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        SizedBox(
          width: 80,
          child: Text(time, style: TextStyle(fontSize: 12, color: isActive ? Colors.teal : Colors.grey)),
        ),
        Column(
          children: [
            if (!isFirst) Container(width: 2, height: 20, color: Colors.grey[300]),
            Container(
              width: 12,
              height: 12,
              decoration: BoxDecoration(
                color: isActive ? Colors.teal : Colors.grey[300],
                shape: BoxShape.circle,
              ),
            ),
            if (!isLast) Container(width: 2, height: 40, color: Colors.grey[300]),
          ],
        ),
        const SizedBox(width: 12),
        Expanded(
          child: Padding(
            padding: const EdgeInsets.only(bottom: 20),
            child: Text(
              title,
              style: TextStyle(
                fontSize: 14,
                color: isActive ? Colors.teal : Colors.grey[600],
                fontWeight: isActive ? FontWeight.bold : FontWeight.normal,
              ),
            ),
          ),
        ),
      ],
    );
  }
}
