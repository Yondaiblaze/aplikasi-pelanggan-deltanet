// lib/widgets/pemasangan_popup.dart
import 'package:flutter/material.dart';
import 'biodata_popup.dart';


class PemasanganPopup extends StatefulWidget {
  const PemasanganPopup({super.key});

  @override
  State<PemasanganPopup> createState() => _PemasanganPopupState();
}

class _PemasanganPopupState extends State<PemasanganPopup> {
  String? selectedPaket;
  final _namaWifiController = TextEditingController();
  final _passwordWifiController = TextEditingController();
  final _tanggalController = TextEditingController();

  final List<String> paketOptions = ['Special - 100 Mbps', 'Istimewa - 200 Mbps', 'Ngebut - 300 Mbps', 'Gamers - 500 Mbps'];

  @override
  void dispose() {
    _namaWifiController.dispose();
    _passwordWifiController.dispose();
    _tanggalController.dispose();
    super.dispose();
  }

  @override
  Widget build(BuildContext context) {
    return Material(
      color: Colors.transparent,
    child: Container(
  constraints: BoxConstraints(
    maxHeight: MediaQuery.of(context).size.height * 0.6,
  ),
  decoration: const BoxDecoration(
    color: Colors.white,
    borderRadius: BorderRadius.vertical(top: Radius.circular(20)),
  ),
  child: Column(
    mainAxisSize: MainAxisSize.min,
    children: [
      Container(
        margin: const EdgeInsets.only(top: 12, bottom: 16),
        width: 40,
        height: 4,
        decoration: BoxDecoration(color: Colors.grey[300], borderRadius: BorderRadius.circular(2)),
      ),
      Flexible(
        child: SingleChildScrollView(
          padding: const EdgeInsets.symmetric(horizontal: 20),
          child: Column(
            children: [
             const Center(
  child: Text(
    'Pemasangan',
    style: TextStyle(
      fontSize: 18,
      fontWeight: FontWeight.bold,
      color: Colors.black,
    ),
  ),
),

              const SizedBox(height: 20),
              _buildDropdownField(),
              const SizedBox(height: 12),
              _buildTextField(_namaWifiController, 'Nama WiFi', 'Masukkan nama WiFi'),
              const SizedBox(height: 12),
              _buildTextField(_passwordWifiController, 'Password WiFi', 'Masukkan password WiFi'),
              const SizedBox(height: 12),
              _buildTextField(_tanggalController, 'Tanggal Pemasangan', 'Masukkan tanggal pemasangan'),
              const SizedBox(height: 20),
            ],
          ),
        ),
      ),
      Container(
        padding: const EdgeInsets.all(20),
        child: Row(
          mainAxisAlignment: MainAxisAlignment.end,
          children: [
    TextButton(
  onPressed: () {
    final navigator = Navigator.of(context);
    navigator.pop();
    Future.delayed(const Duration(milliseconds: 300), () {
      showModalBottomSheet(
        context: navigator.context,
        isScrollControlled: true,
        isDismissible: false,
        backgroundColor: Colors.transparent,
        builder: (ctx) => const BiodataPopup(),
      );
    });
  },
  style: TextButton.styleFrom(
    padding: const EdgeInsets.symmetric(horizontal: 20, vertical: 10),
  ),
  child: Text('Kembali', style: TextStyle(color: Colors.grey[700])),
),


            const SizedBox(width: 8),
            ElevatedButton(
              onPressed: () {
                Navigator.pop(context);
                ScaffoldMessenger.of(context).showSnackBar(
                  const SnackBar(
                    content: Text('Data pemasangan berhasil disimpan!'),
                    backgroundColor: Colors.green,
                  ),
                );
              },
              style: ElevatedButton.styleFrom(
                backgroundColor: Colors.blue,
                padding: const EdgeInsets.symmetric(horizontal: 24, vertical: 10),
                shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(8)),
              ),
              child: const Text('Simpan', style: TextStyle(fontSize: 13)),
            ),
          ],
        ),
      ),
    ],
  ),
),

    );
  }

  Widget _buildDropdownField() {
    return Column(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        const Text('Paket Layanan', style: TextStyle(fontSize: 12, fontWeight: FontWeight.w500)),
        const SizedBox(height: 6),
        Container(
          height: 45,
          padding: const EdgeInsets.symmetric(horizontal: 12),
          decoration: BoxDecoration(
            border: Border.all(color: Colors.grey[400]!),
            borderRadius: BorderRadius.circular(4),
          ),
          child: DropdownButtonHideUnderline(
            child: DropdownButton<String>(
              value: selectedPaket,
              hint: const Text('Pilih paket layanan', style: TextStyle(fontSize: 14, color: Colors.grey)),
              isExpanded: true,
              icon: const Icon(Icons.keyboard_arrow_down, size: 20),
              items: paketOptions.map((String value) {
                return DropdownMenuItem<String>(
                  value: value,
                  child: Text(value, style: const TextStyle(fontSize: 14)),
                );
              }).toList(),
              onChanged: (String? newValue) {
                setState(() => selectedPaket = newValue);
              },
            ),
          ),
        ),
      ],
    );
  }

  Widget _buildTextField(TextEditingController controller, String label, String hint) {
    return Column(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        Text(label, style: const TextStyle(fontSize: 12, fontWeight: FontWeight.w500)),
        const SizedBox(height: 6),
        Container(
          height: 45,
          decoration: BoxDecoration(
            border: Border.all(color: Colors.grey[400]!),
            borderRadius: BorderRadius.circular(4),
          ),
          child: TextField(
            controller: controller,
            decoration: InputDecoration(
              hintText: hint,
              border: InputBorder.none,
              contentPadding: const EdgeInsets.symmetric(horizontal: 12, vertical: 12),
            ),
          ),
        ),
      ],
    );
  }
}
