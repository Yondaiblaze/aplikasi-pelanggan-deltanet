// lib/screens/komisi/komisi_pencairan_page.dart
import 'package:flutter/material.dart';

class KomisiPencairanPage extends StatefulWidget {
  const KomisiPencairanPage({super.key});

  @override
  State<KomisiPencairanPage> createState() => _KomisiPencairanPageState();
}

class _KomisiPencairanPageState extends State<KomisiPencairanPage> {
  final _formKey = GlobalKey<FormState>();
  String _selectedMethod = 'Transfer Bank';
  final _nominalController = TextEditingController();

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('Pencairan Komisi'),
        backgroundColor: Colors.white,
        foregroundColor: Colors.black,
        elevation: 0,
      ),
      body: Form(
        key: _formKey,
        child: Column(
          children: [
            Expanded(
              child: ListView(
                padding: const EdgeInsets.all(16),
                children: [
                  Container(
                    padding: const EdgeInsets.all(16),
                    decoration: BoxDecoration(
                      color: Colors.green[50],
                      borderRadius: BorderRadius.circular(12),
                      border: Border.all(color: Colors.green.shade200),
                    ),
                    child: Row(
                      mainAxisAlignment: MainAxisAlignment.spaceBetween,
                      children: [
                        Column(
                          crossAxisAlignment: CrossAxisAlignment.start,
                          children: const [
                            Text('Saldo Tersedia', style: TextStyle(color: Colors.grey, fontSize: 13)),
                            SizedBox(height: 4),
                            Text('Rp 150.000', style: TextStyle(fontSize: 24, fontWeight: FontWeight.bold, color: Colors.green)),
                          ],
                        ),
                        Icon(Icons.account_balance_wallet, color: Colors.green, size: 40),
                      ],
                    ),
                  ),
                  const SizedBox(height: 24),
                  const Text('Nominal Pencairan', style: TextStyle(fontWeight: FontWeight.bold)),
                  const SizedBox(height: 8),
                  TextFormField(
                    controller: _nominalController,
                    keyboardType: TextInputType.number,
                    decoration: InputDecoration(
                      hintText: 'Masukkan nominal',
                      prefixText: 'Rp ',
                      border: OutlineInputBorder(borderRadius: BorderRadius.circular(8)),
                      filled: true,
                      fillColor: Colors.white,
                    ),
                    validator: (value) {
                      if (value?.isEmpty ?? true) return 'Nominal tidak boleh kosong';
                      final nominal = int.tryParse(value!);
                      if (nominal == null || nominal < 50000) return 'Minimal pencairan Rp 50.000';
                      if (nominal > 150000) return 'Saldo tidak mencukupi';
                      return null;
                    },
                  ),
                  const SizedBox(height: 16),
                  const Text('Metode Pencairan', style: TextStyle(fontWeight: FontWeight.bold)),
                  const SizedBox(height: 8),
                  _buildMethodCard('Transfer Bank', Icons.account_balance, 'BCA - 1234567890'),
                  _buildMethodCard('E-Wallet', Icons.account_balance_wallet, 'GoPay - 089525311228'),
                  const SizedBox(height: 16),
                  Container(
                    padding: const EdgeInsets.all(12),
                    decoration: BoxDecoration(
                      color: Colors.blue[50],
                      borderRadius: BorderRadius.circular(8),
                      border: Border.all(color: Colors.blue.shade200),
                    ),
                    child: Row(
                      children: [
                        Icon(Icons.info_outline, color: Colors.blue, size: 20),
                        const SizedBox(width: 8),
                        Expanded(
                          child: Text('Pencairan akan diproses dalam 1-3 hari kerja', 
                            style: TextStyle(fontSize: 12, color: Colors.blue[900])),
                        ),
                      ],
                    ),
                  ),
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
                    if (_formKey.currentState!.validate()) {
                      showDialog(
                        context: context,
                        builder: (_) => AlertDialog(
                          title: const Text('Konfirmasi Pencairan'),
                          content: Text('Cairkan komisi sebesar Rp ${_nominalController.text}?'),
                          actions: [
                            TextButton(onPressed: () => Navigator.pop(context), child: const Text('Batal')),
                            ElevatedButton(
                              onPressed: () {
                                Navigator.pop(context);
                                Navigator.pop(context);
                                ScaffoldMessenger.of(context).showSnackBar(
                                  const SnackBar(content: Text('Pencairan berhasil diajukan!'), backgroundColor: Colors.green),
                                );
                              },
                              child: const Text('Konfirmasi'),
                            ),
                          ],
                        ),
                      );
                    }
                  },
                  style: ElevatedButton.styleFrom(
                    backgroundColor: Colors.green,
                    foregroundColor: Colors.white,
                    padding: const EdgeInsets.symmetric(vertical: 16),
                    shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(8)),
                  ),
                  child: const Text('Ajukan Pencairan', style: TextStyle(fontSize: 16, fontWeight: FontWeight.bold)),
                ),
              ),
            ),
          ],
        ),
      ),
    );
  }

  Widget _buildMethodCard(String title, IconData icon, String detail) {
    return Container(
      margin: const EdgeInsets.only(bottom: 12),
      decoration: BoxDecoration(
        color: Colors.white,
        borderRadius: BorderRadius.circular(12),
        border: Border.all(color: _selectedMethod == title ? Colors.green : Colors.grey.shade300),
        boxShadow: [BoxShadow(color: Colors.black.withOpacity(0.05), blurRadius: 10)],
      ),
      child: RadioListTile<String>(
        value: title,
        groupValue: _selectedMethod,
        onChanged: (value) => setState(() => _selectedMethod = value!),
        title: Text(title, style: const TextStyle(fontWeight: FontWeight.w600)),
        subtitle: Text(detail, style: const TextStyle(fontSize: 12, color: Colors.grey)),
        secondary: Icon(icon, color: Colors.green),
        activeColor: Colors.green,
      ),
    );
  }

  @override
  void dispose() {
    _nominalController.dispose();
    super.dispose();
  }
}
