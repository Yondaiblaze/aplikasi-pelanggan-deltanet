// lib/widgets/custom_app_bar.dart
import 'package:flutter/material.dart';
import '../screens/profile/profile_page.dart';

class CustomAppBar extends StatelessWidget implements PreferredSizeWidget {
  final String userName;
  final String phoneNumber;

  const CustomAppBar({
    super.key,
    required this.userName,
    required this.phoneNumber,
  });

  @override
  Widget build(BuildContext context) {
    return Container(
      padding: const EdgeInsets.all(16),
      color: Colors.white,
      child: SafeArea(
        child: Row(
          children: [
            GestureDetector(
              onTap: () {
                Navigator.push(
                  context,
                  MaterialPageRoute(builder: (context) => const ProfilePage()),
                );
              },
              child: CircleAvatar(
                radius: 25,
                backgroundColor: Colors.grey[300],
                child: Icon(Icons.person, size: 30, color: Colors.grey[600]),
              ),
            ),
            const SizedBox(width: 12),
            Expanded(
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                mainAxisSize: MainAxisSize.min,
                children: [
                  Text(userName, style: const TextStyle(fontSize: 13)),
                  Text(phoneNumber, style: const TextStyle(fontSize: 15, fontWeight: FontWeight.bold)),
                ],
              ),
            ),
            IconButton(icon: const Icon(Icons.search, size: 22), onPressed: () {}),
            IconButton(icon: const Icon(Icons.notifications_outlined, size: 22), onPressed: () {}),
            Container(
              width: 36,
              height: 36,
              decoration: BoxDecoration(
                color: Colors.pink,
                borderRadius: BorderRadius.circular(8),
              ),
              child: const Icon(Icons.chat, color: Colors.white, size: 20),
            ),
          ],
        ),
      ),
    );
  }

  @override
  Size get preferredSize => const Size.fromHeight(80);
}
