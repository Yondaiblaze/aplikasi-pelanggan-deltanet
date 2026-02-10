import 'package:flutter/material.dart';
import '../../widgets/auth_template.dart';

class ForgotPasswordPage extends StatelessWidget {
  const ForgotPasswordPage({super.key});
  
  @override
  Widget build(BuildContext context) {
    final phoneController = TextEditingController();
    
    return AuthTemplate(
      title: "FORGOT PASSWORD",
      buttonText: "KIRIM OTP",
      onButtonPressed: () {},
      children: [
        const Text('Nomor WhatsApp', style: TextStyle(fontSize: 12, fontWeight: FontWeight.w500)),
        const SizedBox(height: 6),
        TextField(
          controller: phoneController,
          keyboardType: TextInputType.phone,
          decoration: InputDecoration(
            hintText: 'Masukkan nomor WhatsApp',
            fillColor: Colors.white,
            filled: true,
            border: OutlineInputBorder(borderRadius: BorderRadius.circular(8)),
            contentPadding: const EdgeInsets.symmetric(horizontal: 12, vertical: 14),
          ),
        ),
      ],
    );
  }
}
