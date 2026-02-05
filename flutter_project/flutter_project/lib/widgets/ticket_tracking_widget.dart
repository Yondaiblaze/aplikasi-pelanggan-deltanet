import 'package:flutter/material.dart';
import 'dart:math' as math;
import '../screens/ticket/ticket_tracking_page.dart';

class TicketTrackingWidget extends StatelessWidget {
  final String ticketId;
  final String status;
  final int progress;

  const TicketTrackingWidget({
    super.key,
    required this.ticketId,
    required this.status,
    required this.progress,
  });

  @override
  Widget build(BuildContext context) {
    return GestureDetector(
      onTap: () {
        Navigator.push(
          context,
          MaterialPageRoute(
            builder: (context) => TicketTrackingPage(ticketId: ticketId, status: status),
          ),
        );
      },
      child: Container(
        margin: const EdgeInsets.symmetric(horizontal: 16, vertical: 8),
        padding: const EdgeInsets.all(12),
        decoration: BoxDecoration(
          color: Colors.white,
          borderRadius: BorderRadius.circular(12),
          boxShadow: [
            BoxShadow(
              color: Colors.black.withOpacity(0.05),
              blurRadius: 10,
            ),
          ],
        ),
        child: Row(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            // Track Record List (Kiri)
            Expanded(
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  Text(
                    'Tiket #$ticketId',
                    style: const TextStyle(
                      fontSize: 14,
                      fontWeight: FontWeight.bold,
                    ),
                  ),
                  const SizedBox(height: 8),
                  _buildTrackItem(
                    time: '11 Jan 10:25',
                    title: 'Teknisi telah menyelesaikan perbaikan',
                    isActive: true,
                    isFirst: true,
                  ),
                  _buildTrackItem(
                    time: '11 Jan 09:56',
                    title: 'Teknisi sedang melakukan perbaikan',
                    isActive: false,
                  ),
                  _buildTrackItem(
                    time: '11 Jan 09:24',
                    title: 'Teknisi dalam perjalanan ke lokasi Anda',
                    isActive: false,
                    isLast: true,
                  ),
                ],
              ),
            ),
            const SizedBox(width: 12),
            // Circular Progress (Kanan)
            Column(
              children: [
                SizedBox(
                  width: 70,
                  height: 70,
                  child: CustomPaint(
                    painter: CircularProgressPainter(progress: progress),
                    child: Center(
                      child: Text(
                        '$progress%',
                        style: const TextStyle(
                          fontSize: 18,
                          fontWeight: FontWeight.bold,
                          color: Colors.blue,
                        ),
                      ),
                    ),
                  ),
                ),
                const SizedBox(height: 8),
                _buildStatusItem('Dibuat', progress >= 33),
                const SizedBox(height: 4),
                _buildStatusItem('Disetujui', progress >= 66),
                const SizedBox(height: 4),
                _buildStatusItem('Selesai', progress >= 100),
              ],
            ),
          ],
        ),
      ),
    );
  }

  Widget _buildStatusItem(String label, bool isActive) {
    return Row(
      mainAxisSize: MainAxisSize.min,
      children: [
        Container(
          width: 6,
          height: 6,
          decoration: BoxDecoration(
            color: isActive ? Colors.teal : Colors.grey[300],
            shape: BoxShape.circle,
          ),
        ),
        const SizedBox(width: 4),
        Text(
          label,
          style: TextStyle(
            fontSize: 10,
            color: isActive ? Colors.teal : Colors.grey[500],
            fontWeight: isActive ? FontWeight.w600 : FontWeight.normal,
          ),
        ),
      ],
    );
  }

  Widget _buildTrackItem({
    required String time,
    required String title,
    required bool isActive,
    bool isFirst = false,
    bool isLast = false,
  }) {
    return Row(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        Column(
          children: [
            if (!isFirst)
              Container(
                width: 2,
                height: 6,
                color: Colors.grey[300],
              ),
            Container(
              width: 8,
              height: 8,
              decoration: BoxDecoration(
                color: isActive ? Colors.teal : Colors.grey[300],
                shape: BoxShape.circle,
              ),
            ),
            if (!isLast)
              Container(
                width: 2,
                height: 16,
                color: Colors.grey[300],
              ),
          ],
        ),
        const SizedBox(width: 8),
        Expanded(
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              Text(
                time,
                style: TextStyle(
                  fontSize: 10,
                  color: isActive ? Colors.teal : Colors.grey[500],
                  fontWeight: isActive ? FontWeight.w600 : FontWeight.normal,
                ),
              ),
              const SizedBox(height: 1),
              Text(
                title,
                style: TextStyle(
                  fontSize: 11,
                  color: isActive ? Colors.black87 : Colors.grey[600],
                  fontWeight: isActive ? FontWeight.w500 : FontWeight.normal,
                ),
                maxLines: 2,
                overflow: TextOverflow.ellipsis,
              ),
              if (!isLast) const SizedBox(height: 6),
            ],
          ),
        ),
      ],
    );
  }
}

class CircularProgressPainter extends CustomPainter {
  final int progress;

  CircularProgressPainter({required this.progress});

  @override
  void paint(Canvas canvas, Size size) {
    final center = Offset(size.width / 2, size.height / 2);
    final radius = size.width / 2 - 5;

    // Background circle
    final bgPaint = Paint()
      ..color = Colors.grey.shade200
      ..style = PaintingStyle.stroke
      ..strokeWidth = 6;
    canvas.drawCircle(center, radius, bgPaint);

    // Progress arc
    final progressPaint = Paint()
      ..color = Colors.blue
      ..style = PaintingStyle.stroke
      ..strokeWidth = 6
      ..strokeCap = StrokeCap.round;

    final sweepAngle = 2 * math.pi * (progress / 100);
    canvas.drawArc(
      Rect.fromCircle(center: center, radius: radius),
      -math.pi / 2,
      sweepAngle,
      false,
      progressPaint,
    );
  }

  @override
  bool shouldRepaint(covariant CustomPainter oldDelegate) => true;
}
