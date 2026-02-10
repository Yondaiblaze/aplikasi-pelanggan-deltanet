// lib/widgets/biodata_popup.dart
import 'package:flutter/material.dart';
import 'package:image_picker/image_picker.dart';
import 'dart:io';
import 'pemasangan_popup.dart';

class BiodataPopup extends StatefulWidget {
  const BiodataPopup({super.key});

  @override
  State<BiodataPopup> createState() => _BiodataPopupState();
}

class _BiodataPopupState extends State<BiodataPopup> {
  final _namaController = TextEditingController();
  final _noIdentitasController = TextEditingController();
  final _alamatController = TextEditingController();
  final _patokanController = TextEditingController();
  final _noWaController = TextEditingController();
  final _koordinatController = TextEditingController();
  String? _lokasiMaps;
  File? _fotoRumah;
  File? _fotoIdentitas;

  @override
  void dispose() {
    _namaController.dispose();
    _noIdentitasController.dispose();
    _alamatController.dispose();
    _patokanController.dispose();
    _noWaController.dispose();
    _koordinatController.dispose();
    super.dispose();
  }

  Future<void> _pilihFoto(bool isRumah) async {
    final source = await showModalBottomSheet<ImageSource>(
      context: context,
      builder: (context) => Column(
        mainAxisSize: MainAxisSize.min,
        children: [
          ListTile(
            leading: const Icon(Icons.camera_alt),
            title: const Text('Kamera'),
            onTap: () => Navigator.pop(context, ImageSource.camera),
          ),
          ListTile(
            leading: const Icon(Icons.photo_library),
            title: const Text('Galeri'),
            onTap: () => Navigator.pop(context, ImageSource.gallery),
          ),
        ],
      ),
    );
    if (source != null) {
      final file = await ImagePicker().pickImage(source: source);
      if (file != null) {
        setState(() => isRumah ? _fotoRumah = File(file.path) : _fotoIdentitas = File(file.path));
      }
    }
  }

