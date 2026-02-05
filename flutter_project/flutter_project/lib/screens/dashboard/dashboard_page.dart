// lib/screens/dashboard/dashboard_page.dart
import 'package:flutter/material.dart';
import '../../widgets/custom_app_bar.dart';
import '../../widgets/bottom_nav_bar.dart';
import '../../widgets/ticket_tracking_widget.dart';
import '../tagihan/tagihan_list_page.dart';
import '../ticket/ticket_list_page.dart';
import '../referral/ajak_teman_page.dart';
import '../komisi/komisi_list_page.dart';
import '../account/account_page.dart';
import '../paket/upgrade_paket_page.dart';


class DashboardPage extends StatefulWidget {
  const DashboardPage({super.key});

  @override
  State<DashboardPage> createState() => _DashboardPageState();
}

class _DashboardPageState extends State<DashboardPage> {
  int _currentIndex = 0;

  final List<Widget> _pages = [
    const DashboardContent(),
    const TagihanListPage(),
    const TicketListPage(),
    const AjakTemanPage(),
    const KomisiListPage(),
    const AccountPage(),
  ];

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: _pages[_currentIndex],
      bottomNavigationBar: CustomBottomNavBar(
        currentIndex: _currentIndex,
        onTap: (index) => setState(() => _currentIndex = index),
      ),
    );
  }
}

class DashboardContent extends StatefulWidget {
  const DashboardContent({super.key});

  @override
  State<DashboardContent> createState() => _DashboardContentState();
}

class _DashboardContentState extends State<DashboardContent> {
  final ScrollController _scrollController = ScrollController();
  final GlobalKey _trackingKey = GlobalKey();

  void _scrollToTracking() {
    final context = _trackingKey.currentContext;
    if (context != null) {
      Scrollable.ensureVisible(
        context,
        duration: const Duration(milliseconds: 500),
        curve: Curves.easeInOut,
      );
    }
  }

  @override
  void dispose() {
    _scrollController.dispose();
    super.dispose();
  }

