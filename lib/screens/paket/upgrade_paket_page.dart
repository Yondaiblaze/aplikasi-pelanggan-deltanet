import 'package:flutter/material.dart';
import 'detail_paket_page.dart';

class UpgradePaketPage extends StatefulWidget {
  const UpgradePaketPage({super.key});

  @override
  State<UpgradePaketPage> createState() => _UpgradePaketPageState();
}

class _UpgradePaketPageState extends State<UpgradePaketPage> {
  bool isGridView = false;
  String selectedCategory = 'Semua';
  String sortBy = 'Urutkan';

  final List<String> categories = ['Semua', 'Special', 'Istimewa', 'Ngebut', 'Gamers'];
  final List<String> sortOptions = ['Urutkan', 'Harga Tertinggi', 'Harga Terendah', 'Mbps Tertinggi', 'Mbps Terendah'];

  final List<Map<String, dynamic>> pakets = [
    {'name': 'Special', 'speed': '100 Mbps', 'mbps': 100, 'price': 150000, 'originalPrice': 156000, 'discount': 4},
    {'name': 'Istimewa', 'speed': '200 Mbps', 'mbps': 200, 'price': 200000, 'originalPrice': 220000, 'discount': 9},
    {'name': 'Ngebut', 'speed': '300 Mbps', 'mbps': 300, 'price': 250000, 'originalPrice': 275000, 'discount': 9},
    {'name': 'Gamers', 'speed': '500 Mbps', 'mbps': 500, 'price': 300000, 'originalPrice': 330000, 'discount': 9},
  ];

