import 'package:flutter/material.dart';
import 'detail_paket_page.dart';

class UpgradePaketPage extends StatelessWidget {
  const UpgradePaketPage({super.key});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: Colors.grey[50],
      appBar: AppBar(
        backgroundColor: Colors.white,
        elevation: 0,
        leading: IconButton(
          icon: const Icon(Icons.arrow_back, color: Colors.black),
          onPressed: () => Navigator.pop(context),
        ),
        title: const Text('Upgrade Paket', style: TextStyle(color: Colors.black, fontWeight: FontWeight.bold, fontSize: 18)),
        centerTitle: true,
      ),
      body: Column(
        children: [
          Container(
            color: Colors.white,
            padding: const EdgeInsets.all(16),
            child: Row(
              mainAxisAlignment: MainAxisAlignment.spaceBetween,
              children: [
                const Text('4 paket', style: TextStyle(fontSize: 16, fontWeight: FontWeight.w600)),
                Row(
                  children: [
                    Container(
                      padding: const EdgeInsets.symmetric(horizontal: 12, vertical: 6),
                      decoration: BoxDecoration(
                        border: Border.all(color: Colors.grey[300]!),
                        borderRadius: BorderRadius.circular(8),
                      ),
                      child: Row(
                        children: const [
                          Text('Urutkan', style: TextStyle(fontSize: 13)),
                          SizedBox(width: 4),
                          Icon(Icons.keyboard_arrow_down, size: 18),
                        ],
                      ),
                    ),
                    const SizedBox(width: 8),
                    Icon(Icons.view_list, size: 24, color: Colors.grey[700]),
                    const SizedBox(width: 8),
                    Icon(Icons.grid_view, size: 24, color: Colors.grey[400]),
                  ],
                ),
              ],
            ),
          ),
          Expanded(
            child: ListView(
              padding: const EdgeInsets.all(16),
              children: [
                _buildPaketCard(context, 'Special', '100 Mbps', 150000),
                const SizedBox(height: 20),
                _buildPaketCard(context, 'Istimewa', '200 Mbps', 200000),
                const SizedBox(height: 20),
                _buildPaketCard(context, 'Ngebut', '300 Mbps', 250000),
                const SizedBox(height: 20),
                _buildPaketCard(context, 'Gamers', '500 Mbps', 300000),
              ],
            ),
          ),
        ],
      ),
    );
  }

  Widget _buildPaketCard(BuildContext context, String name, String speed, int price) {
    return GestureDetector(
      onTap: () => Navigator.push(context, MaterialPageRoute(builder: (_) => DetailPaketPage(name: name, speed: speed, price: price))),
      child: Stack(
        clipBehavior: Clip.none,
        children: [
          Container(
            margin: const EdgeInsets.only(top: 12),
            decoration: BoxDecoration(
              gradient: LinearGradient(
                colors: [Colors.pink[50]!, Colors.white],
                begin: Alignment.centerLeft,
                end: Alignment.centerRight,
              ),
              borderRadius: BorderRadius.circular(16),
            ),
            child: Padding(
              padding: const EdgeInsets.fromLTRB(16, 24, 16, 16),
              child: Row(
                children: [
                  Expanded(
                    child: Column(
                      crossAxisAlignment: CrossAxisAlignment.start,
                      children: [
                        Text(speed, style: const TextStyle(fontSize: 22, fontWeight: FontWeight.bold)),
                        const SizedBox(height: 2),
                        const Text('1 Bulan | Perpanjangan Otomatis', style: TextStyle(fontSize: 11, color: Colors.grey)),
                      ],
                    ),
                  ),
                  Text('Rp ${price ~/ 1000}.000', style: const TextStyle(fontSize: 20, fontWeight: FontWeight.bold)),
                ],
              ),
            ),
          ),
          Positioned(
            top: 0,
            left: 0,
            child: Container(
              padding: const EdgeInsets.symmetric(horizontal: 12, vertical: 4),
              decoration: BoxDecoration(
                color: Colors.cyan,
                borderRadius: const BorderRadius.only(
                  topLeft: Radius.circular(12),
                  topRight: Radius.circular(12),
                  bottomRight: Radius.circular(12),
                ),
              ),
              child: Text(name, style: const TextStyle(color: Colors.white, fontSize: 11, fontWeight: FontWeight.bold)),
            ),
          ),
        ],
      ),
    );
  }
}
