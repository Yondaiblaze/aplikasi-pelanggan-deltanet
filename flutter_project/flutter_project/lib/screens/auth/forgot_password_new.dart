import 'package:flutter/material.dart';
import '../../widgets/auth_template.dart';

class ForgotPasswordNew extends StatelessWidget {
  const ForgotPasswordNew({super.key});
  @override
  Widget build(BuildContext context) {
    return AuthTemplate(
      title: "FORGOT PASSWORD (BARU)",
      buttonText: "SIMPAN PASSWORD",
      onButtonPressed: () {},
      children: [
        const TextField(decoration: InputDecoration(fillColor: Colors.white, filled: true, hintText: "Password Baru")),
        const SizedBox(height: 15),
        const TextField(decoration: InputDecoration(fillColor: Colors.white, filled: true, hintText: "Konfirmasi Password Baru")),
      ],
    );
  }
}