  List<Map<String, dynamic>> get filteredPakets {
    var filtered = selectedCategory == 'Semua' 
        ? List<Map<String, dynamic>>.from(pakets)
        : pakets.where((p) => p['name'] == selectedCategory).toList();

    switch (sortBy) {
      case 'Harga Terendah':
        filtered.sort((a, b) => a['price'].compareTo(b['price']));
        break;
      case 'Harga Tertinggi':
        filtered.sort((a, b) => b['price'].compareTo(a['price']));
        break;
      case 'Mbps Tertinggi':
        filtered.sort((a, b) => b['mbps'].compareTo(a['mbps']));
        break;
      case 'Mbps Terendah':
        filtered.sort((a, b) => a['mbps'].compareTo(b['mbps']));
        break;
    }
    return filtered;
  }

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
            child: Column(
              children: [
                SizedBox(
                  height: 48,
                  child: ListView.separated(
                    padding: const EdgeInsets.symmetric(horizontal: 16, vertical: 8),
                    scrollDirection: Axis.horizontal,
                    itemCount: categories.length,
                    separatorBuilder: (_, __) => const SizedBox(width: 8),
                    itemBuilder: (context, index) {
                      final category = categories[index];
                      final isSelected = selectedCategory == category;
                      return GestureDetector(
                        onTap: () => setState(() => selectedCategory = category),
                        child: Container(
                          padding: const EdgeInsets.symmetric(horizontal: 20, vertical: 8),
                          decoration: BoxDecoration(
                            color: isSelected ? Colors.pink : Colors.grey[100],
                            borderRadius: BorderRadius.circular(20),
                          ),
                          child: Center(
                            child: Text(
                              category,
                              style: TextStyle(
                                fontSize: 14,
                                fontWeight: FontWeight.w500,
                                color: isSelected ? Colors.white : Colors.grey[700],
                              ),
                            ),
                          ),
                        ),
                      );
                    },
                  ),
                ),
                Padding(
                  padding: const EdgeInsets.fromLTRB(16, 8, 16, 12),
                  child: Row(
                    mainAxisAlignment: MainAxisAlignment.spaceBetween,
                    children: [
                      Text('${filteredPakets.length} paket', style: const TextStyle(fontSize: 16, fontWeight: FontWeight.w600)),
                      Row(
                        children: [
                          Container(
                            height: 32,
                            padding: const EdgeInsets.symmetric(horizontal: 10),
                            decoration: BoxDecoration(
                              color: Colors.white,
                              border: Border.all(color: Colors.grey[300]!),
                              borderRadius: BorderRadius.circular(8),
                            ),
                            child: DropdownButtonHideUnderline(
                              child: DropdownButton<String>(
                                value: sortBy,
                                isDense: true,
                                icon: const Icon(Icons.keyboard_arrow_down, size: 16, color: Colors.black87),
                                style: const TextStyle(fontSize: 13, color: Colors.black87, fontWeight: FontWeight.w400),
                                dropdownColor: Colors.white,
                                borderRadius: BorderRadius.circular(8),
                                items: sortOptions.map((String value) {
                                  return DropdownMenuItem<String>(
                                    value: value,
                                    child: Text(value, style: const TextStyle(fontSize: 13)),
                                  );
                                }).toList(),
                                onChanged: (String? newValue) {
                                  if (newValue != null) {
                                    setState(() => sortBy = newValue);
                                  }
                                },
                              ),
                            ),
                          ),
                          const SizedBox(width: 8),
                          GestureDetector(
                            onTap: () => setState(() => isGridView = false),
                            child: Icon(Icons.view_list, size: 24, color: isGridView ? Colors.grey[400] : Colors.grey[700]),
                          ),
                          const SizedBox(width: 8),
                          GestureDetector(
                            onTap: () => setState(() => isGridView = true),
                            child: Icon(Icons.grid_view, size: 24, color: isGridView ? Colors.grey[700] : Colors.grey[400]),
                          ),
                        ],
                      ),
                    ],
                  ),
                ),
              ],
            ),
          ),
          Expanded(
            child: isGridView ? _buildGridView() : _buildListView(),
          ),
        ],
      ),
    );
  }

  Widget _buildListView() {
    return ListView.separated(
      padding: const EdgeInsets.all(16),
      itemCount: filteredPakets.length,
      separatorBuilder: (_, __) => const SizedBox(height: 16),
      itemBuilder: (context, index) {
        final paket = filteredPakets[index];
        return _buildPaketCard(paket['name'], paket['speed'], paket['price']);
      },
    );
  }

  Widget _buildGridView() {
    return GridView.builder(
      padding: const EdgeInsets.all(16),
      gridDelegate: const SliverGridDelegateWithFixedCrossAxisCount(
        crossAxisCount: 2,
        mainAxisSpacing: 16,
        crossAxisSpacing: 16,
        childAspectRatio: 0.68,
      ),
      itemCount: filteredPakets.length,
      itemBuilder: (context, index) {
        final paket = filteredPakets[index];
        return _buildGridCard(paket['name'], paket['speed'], paket['price'], paket['originalPrice'], paket['discount']);
      },
    );
  }

  Widget _buildPaketCard(String name, String speed, int price) {
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

  Widget _buildGridCard(String name, String speed, int price, int originalPrice, int discount) {
    return GestureDetector(
      onTap: () => Navigator.push(context, MaterialPageRoute(builder: (_) => DetailPaketPage(name: name, speed: speed, price: price))),
      child: Stack(
        clipBehavior: Clip.none,
        children: [
          Container(
            margin: const EdgeInsets.only(top: 12),
            padding: const EdgeInsets.all(16),
            decoration: BoxDecoration(
              color: Colors.pink[50],
              borderRadius: BorderRadius.circular(16),
            ),
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                const SizedBox(height: 8),
                Text('Rp ${price ~/ 1000}.000', style: const TextStyle(fontSize: 24, fontWeight: FontWeight.bold)),
                const SizedBox(height: 8),
                const Text('1 Bulan | Perpanjangan Otomatis', style: TextStyle(fontSize: 10, color: Colors.grey)),
                const Spacer(),
                Text('Rp${price ~/ 1000}.000', style: const TextStyle(fontSize: 18, fontWeight: FontWeight.bold)),
                const SizedBox(height: 6),
                Row(
                  children: [
                    Container(
                      padding: const EdgeInsets.symmetric(horizontal: 6, vertical: 2),
                      decoration: BoxDecoration(
                        color: Colors.orange,
                        borderRadius: BorderRadius.circular(4),
                      ),
                      child: Text('$discount%', style: const TextStyle(color: Colors.white, fontSize: 11, fontWeight: FontWeight.bold)),
                    ),
                    const SizedBox(width: 6),
                    Flexible(
                      child: Text('Rp${originalPrice ~/ 1000}.000', style: const TextStyle(fontSize: 12, color: Colors.grey, decoration: TextDecoration.lineThrough), overflow: TextOverflow.ellipsis),
                    ),
                  ],
                ),
              ],
            ),
          ),
          Positioned(
            top: 0,
            left: 0,
            child: Container(
              padding: const EdgeInsets.symmetric(horizontal: 12, vertical: 4),
              decoration: BoxDecoration(
                color: Colors.pink,
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
