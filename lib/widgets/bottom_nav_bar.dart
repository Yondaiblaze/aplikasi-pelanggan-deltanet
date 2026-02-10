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
    return Container(
      decoration: BoxDecoration(
        boxShadow: [
          BoxShadow(
            color: Colors.black.withOpacity(0.1),
            blurRadius: 20,
            offset: const Offset(0, -5),
          ),
        ],
      ),
      child: ClipRRect(
        borderRadius: const BorderRadius.only(
          topLeft: Radius.circular(30),
          topRight: Radius.circular(30),
        ),
        child: BottomNavigationBar(
          type: BottomNavigationBarType.fixed,
          backgroundColor: Colors.white,
          selectedItemColor: Colors.pink,
          unselectedItemColor: Colors.grey,
          currentIndex: currentIndex,
          onTap: onTap,
          selectedFontSize: 11,
          unselectedFontSize: 11,
          elevation: 0,
          items: const [
            BottomNavigationBarItem(icon: Icon(Icons.home), label: 'Home'),
            BottomNavigationBarItem(icon: Icon(Icons.receipt_long), label: 'Tagihan'),
            BottomNavigationBarItem(icon: Icon(Icons.confirmation_number), label: 'Ticket'),
            BottomNavigationBarItem(icon: Icon(Icons.people), label: 'Referral'),
            BottomNavigationBarItem(icon: Icon(Icons.account_balance_wallet), label: 'Komisi'),
            BottomNavigationBarItem(icon: Icon(Icons.account_circle), label: 'Akun'),
          ],
        ),
      ),
    );
  }
}