  @override
  Widget build(BuildContext context) {
    return Material(
      color: Colors.transparent,
      child: Container(
        height: MediaQuery.of(context).size.height * 0.9,
        decoration: const BoxDecoration(
          color: Colors.white,
          borderRadius: BorderRadius.vertical(top: Radius.circular(20)),
        ),
        child: Column(
          children: [
            Container(
              margin: const EdgeInsets.only(top: 12, bottom: 16),
              width: 40,
              height: 4,
              decoration: BoxDecoration(color: Colors.grey[300], borderRadius: BorderRadius.circular(2)),
            ),
          Expanded(
  child: SingleChildScrollView(
    padding: const EdgeInsets.symmetric(horizontal: 20),
    child: Column(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        const Center(
          child: Text(
            'Biodata Lengkap',
            style: TextStyle(
              fontSize: 18,
              fontWeight: FontWeight.bold,
              color: Colors.black,
            ),
          ),
        ),

                    const SizedBox(height: 16),
                    const Text('Nama', style: TextStyle(fontSize: 12, fontWeight: FontWeight.w500)),
                    const SizedBox(height: 6),
                    _buildTextField(_namaController, 'Masukkan nama'),
                    const SizedBox(height: 12),
                    const Text('Kontak', style: TextStyle(fontSize: 12, fontWeight: FontWeight.w500)),
                    const SizedBox(height: 6),
                    _buildTextField(_noWaController, 'Masukkan kontak'),
                    const SizedBox(height: 12),
                    const Text('Alamat', style: TextStyle(fontSize: 12, fontWeight: FontWeight.w500)),
                    const SizedBox(height: 6),
                    _buildTextField(_alamatController, 'Masukkan alamat'),
                    const SizedBox(height: 12),
                    const Text('NIK', style: TextStyle(fontSize: 12, fontWeight: FontWeight.w500)),
                    const SizedBox(height: 6),
                    _buildTextField(_noIdentitasController, 'Masukkan NIK'),
                    const SizedBox(height: 12),
                    const Text('Patokan Rumah', style: TextStyle(fontSize: 12, fontWeight: FontWeight.w500)),
                    const SizedBox(height: 6),
                    _buildTextField(_patokanController, 'Masukkan patokan rumah'),
                    const SizedBox(height: 20),
                    const Text('Maps', style: TextStyle(fontSize: 12, fontWeight: FontWeight.w500)),
                    const SizedBox(height: 6),
                    Container(
                      height: 120,
                      decoration: BoxDecoration(
                        color: Colors.grey[300],
                        borderRadius: BorderRadius.circular(8),
                      ),
                      child: Center(
                        child: _lokasiMaps == null
                            ? const Icon(Icons.map, size: 40, color: Colors.grey)
                            : Padding(
                                padding: const EdgeInsets.all(12),
                                child: Column(
                                  mainAxisAlignment: MainAxisAlignment.center,
                                  children: [
                                    const Icon(Icons.location_on, size: 30, color: Colors.red),
                                    const SizedBox(height: 8),
                                    Text(
                                      _lokasiMaps!,
                                      textAlign: TextAlign.center,
                                      style: const TextStyle(fontSize: 12),
                                      maxLines: 3,
                                      overflow: TextOverflow.ellipsis,
                                    ),
                                  ],
                                ),
                              ),
                      ),
                    ),
                    const SizedBox(height: 12),
                    const Text('Koordinat', style: TextStyle(fontSize: 12, fontWeight: FontWeight.w500)),
                    const SizedBox(height: 6),
                    _buildTextField(_koordinatController, 'Latitude, Longitude (contoh: -6.200000, 106.816666)'),
                    const SizedBox(height: 8),
                    Align(
                      alignment: Alignment.centerRight,
                      child: ElevatedButton(
                        onPressed: () {
                          if (_koordinatController.text.isNotEmpty) {
                            setState(() {
                              _lokasiMaps = _koordinatController.text;
                            });
                          }
                        },
                        style: ElevatedButton.styleFrom(
                          backgroundColor: Colors.blue,
                          padding: const EdgeInsets.symmetric(horizontal: 20, vertical: 8),
                          shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(6)),
                        ),
                        child: const Text('Submit', style: TextStyle(fontSize: 12)),
                      ),
                    ),
                    const SizedBox(height: 20),
                    Row(
                      children: [
                        Expanded(child: _buildFotoBox('Foto Rumah', _fotoRumah, () => _pilihFoto(true))),
                        const SizedBox(width: 12),
                        Expanded(child: _buildFotoBox('Foto Identitas', _fotoIdentitas, () => _pilihFoto(false))),
                      ],
                    ),
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
                    onPressed: () => Navigator.pop(context),
                    style: TextButton.styleFrom(
                      padding: const EdgeInsets.symmetric(horizontal: 20, vertical: 10),
                    ),
                    child: Text('Batal', style: TextStyle(color: Colors.grey[700])),
                  ),
                  const SizedBox(width: 8),
   ElevatedButton(
  onPressed: () {
    final navigator = Navigator.of(context);
    navigator.pop();
    Future.delayed(const Duration(milliseconds: 300), () {
      showModalBottomSheet(
        context: navigator.context,
        isScrollControlled: true,
        isDismissible: false,
        backgroundColor: Colors.transparent,
        builder: (ctx) => const PemasanganPopup(),
      );
    });
  },
  style: ElevatedButton.styleFrom(
    backgroundColor: Colors.blue,
    padding: const EdgeInsets.symmetric(horizontal: 24, vertical: 10),
    shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(8)),
  ),
  child: const Text('Selanjutnya', style: TextStyle(fontSize: 13)),
)


                ],
              ),
            ),
          ],
        ),
      ),
    );
  }

  Widget _buildTextField(TextEditingController controller, String hint) {
    return Container(
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
    );
  }

  Widget _buildFotoBox(String label, File? foto, VoidCallback onTap) {
    return Column(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        Text(label, style: const TextStyle(fontSize: 12, fontWeight: FontWeight.w500)),
        const SizedBox(height: 8),
        InkWell(
          onTap: onTap,
          child: Container(
            height: 100,
            decoration: BoxDecoration(
              color: Colors.blue[100],
              borderRadius: BorderRadius.circular(8),
            ),
            child: foto == null
                ? const Center(child: Icon(Icons.add_photo_alternate, size: 32, color: Colors.white))
                : ClipRRect(
                    borderRadius: BorderRadius.circular(8),
                    child: Image.file(foto, fit: BoxFit.cover, width: double.infinity),
                  ),
          ),
        ),
      ],
    );
  }
}