  @override
  Widget build(BuildContext context) {
    return Column(
      children: [
        const CustomAppBar(userName: 'Selamat pagi', phoneNumber: '089525311228'),
        Expanded(
          child: SingleChildScrollView(
            controller: _scrollController,
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                // Banner Promo
                Container(
                  height: 170,
                  margin: const EdgeInsets.all(16),
                  decoration: BoxDecoration(
                    borderRadius: BorderRadius.circular(16),
                    gradient: const LinearGradient(colors: [Color(0xFF8B0051), Color(0xFF4A0080)]),
                  ),
                  child: Stack(
                    children: [
                      Padding(
                        padding: const EdgeInsets.all(20),
                        child: Column(
                          crossAxisAlignment: CrossAxisAlignment.start,
                          children: [
                            const Text('Harga Spesial\nuntuk 50.000 UC', 
                              style: TextStyle(color: Colors.white, fontSize: 18, fontWeight: FontWeight.bold)),
                            const SizedBox(height: 6),
                            const Text('Hanya dengan', style: TextStyle(color: Colors.white70, fontSize: 11)),
                            Container(
                              margin: const EdgeInsets.only(top: 6),
                              padding: const EdgeInsets.symmetric(horizontal: 18, vertical: 6),
                              decoration: BoxDecoration(
                                gradient: const LinearGradient(colors: [Colors.pink, Colors.orange]),
                                borderRadius: BorderRadius.circular(8),
                              ),
                              child: const Text('Rp50.000', 
                                style: TextStyle(color: Colors.white, fontSize: 22, fontWeight: FontWeight.bold)),
                            ),
                          ],
                        ),
                      ),
                      Positioned(
                        right: 0,
                        top: 0,
                        bottom: 0,
                        child: Container(
                          width: 140,
                          decoration: BoxDecoration(
                            color: Colors.purple[900],
                            borderRadius: const BorderRadius.only(
                              topRight: Radius.circular(16),
                              bottomRight: Radius.circular(16),
                            ),
                          ),
                          child: Column(
                            mainAxisAlignment: MainAxisAlignment.center,
                            children: [
                              Container(width: 90, height: 90, color: Colors.white24),
                              const SizedBox(height: 6),
                              const Text('Voucher UniPin', style: TextStyle(color: Colors.white, fontSize: 11)),
                            ],
                          ),
                        ),
                      ),
                    ],
                  ),
                ),

                // Menu Shortcut
                Padding(
                  padding: const EdgeInsets.symmetric(horizontal: 16),
                  child: Row(
                    mainAxisAlignment: MainAxisAlignment.spaceAround,
                    children: [
                      _buildMenuIcon(context, Icons.grid_view, 'Lihat Semua', null),
                      _buildMenuIcon(context, Icons.shopping_bag, 'Beli Paket', null),
                      _buildMenuIcon(context, Icons.shield, 'Anti Spam\nProtection', null),
                      _buildMenuIcon(context, Icons.video_library, 'Paket Nonton', null),
                      _buildMenuIcon(context, Icons.track_changes, 'Tracking\nTiket', _scrollToTracking),
                    ],
                  ),
                ),

                const SizedBox(height: 20),

                // Ringkasan Tagihan & Komisi
                Padding(
                  padding: const EdgeInsets.symmetric(horizontal: 16),
                  child: Row(
                    children: [
Expanded(
  child: Container(
    padding: const EdgeInsets.all(16),
    decoration: BoxDecoration(
      color: Colors.white,
      borderRadius: BorderRadius.circular(12),
      border: Border.all(color: Colors.grey[300]!, width: 1),
      boxShadow: [BoxShadow(color: Colors.black.withOpacity(0.05), blurRadius: 10)],
    ),
    child: Column(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        Row(
          children: [
            Icon(Icons.wifi, color: Colors.blue, size: 20),
            const SizedBox(width: 8),
            const Text('Paket Anda', style: TextStyle(fontSize: 11, color: Colors.grey)),
          ],
        ),
        const SizedBox(height: 8),
        const Text('Special', style: TextStyle(fontSize: 18, fontWeight: FontWeight.bold)),
        const SizedBox(height: 2),
        const Text('100Mbps', style: TextStyle(fontSize: 14, color: Colors.black87)),
        const SizedBox(height: 12),
        SizedBox(
          width: double.infinity,
          child: ElevatedButton(
            onPressed: () => Navigator.push(context, MaterialPageRoute(builder: (_) => const UpgradePaketPage())),
            style: ElevatedButton.styleFrom(
              backgroundColor: Colors.blue,
              foregroundColor: Colors.white,
              padding: const EdgeInsets.symmetric(vertical: 8),
              shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(8)),
              elevation: 0,
            ),
            child: const Text('Upgrade Paket', style: TextStyle(fontSize: 12, fontWeight: FontWeight.w600)),
          ),
        ),
      ],
    ),
  ),
),


                      const SizedBox(width: 12),
                      Expanded(
                        child: Container(
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
                                children: [
                                  Icon(Icons.account_balance_wallet, color: Colors.green, size: 20),
                                  const SizedBox(width: 8),
                                  const Text('Komisi', style: TextStyle(fontSize: 13, color: Colors.grey)),
                                ],
                              ),
                              const SizedBox(height: 8),
                              const Text('Rp 150.000', style: TextStyle(fontSize: 20, fontWeight: FontWeight.bold)),
                              const SizedBox(height: 4),
                              const Text('Saldo Tersedia', style: TextStyle(fontSize: 11, color: Colors.green)),
                            ],
                          ),
                        ),
                      ),
                    ],
                  ),
                ),

                const SizedBox(height: 20),

                // Penawaran Terbatas
                Padding(
                  padding: const EdgeInsets.symmetric(horizontal: 16),
                  child: Row(
                    mainAxisAlignment: MainAxisAlignment.spaceBetween,
                    children: [
                      Column(
                        crossAxisAlignment: CrossAxisAlignment.start,
                        children: [
                          const Text('Penawaran Terbatas', style: TextStyle(fontSize: 17, fontWeight: FontWeight.bold)),
                          Row(
                            children: [
                              const Text('Berakhir dalam', style: TextStyle(color: Colors.grey, fontSize: 12)),
                              const SizedBox(width: 8),
                              Container(
                                padding: const EdgeInsets.symmetric(horizontal: 10, vertical: 3),
                                decoration: BoxDecoration(
                                  color: Colors.deepOrange,
                                  borderRadius: BorderRadius.circular(20),
                                ),
                                child: const Text('5 Hari 13 Jam', 
                                  style: TextStyle(color: Colors.white, fontSize: 11, fontWeight: FontWeight.bold)),
                              ),
                            ],
                          ),
                        ],
                      ),
                      TextButton(
                        onPressed: () {},
                        child: const Text('Lihat semua >', 
                          style: TextStyle(color: Colors.deepOrange, fontWeight: FontWeight.bold, fontSize: 13)),
                      ),
                    ],
                  ),
                ),

