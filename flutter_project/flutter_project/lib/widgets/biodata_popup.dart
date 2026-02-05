// lib/widgets/biodata_popup.dart
import 'package:flutter/material.dart';
import 'package:flutter/services.dart';
import 'package:image_picker/image_picker.dart';
import 'dart:io';

class BiodataPopup extends StatefulWidget {
  const BiodataPopup({super.key});

  @override
  State<BiodataPopup> createState() => _BiodataPopupState();
}

class _BiodataPopupState extends State<BiodataPopup> {
  final _formKey = GlobalKey<FormState>();
  final _namaController = TextEditingController();
  final _noIdentitasController = TextEditingController();
  final _alamatController = TextEditingController();
  final _patokanController = TextEditingController();
  final _tempatLahirController = TextEditingController();
  final _noWaController = TextEditingController();
  final _emailController = TextEditingController();
  
  DateTime? _tanggalLahir;
  File? _fotoRumah;
  File? _fotoIdentitas;

  @override
  void dispose() {
    _namaController.dispose();
    _noIdentitasController.dispose();
    _alamatController.dispose();
    _patokanController.dispose();
    _tempatLahirController.dispose();
    _noWaController.dispose();
    _emailController.dispose();
    super.dispose();
  }

  Future<void> _pilihTanggal() async {
    final picked = await showDatePicker(
      context: context,
      initialDate: DateTime(2000),
      firstDate: DateTime(1950),
      lastDate: DateTime.now(),
    );
    if (picked != null) setState(() => _tanggalLahir = picked);
  }

  Future<void> _pilihFoto(bool isRumah) async {
    final picker = ImagePicker();
    final source = await showModalBottomSheet<ImageSource>(
      context: context,
      shape: const RoundedRectangleBorder(
        borderRadius: BorderRadius.vertical(top: Radius.circular(20)),
      ),
      builder: (context) => Container(
        padding: const EdgeInsets.all(20),
        child: Column(
          mainAxisSize: MainAxisSize.min,
          children: [
            ListTile(
              leading: const Icon(Icons.camera_alt, color: Colors.pink),
              title: const Text('Kamera'),
              onTap: () => Navigator.pop(context, ImageSource.camera),
            ),
            ListTile(
              leading: const Icon(Icons.photo_library, color: Colors.pink),
              title: const Text('Galeri'),
              onTap: () => Navigator.pop(context, ImageSource.gallery),
            ),
          ],
        ),
      ),
    );

    if (source != null) {
      final pickedFile = await picker.pickImage(source: source);
      if (pickedFile != null) {
        setState(() {
          if (isRumah) {
            _fotoRumah = File(pickedFile.path);
          } else {
            _fotoIdentitas = File(pickedFile.path);
          }
        });
      }
    }
  }

