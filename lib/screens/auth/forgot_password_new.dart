import 'package:flutter/material.dart';
import '../../widgets/auth_template.dart';

class ForgotPasswordNew extends StatefulWidget {
  const ForgotPasswordNew({super.key});

  @override
  State<ForgotPasswordNew> createState() => _ForgotPasswordNewState();
}

class _ForgotPasswordNewState extends State<ForgotPasswordNew> {
  bool _obscurePassword = true;
  bool _obscureConfirm = true;

  @override
  Widget build(BuildContext context) {
    return AuthTemplate(
      title: "FORGOT PASSWORD (BARU)",
      buttonText: "SIMPAN PASSWORD",
      onButtonPressed: () {},
      children: [
        const Text('Password Baru', style: TextStyle(fontSize: 12, fontWeight: FontWeight.w500)),
        const SizedBox(height: 6),
        TextField(
          obscureText: _obscurePassword,
          decoration: InputDecoration(
            fillColor: Colors.white,
            filled: true,
            hintText: "Masukkan password baru",
            prefixIcon: const Icon(Icons.lock_outline, size: 20),
            suffixIcon: IconButton(
              icon: Icon(_obscurePassword ? Icons.visibility_off : Icons.visibility, size: 20),
              onPressed: () => setState(() => _obscurePassword = !_obscurePassword),
            ),
            border: OutlineInputBorder(borderRadius: BorderRadius.circular(8)),
            contentPadding: const EdgeInsets.symmetric(horizontal: 12, vertical: 14),
          ),
        ),
        const SizedBox(height: 15),
        const Text('Konfirmasi Password Baru', style: TextStyle(fontSize: 12, fontWeight: FontWeight.w500)),
        const SizedBox(height: 6),
        TextField(
          obscureText: _obscureConfirm,
          decoration: InputDecoration(
            fillColor: Colors.white,
            filled: true,
            hintText: "Masukkan konfirmasi password",
            prefixIcon: const Icon(Icons.lock_outline, size: 20),
            suffixIcon: IconButton(
              icon: Icon(_obscureConfirm ? Icons.visibility_off : Icons.visibility, size: 20),
              onPressed: () => setState(() => _obscureConfirm = !_obscureConfirm),
            ),
            border: OutlineInputBorder(borderRadius: BorderRadius.circular(8)),
            contentPadding: const EdgeInsets.symmetric(horizontal: 12, vertical: 14),
          ),
        ),
      ],
    );
  }
}