                const SizedBox(height: 12),

                // Promo Card
                Container(
                  height: 190,
                  margin: const EdgeInsets.symmetric(horizontal: 16),
                  child: Row(
                    children: [
                      Expanded(
                        flex: 2,
                        child: Container(
                          decoration: BoxDecoration(
                            borderRadius: BorderRadius.circular(16),
                            gradient: const LinearGradient(
                              colors: [Colors.blue, Colors.orange, Colors.pink],
                              begin: Alignment.topLeft,
                              end: Alignment.bottomRight,
                            ),
                          ),
                          child: Stack(
                            children: [
                              const Positioned(
                                left: 14,
                                top: 14,
                                child: Text('Limited\nOffer!', 
                                  style: TextStyle(color: Colors.white, fontSize: 20, fontWeight: FontWeight.bold)),
                              ),
                              Positioned(
                                left: 14,
                                bottom: 14,
                                child: Container(
                                  padding: const EdgeInsets.symmetric(horizontal: 14, vertical: 6),
                                  decoration: BoxDecoration(
                                    color: Colors.white,
                                    borderRadius: BorderRadius.circular(20),
                                  ),
                                  child: const Text('Harga Spesial', 
                                    style: TextStyle(color: Colors.pink, fontWeight: FontWeight.bold, fontSize: 11)),
                                ),
                              ),
                            ],
                          ),
                        ),
                      ),
                      const SizedBox(width: 10),
                      Expanded(
                        flex: 3,
                        child: Container(
                          padding: const EdgeInsets.all(14),
                          decoration: BoxDecoration(
                            color: Colors.pink[50],
                            borderRadius: BorderRadius.circular(16),
                          ),
                          child: Column(
                            crossAxisAlignment: CrossAxisAlignment.start,
                            children: [
                              Container(
                                padding: const EdgeInsets.symmetric(horizontal: 10, vertical: 3),
                                decoration: BoxDecoration(
                                  color: Colors.pink,
                                  borderRadius: BorderRadius.circular(12),
                                ),
                                child: const Text('Anti Spam PLUS+', 
                                  style: TextStyle(color: Colors.white, fontSize: 9, fontWeight: FontWeight.bold)),
                              ),
                              const SizedBox(height: 6),
                              const Text('150GB', style: TextStyle(fontSize: 22, fontWeight: FontWeight.bold)),
                              const Text('28 Hari', style: TextStyle(fontSize: 18, fontWeight: FontWeight.bold)),
                              const Spacer(),
                              const Text('Sekali Beli', style: TextStyle(color: Colors.grey, fontSize: 11)),
                              const SizedBox(height: 6),
                              const Text('Rp150.000', style: TextStyle(fontSize: 18, fontWeight: FontWeight.bold)),
                              Row(
                                children: [
                                  const Text('25% ', 
                                    style: TextStyle(color: Colors.deepOrange, fontWeight: FontWeight.bold, fontSize: 12)),
                                  Text('Rp200.000', 
                                    style: TextStyle(color: Colors.grey, decoration: TextDecoration.lineThrough, fontSize: 11)),
                                ],
                              ),
                            ],
                          ),
                        ),
                      ),
                    ],
                  ),
                ),

                const SizedBox(height: 20),
                Container(
                  key: _trackingKey,
                  child: Column(
                    crossAxisAlignment: CrossAxisAlignment.start,
                    children: const [
                      Padding(
                        padding: EdgeInsets.symmetric(horizontal: 16),
                        child: Text('Tracking Tiket Aktif', style: TextStyle(fontSize: 17, fontWeight: FontWeight.bold)),
                      ),
                      SizedBox(height: 8),
                      TicketTrackingWidget(ticketId: 'TKT001', status: 'Dalam Proses', progress: 66),
                    ],
                  ),
                ),

                const SizedBox(height: 80),
              ],
            ),
          ),
        ),
      ],
    );
  }

  Widget _buildMenuIcon(BuildContext context, IconData icon, String label, VoidCallback? onTap) {
    return GestureDetector(
      onTap: onTap,
      child: Column(
        children: [
          Container(
            width: 56,
            height: 56,
            decoration: BoxDecoration(
              color: Colors.blue.withOpacity(0.1),
              borderRadius: BorderRadius.circular(28),
            ),
            child: Icon(icon, color: Colors.blue, size: 26),
          ),
          const SizedBox(height: 6),
          Text(label, textAlign: TextAlign.center, style: const TextStyle(fontSize: 10), maxLines: 2),
        ],
      ),
    );
  }
}