  @override
  Widget build(BuildContext context) {
    return Dialog(
      shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(20)),
      insetPadding: const EdgeInsets.all(16),
      child: Container(
        constraints: const BoxConstraints(maxHeight: 700),
        child: Column(
          mainAxisSize: MainAxisSize.min,
          children: [
            // Header
            Container(
              padding: const EdgeInsets.all(20),
              decoration: BoxDecoration(
                gradient: const LinearGradient(
                  colors: [Color(0xFF8B0051), Color(0xFF4A0080)],
                ),
                borderRadius: const BorderRadius.vertical(top: Radius.circular(20)),
              ),
              child: Row(
                children: [
                  Container(
                    padding: const EdgeInsets.all(10),
                    decoration: BoxDecoration(
                      color: Colors.white.withOpacity(0.2),
                      borderRadius: BorderRadius.circular(12),
                    ),
                    child: const Icon(Icons.person_add, color: Colors.white, size: 28),
                  ),
                  const SizedBox(width: 12),
                  const Expanded(
                    child: Column(
                      crossAxisAlignment: CrossAxisAlignment.start,
                      children: [
                        Text('Lengkapi Biodata', 
                          style: TextStyle(fontSize: 20, fontWeight: FontWeight.bold, color: Colors.white)),
                        SizedBox(height: 4),
                        Text('Isi data diri Anda dengan lengkap', 
                          style: TextStyle(color: Colors.white70, fontSize: 13)),
                      ],
                    ),
                  ),
                ],
              ),
            ),

            // Form Content
            Expanded(
              child: SingleChildScrollView(
                padding: const EdgeInsets.all(20),
                child: Form(
                  key: _formKey,
                  child: Column(
                    crossAxisAlignment: CrossAxisAlignment.start,
                    children: [
                      _buildTextField(
                        controller: _namaController,
                        label: '1. Nama Lengkap',
                        hint: 'Masukkan nama lengkap',
                        icon: Icons.person,
                      ),
                      const SizedBox(height: 16),
                      
                      _buildTextField(
                        controller: _noIdentitasController,
                        label: '2. No. SIM/KTP/Kartu Pelajar',
                        hint: 'Masukkan nomor identitas',
                        icon: Icons.credit_card,
                        keyboardType: TextInputType.number,
                      ),
                      const SizedBox(height: 16),
                      
                      _buildTextField(
                        controller: _alamatController,
                        label: '3. Alamat',
                        hint: 'Masukkan alamat lengkap',
                        icon: Icons.home,
                        maxLines: 2,
                      ),
                      const SizedBox(height: 16),
                      
                      _buildTextField(
                        controller: _patokanController,
                        label: '4. Patokan Rumah',
                        hint: 'Contoh: Dekat Indomaret',
                        icon: Icons.location_on,
                      ),
                      const SizedBox(height: 16),
                      
                      const Text('5. Tempat Tanggal Lahir', 
                        style: TextStyle(fontWeight: FontWeight.w600, fontSize: 13)),
                      const SizedBox(height: 8),
                      Row(
                        children: [
                          Expanded(
                            flex: 2,
                            child: TextField(
                              controller: _tempatLahirController,
                              decoration: InputDecoration(
                                hintText: 'Tempat lahir',
                                prefixIcon: const Icon(Icons.place, size: 20),
                                border: OutlineInputBorder(borderRadius: BorderRadius.circular(12)),
                                filled: true,
                                fillColor: Colors.grey[50],
                                contentPadding: const EdgeInsets.symmetric(horizontal: 12, vertical: 14),
                              ),
                            ),
                          ),
                          const SizedBox(width: 8),
                          Expanded(
                            flex: 2,
                            child: InkWell(
                              onTap: _pilihTanggal,
                              child: InputDecorator(
                                decoration: InputDecoration(
                                  prefixIcon: const Icon(Icons.calendar_today, size: 20),
                                  border: OutlineInputBorder(borderRadius: BorderRadius.circular(12)),
                                  filled: true,
                                  fillColor: Colors.grey[50],
                                  contentPadding: const EdgeInsets.symmetric(horizontal: 12, vertical: 14),
                                ),
                                child: Text(
                                  _tanggalLahir == null 
                                    ? 'Tanggal' 
                                    : '${_tanggalLahir!.day}/${_tanggalLahir!.month}/${_tanggalLahir!.year}',
                                  style: TextStyle(
                                    color: _tanggalLahir == null ? Colors.grey : Colors.black,
                                    fontSize: 14,
                                  ),
                                ),
                              ),
                            ),
                          ),
                        ],
                      ),
                      const SizedBox(height: 16),
                      
                      _buildTextField(
                        controller: _noWaController,
                        label: '6. No. WhatsApp',
                        hint: '08xxxxxxxxxx',
                        icon: Icons.phone,
                        keyboardType: TextInputType.phone,
                      ),
                      const SizedBox(height: 16),
                      
                      _buildTextField(
                        controller: _emailController,
                        label: '7. Email',
                        hint: 'contoh@email.com',
                        icon: Icons.email,
                        keyboardType: TextInputType.emailAddress,
                      ),
                      const SizedBox(height: 16),
                      
                      _buildFotoUpload(
                        label: '8. Foto Rumah',
                        foto: _fotoRumah,
                        onTap: () => _pilihFoto(true),
                      ),
                      const SizedBox(height: 16),
                      
                      _buildFotoUpload(
                        label: '9. Foto No. SIM/KTP/Kartu Pelajar',
                        foto: _fotoIdentitas,
                        onTap: () => _pilihFoto(false),
                      ),
                    ],
                  ),
                ),
              ),
            ),

            // Footer Button
            Container(
              padding: const EdgeInsets.all(20),
              decoration: BoxDecoration(
                color: Colors.white,
                boxShadow: [
                  BoxShadow(
                    color: Colors.black.withOpacity(0.05),
                    blurRadius: 10,
                    offset: const Offset(0, -2),
                  ),
                ],
              ),
              child: SizedBox(
                width: double.infinity,
                child: ElevatedButton(
                  onPressed: () {
                    Navigator.pop(context);
                    ScaffoldMessenger.of(context).showSnackBar(
                      const SnackBar(
                        content: Text('Biodata berhasil disimpan!'),
                        backgroundColor: Colors.green,
                      ),
                    );
                  },
                  style: ElevatedButton.styleFrom(
                    backgroundColor: Colors.pink,
                    foregroundColor: Colors.white,
                    padding: const EdgeInsets.symmetric(vertical: 16),
                    shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(12)),
                    elevation: 0,
                  ),
                  child: const Text('Simpan Biodata', 
                    style: TextStyle(fontWeight: FontWeight.bold, fontSize: 16)),
                ),
              ),
            ),
          ],
        ),
      ),
    );
  }

  Widget _buildTextField({
    required TextEditingController controller,
    required String label,
    required String hint,
    required IconData icon,
    TextInputType? keyboardType,
    int maxLines = 1,
  }) {
    return Column(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        Text(label, style: const TextStyle(fontWeight: FontWeight.w600, fontSize: 13)),
        const SizedBox(height: 8),
        TextField(
          controller: controller,
          keyboardType: keyboardType,
          maxLines: maxLines,
          decoration: InputDecoration(
            hintText: hint,
            prefixIcon: Icon(icon, size: 20),
            border: OutlineInputBorder(borderRadius: BorderRadius.circular(12)),
            filled: true,
            fillColor: Colors.grey[50],
            contentPadding: const EdgeInsets.symmetric(horizontal: 12, vertical: 14),
          ),
        ),
      ],
    );
  }

  Widget _buildFotoUpload({
    required String label,
    required File? foto,
    required VoidCallback onTap,
  }) {
    return Column(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        Text(label, style: const TextStyle(fontWeight: FontWeight.w600, fontSize: 13)),
        const SizedBox(height: 8),
        InkWell(
          onTap: onTap,
          child: Container(
            height: 120,
            decoration: BoxDecoration(
              color: Colors.grey[50],
              borderRadius: BorderRadius.circular(12),
              border: Border.all(color: Colors.grey[300]!),
            ),
            child: foto == null
              ? Column(
                  mainAxisAlignment: MainAxisAlignment.center,
                  children: [
                    Icon(Icons.add_photo_alternate, size: 40, color: Colors.grey[400]),
                    const SizedBox(height: 8),
                    Text('Tap untuk upload foto', 
                      style: TextStyle(color: Colors.grey[600], fontSize: 13)),
                  ],
                )
              : ClipRRect(
                  borderRadius: BorderRadius.circular(12),
                  child: Image.file(foto, fit: BoxFit.cover, width: double.infinity),
                ),
          ),
        ),
      ],
    );
  }
}
