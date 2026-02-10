// lib/screens/tagihan/tagihan_bayar_page.dart
import 'package:flutter/material.dart';

class TagihanBayarPage extends StatefulWidget {
  const TagihanBayarPage({super.key});

  @override
  State<TagihanBayarPage> createState() => _TagihanBayarPageState();
}

class _TagihanBayarPageState extends State<TagihanBayarPage> {
  String _selectedMethod = 'Transfer Bank';

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('Pembayaran'),
        backgroundColor: Colors.white,
        foregroundColor: Colors.black,
        elevation: 0,
      ),
      body: Column(
        children: [
          Expanded(
            child: ListView(
              padding: const EdgeInsets.all(16),
              children: [
                Container(
                  padding: const EdgeInsets.all(16),
                  decoration: BoxDecoration(
                    gradient: const LinearGradient(colors: [Colors.pink, Colors.purple]),
                    borderRadius: BorderRadius.circular(12),
                  ),
                  child: Column(
                    children: const [
                      Text('Total Pembayaran', style: TextStyle(color: Colors.white70, fontSize: 14)),
                      SizedBox(height: 8),
                      Text('Rp 125.000', style: TextStyle(color: Colors.white, fontSize: 32, fontWeight: FontWeight.bold)),
                    ],
                  ),
                ),
                const SizedBox(height: 24),
                const Text('Pilih Metode Pembayaran', style: TextStyle(fontSize: 16, fontWeight: FontWeight.bold)),
                const SizedBox(height: 12),
                _buildPaymentMethod('Transfer Bank', Icons.account_balance),
                _buildPaymentMethod('E-Wallet', Icons.account_balance_wallet),
                _buildPaymentMethod('Kartu Kredit', Icons.credit_card),
                _buildPaymentMethod('Minimarket', Icons.store),
              ],
            ),
          ),
          Container(
            padding: const EdgeInsets.all(16),
            decoration: BoxDecoration(
              color: Colors.white,
              boxShadow: [BoxShadow(color: Colors.black.withOpacity(0.1), blurRadius: 10, offset: const Offset(0, -2))],
            ),
            child: SizedBox(
              width: double.infinity,
              child: ElevatedButton(
                onPressed: () {
                  showDialog(
                    context: context,
                    builder: (_) => AlertDialog(
                      title: const Text('Konfirmasi Pembayaran'),
                      content: const Text('Apakah Anda yakin ingin melanjutkan pembayaran?'),
                      actions: [
                        TextButton(onPressed: () => Navigator.pop(context), child: const Text('Batal')),
                        ElevatedButton(
                          onPressed: () {
                            Navigator.pop(context);
                            Navigator.pop(context);
                            Navigator.pop(context);
                            ScaffoldMessenger.of(context).showSnackBar(
                              const SnackBar(content: Text('Pembayaran berhasil!'), backgroundColor: Colors.green),
                            );
                          },
                          child: const Text('Konfirmasi'),
                        ),
                      ],
                    ),
                  );
                },
                style: ElevatedButton.styleFrom(
                  backgroundColor: Colors.pink,
                  foregroundColor: Colors.white,
                  padding: const EdgeInsets.symmetric(vertical: 16),
                  shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(8)),
                ),
                child: const Text('Konfirmasi Pembayaran', style: TextStyle(fontSize: 16, fontWeight: FontWeight.bold)),
              ),
            ),
          ),
        ],
      ),
    );
  }

  Widget _buildPaymentMethod(String title, IconData icon) {
    return Container(
      margin: const EdgeInsets.only(bottom: 12),
      decoration: BoxDecoration(
        color: Colors.white,
        borderRadius: BorderRadius.circular(12),
        border: Border.all(color: _selectedMethod == title ? Colors.pink : Colors.grey.shade300),
        boxShadow: [BoxShadow(color: Colors.black.withOpacity(0.05), blurRadius: 10)],
      ),
      child: RadioListTile<String>(
        value: title,
        groupValue: _selectedMethod,
        onChanged: (value) => setState(() => _selectedMethod = value!),
        title: Text(title, style: const TextStyle(fontWeight: FontWeight.w600)),
        secondary: Icon(icon, color: Colors.pink),
        activeColor: Colors.pink,
      ),
    );
  }
}
