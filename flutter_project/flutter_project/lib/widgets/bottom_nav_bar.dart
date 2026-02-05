// lib/widgets/bottom_nav_bar.dart
import 'package:flutter/material.dart';

class CustomBottomNavBar extends StatelessWidget {
  final int currentIndex;
  final Function(int) onTap;

  const CustomBottomNavBar({
    super.key,
    required this.currentIndex,
    required this.onTap,
  });

  @override
  Widget build(BuildContext context) {
    return BottomNavigationBar(
      type: BottomNavigationBarType.fixed,
      selectedItemColor: Colors.pink,
      unselectedItemColor: Colors.grey,
      currentIndex: currentIndex,
      onTap: onTap,
      selectedFontSize: 11,
      unselectedFontSize: 11,
      items: const [
        BottomNavigationBarItem(icon: Icon(Icons.home), label: 'Home'),
        BottomNavigationBarItem(icon: Icon(Icons.receipt_long), label: 'Tagihan'),
        BottomNavigationBarItem(icon: Icon(Icons.confirmation_number), label: 'Ticket'),
        BottomNavigationBarItem(icon: Icon(Icons.people), label: 'Referral'),
        BottomNavigationBarItem(icon: Icon(Icons.account_balance_wallet), label: 'Komisi'),
        BottomNavigationBarItem(icon: Icon(Icons.account_circle), label: 'Akun'),
      ],
    );
  }
}
