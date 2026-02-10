// lib/screens/dashboard/dashboard_page.dart
import 'package:flutter/material.dart';
import '../../widgets/custom_app_bar.dart';
import '../../widgets/bottom_nav_bar.dart';
import '../../widgets/ticket_tracking_widget.dart';
import '../../widgets/friend_list_widget.dart';
import '../tagihan/tagihan_list_page.dart';
import '../ticket/ticket_list_page.dart';
import '../referral/ajak_teman_page.dart';
import '../komisi/komisi_list_page.dart';
import '../account/account_page.dart';
import '../paket/upgrade_paket_page.dart';
import '../../widgets/biodata_popup.dart';
import '../komisi/komisi_pencairan_page.dart';


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
  final PageController _bannerController = PageController(viewportFraction: 0.9);
  final GlobalKey _trackingKey = GlobalKey();
  int _currentBannerIndex = 0;

  void _scrollToTracking() {
    final trackingContext = _trackingKey.currentContext;
    if (trackingContext != null) {
      Scrollable.ensureVisible(
        trackingContext,
        duration: const Duration(milliseconds: 500),
        curve: Curves.easeInOut,
      );
    }
  }

  @override
  void dispose() {
    _scrollController.dispose();
    _bannerController.dispose();
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
                Column(
                  children: [
                    Container(
                      height: 170,
                      margin: const EdgeInsets.only(top: 16),
                      child: PageView.builder(
                        controller: _bannerController,
                        onPageChanged: (index) {
                          setState(() => _currentBannerIndex = index % 3);
                        },
                        itemBuilder: (context, index) => Container(
                          margin: const EdgeInsets.symmetric(horizontal: 8),
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
                      ),
                    ),
                    const SizedBox(height: 12),
                    Row(
                      mainAxisAlignment: MainAxisAlignment.center,
                      children: List.generate(
                        3,
                        (index) => Container(
                          width: 8,
                          height: 8,
                          margin: const EdgeInsets.symmetric(horizontal: 4),
                          decoration: BoxDecoration(
                            shape: BoxShape.circle,
                            color: _currentBannerIndex == index ? Colors.blue : Colors.grey[300],
                          ),
                        ),
                      ),
                    ),
                  ],
                ),
                const SizedBox(height: 16),
                Padding(
                  padding: const EdgeInsets.symmetric(horizontal: 16),
                  child: SingleChildScrollView(
                    scrollDirection: Axis.horizontal,
                    child: Row(
                      children: [
                        _buildMenuIcon(context, Icons.grid_view, 'Bayar Tagihan', null),
                        _buildMenuIcon(context, Icons.shopping_bag, 'Lapor Gangguan', null),
                        _buildMenuIcon(context, Icons.shield, 'Cek Laporan', null),
                        _buildMenuIcon(context, Icons.video_library, 'Pasang\nInternet', () {
                          showModalBottomSheet(
                            context: context,
                            isScrollControlled: true,
                            isDismissible: false,
                            backgroundColor: Colors.transparent,
                            builder: (context) => const BiodataPopup(),
                          );
                        }),
                        _buildMenuIcon(context, Icons.track_changes, 'Undang Teman', _scrollToTracking),
                        _buildMenuIcon(context, Icons.shopping_bag, 'Komisi Saya', null),
                      ],
                    ),
                  ),
                ),
                const SizedBox(height: 20),
            Padding(
  padding: const EdgeInsets.symmetric(horizontal: 16),
  child: Container(
    decoration: BoxDecoration(
      color: Colors.white,
      borderRadius: BorderRadius.circular(12),
      boxShadow: [BoxShadow(color: Colors.black.withOpacity(0.08), blurRadius: 10)],
    ),
    child: IntrinsicHeight(
      child: Row(
        children: [
          Expanded(
            child: GestureDetector(
              onTap: () => Navigator.push(context, MaterialPageRoute(builder: (_) => const UpgradePaketPage())),
              child: Container(
                padding: const EdgeInsets.all(12),
                decoration: BoxDecoration(
                  color: Colors.blue,
                  borderRadius: const BorderRadius.only(
                    topLeft: Radius.circular(12),
                    bottomLeft: Radius.circular(12),
                  ),
                ),
                child: Column(
                  crossAxisAlignment: CrossAxisAlignment.start,
                  children: [
                    Container(
                      padding: const EdgeInsets.symmetric(horizontal: 8, vertical: 3),
                      decoration: BoxDecoration(
                        color: Colors.white.withOpacity(0.3),
                        borderRadius: BorderRadius.circular(4),
                      ),
                      child: const Text('Paket Aktif', style: TextStyle(fontSize: 9, color: Colors.white, fontWeight: FontWeight.w600)),
                    ),
                    const SizedBox(height: 8),
                    const Text('Special', style: TextStyle(fontSize: 16, fontWeight: FontWeight.bold, color: Colors.white)),
                    const Text('100Mbps', style: TextStyle(fontSize: 13, color: Colors.white)),
                    const Spacer(),
                    SizedBox(
                      width: double.infinity,
                      child: ElevatedButton(
                        onPressed: () => Navigator.push(context, MaterialPageRoute(builder: (_) => const UpgradePaketPage())),
                        style: ElevatedButton.styleFrom(
                          backgroundColor: Colors.white,
                          foregroundColor: Colors.blue,
                          padding: const EdgeInsets.symmetric(vertical: 6),
                          shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(6)),
                          elevation: 0,
                        ),
                        child: const Text('Upgrade', style: TextStyle(fontSize: 11, fontWeight: FontWeight.w600)),
                      ),
                    ),
                  ],
                ),
              ),
            ),
          ),
          Container(width: 1, color: Colors.grey[300]),
          Expanded(
            child: GestureDetector(
              onTap: () => Navigator.push(context, MaterialPageRoute(builder: (_) => const TagihanListPage())),
              child: Container(
                padding: const EdgeInsets.all(12),
                child: Column(
                  crossAxisAlignment: CrossAxisAlignment.center,
                  children: [
                    Container(
                      padding: const EdgeInsets.symmetric(horizontal: 8, vertical: 3),
                      decoration: BoxDecoration(
                        color: Colors.red[50],
                        borderRadius: BorderRadius.circular(4),
                      ),
                      child: Text('Tagihan Anda', style: TextStyle(fontSize: 9, color: Colors.red[700], fontWeight: FontWeight.w600)),
                    ),
                    const SizedBox(height: 6),
                    const Text('Total:', style: TextStyle(fontSize: 9, color: Colors.grey)),
                    const Text('Rp200.000', style: TextStyle(fontSize: 16, fontWeight: FontWeight.bold, color: Colors.black)),
                    const Spacer(),
                    SizedBox(
                      width: double.infinity,
                      child: ElevatedButton(
                        onPressed: () => Navigator.push(context, MaterialPageRoute(builder: (_) => const TagihanListPage())),
                        style: ElevatedButton.styleFrom(
                          backgroundColor: Colors.grey[300],
                          foregroundColor: Colors.black87,
                          padding: const EdgeInsets.symmetric(vertical: 6),
                          shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(6)),
                          elevation: 0,
                        ),
                        child: const Text('Bayar', style: TextStyle(fontSize: 11, fontWeight: FontWeight.w600)),
                      ),
                    ),
                  ],
                ),
              ),
            ),
          ),
          Container(width: 1, color: Colors.grey[300]),
          Expanded(
            child: GestureDetector(
              onTap: () => Navigator.push(context, MaterialPageRoute(builder: (_) => const KomisiListPage())),
              child: Container(
                padding: const EdgeInsets.all(12),
                decoration: const BoxDecoration(
                  borderRadius: BorderRadius.only(
                    topRight: Radius.circular(12),
                    bottomRight: Radius.circular(12),
                  ),
                ),
                child: Column(
                  crossAxisAlignment: CrossAxisAlignment.center,
                  children: [
                    Container(
                      padding: const EdgeInsets.symmetric(horizontal: 8, vertical: 3),
                      decoration: BoxDecoration(
                        color: Colors.green[50],
                        borderRadius: BorderRadius.circular(4),
                      ),
                      child: Text('Komisi Anda', style: TextStyle(fontSize: 9, color: Colors.green[700], fontWeight: FontWeight.w600)),
                    ),
                    const SizedBox(height: 6),
                    const Text('Total:', style: TextStyle(fontSize: 9, color: Colors.grey)),
                    const Text('Rp200.000', style: TextStyle(fontSize: 16, fontWeight: FontWeight.bold, color: Colors.black)),
                    const Spacer(),
                  SizedBox(
                      width: double.infinity,
                      child: ElevatedButton(
                        onPressed: () => Navigator.push(context, MaterialPageRoute(builder: (_) => const KomisiPencairanPage())),
                        style: ElevatedButton.styleFrom(
                          backgroundColor: Colors.grey[300],
                          foregroundColor: Colors.black87,
                          padding: const EdgeInsets.symmetric(vertical: 6),
                          shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(6)),
                          elevation: 0,
                        ),
                        child: const Text('Tarik', style: TextStyle(fontSize: 11, fontWeight: FontWeight.w600)),
                      ),
                    ),
                  ],
                ),
              ),
            ),
          ),
        ],
      ),
    ),
  ),
),

                const SizedBox(height: 20),
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
                Container(
                  margin: const EdgeInsets.symmetric(horizontal: 16),
                  padding: const EdgeInsets.all(16),
                  decoration: BoxDecoration(
                    color: Colors.white,
                    borderRadius: BorderRadius.circular(12),
                    boxShadow: [BoxShadow(color: Colors.black.withOpacity(0.05), blurRadius: 10)],
                  ),
                  child: Row(
                    children: [
                      Expanded(
                        child: Column(
                          crossAxisAlignment: CrossAxisAlignment.start,
                          children: [
                            const Text('Tagihanku', style: TextStyle(fontSize: 10, color: Colors.grey, fontWeight: FontWeight.w500)),
                            const SizedBox(height: 12),
                            const Text('Rp 350.000', style: TextStyle(fontSize: 24, fontWeight: FontWeight.bold, color: Colors.black)),
                            const SizedBox(height: 8),
                            Container(
                              padding: const EdgeInsets.symmetric(horizontal: 10, vertical: 4),
                              decoration: BoxDecoration(
                                color: Colors.orange[50],
                                borderRadius: BorderRadius.circular(6),
                              ),
                              child: Text('Jatuh tempo 5 hari lagi', style: TextStyle(fontSize: 10, color: Colors.orange[700], fontWeight: FontWeight.w600)),
                            ),
                            const SizedBox(height: 16),
                            SizedBox(
                              width: double.infinity,
                              child: ElevatedButton(
                                onPressed: () {},
                                style: ElevatedButton.styleFrom(
                                  backgroundColor: Colors.blue,
                                  foregroundColor: Colors.white,
                                  padding: const EdgeInsets.symmetric(vertical: 12),
                                  shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(8)),
                                  elevation: 0,
                                ),
                                child: const Text('Bayar Sekarang', style: TextStyle(fontSize: 13, fontWeight: FontWeight.w600)),
                              ),
                            ),
                          ],
                        ),
                      ),
                      Container(
                        width: 1,
                        height: 140,
                        margin: const EdgeInsets.symmetric(horizontal: 16),
                        color: Colors.grey[300],
                      ),
                      Expanded(
                        child: Column(
                          crossAxisAlignment: CrossAxisAlignment.start,
                          children: [
                            const Text('Komisiku', style: TextStyle(fontSize: 10, color: Colors.grey, fontWeight: FontWeight.w500)),
                            const SizedBox(height: 12),
                            const Text('Rp 125.000', style: TextStyle(fontSize: 24, fontWeight: FontWeight.bold, color: Colors.black)),
                            const SizedBox(height: 8),
                            Container(
                              padding: const EdgeInsets.symmetric(horizontal: 10, vertical: 4),
                              decoration: BoxDecoration(
                                color: Colors.green[50],
                                borderRadius: BorderRadius.circular(6),
                              ),
                              child: Text('3 referral aktif', style: TextStyle(fontSize: 10, color: Colors.green[700], fontWeight: FontWeight.w600)),
                            ),
                            const SizedBox(height: 16),
                            SizedBox(
                              width: double.infinity,
                              child: ElevatedButton(
                                onPressed: () {},
                                style: ElevatedButton.styleFrom(
                                  backgroundColor: Colors.blue,
                                  foregroundColor: Colors.white,
                                  padding: const EdgeInsets.symmetric(vertical: 12),
                                  shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(8)),
                                  elevation: 0,
                                ),
                                child: const Text('Lihat Detail', style: TextStyle(fontSize: 13, fontWeight: FontWeight.w600)),
                              ),
                            ),
                          ],
                        ),
                      ),
                    ],
                  ),
                ),
                const SizedBox(height: 20),
                const FriendListWidget(),
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
      child: Container(
        width: 70,
        margin: const EdgeInsets.symmetric(horizontal: 4),
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
            SizedBox(
              height: 32,
              child: Text(label, textAlign: TextAlign.center, style: const TextStyle(fontSize: 10), maxLines: 2),
            ),
          ],
        ),
      ),
    );
  }
}
