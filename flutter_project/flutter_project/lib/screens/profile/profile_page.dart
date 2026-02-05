import 'package:flutter/material.dart';
import 'edit_name_page.dart';
import 'edit_password_page.dart';
import 'edit_phone_page.dart';

class ProfilePage extends StatefulWidget {
  const ProfilePage({super.key});

  @override
  State<ProfilePage> createState() => _ProfilePageState();
}

class _ProfilePageState extends State<ProfilePage> {
  String name = 'Qinthara';
  String phone = '***********28';

  void _changeProfilePhoto() {
    // Fungsi untuk ganti foto profile
    showDialog(
      context: context,
      builder: (context) => AlertDialog(
        title: const Text('Ubah Foto Profile'),
        content: const Text('Fitur ganti foto akan segera hadir'),
        actions: [
          TextButton(
            onPressed: () => Navigator.pop(context),
            child: const Text('OK'),
          ),
        ],
      ),
    );
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: Colors.grey[50],
      appBar: AppBar(
        backgroundColor: Colors.white,
        elevation: 0,
        leading: IconButton(
          icon: const Icon(Icons.arrow_back, color: Colors.deepOrange),
          onPressed: () => Navigator.pop(context),
        ),
        title: const Text('Ubah Profil', style: TextStyle(color: Colors.black, fontSize: 18)),
        centerTitle: true,
      ),
      body: Column(
        children: [
          const SizedBox(height: 20),
          Container(
            margin: const EdgeInsets.symmetric(horizontal: 16),
            padding: const EdgeInsets.all(24),
            decoration: BoxDecoration(
              color: Colors.white,
              borderRadius: BorderRadius.circular(12),
            ),
            child: Column(
              children: [
                GestureDetector(
                  onTap: _changeProfilePhoto,
                  child: Container(
                    width: 100,
                    height: 100,
                    decoration: BoxDecoration(
                      shape: BoxShape.circle,
                      color: Colors.grey[200],
                      border: Border.all(color: Colors.grey[300]!, width: 2),
                    ),
                    child: const Icon(Icons.person, size: 50, color: Colors.deepOrange),
                  ),
                ),
                const SizedBox(height: 12),
                GestureDetector(
                  onTap: _changeProfilePhoto,
                  child: Row(
                    mainAxisAlignment: MainAxisAlignment.center,
                    children: [
                      Icon(Icons.edit, size: 16, color: Colors.grey[600]),
                      const SizedBox(width: 4),
                      Text('Ubah', style: TextStyle(color: Colors.grey[600], fontSize: 14)),
                    ],
                  ),
                ),
              ],
            ),
          ),
          const SizedBox(height: 16),
          Container(
            margin: const EdgeInsets.symmetric(horizontal: 16),
            decoration: BoxDecoration(
              color: Colors.white,
              borderRadius: BorderRadius.circular(12),
            ),
            child: Column(
              children: [
                _buildProfileItem('Nama', name, () async {
                  final result = await Navigator.push(
                    context,
                    MaterialPageRoute(builder: (context) => EditNamePage(currentName: name)),
                  );
                  if (result != null) setState(() => name = result);
                }),
                Divider(height: 1, color: Colors.grey[200]),
                _buildProfileItem('Password', '••••••••', () {
                  Navigator.push(
                    context,
                    MaterialPageRoute(builder: (context) => const EditPasswordPage()),
                  );
                }),
                Divider(height: 1, color: Colors.grey[200]),
                _buildProfileItem('No. Handphone', phone, () async {
                  final result = await Navigator.push(
                    context,
                    MaterialPageRoute(builder: (context) => EditPhonePage(currentPhone: phone)),
                  );
                  if (result != null) setState(() => phone = result);
                }),
              ],
            ),
          ),
        ],
      ),
    );
  }

  Widget _buildProfileItem(String label, String value, VoidCallback onTap) {
    return InkWell(
      onTap: onTap,
      child: Padding(
        padding: const EdgeInsets.symmetric(horizontal: 16, vertical: 16),
        child: Row(
          mainAxisAlignment: MainAxisAlignment.spaceBetween,
          children: [
            Text(label, style: const TextStyle(fontSize: 15, color: Colors.black)),
            Row(
              children: [
                Text(value, style: TextStyle(fontSize: 15, color: Colors.grey[600])),
                const SizedBox(width: 8),
                Icon(Icons.chevron_right, color: Colors.grey[400], size: 20),
              ],
            ),
          ],
        ),
      ),
    );
  }
}
