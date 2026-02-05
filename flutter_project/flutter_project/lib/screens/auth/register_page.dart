import 'package:flutter/material.dart';
import '../../widgets/auth_template.dart';

class RegisterPage extends StatelessWidget {
  const RegisterPage({super.key});
  @override
  Widget build(BuildContext context) {
    return AuthTemplate(
      title: "REGISTER",
      buttonText: "DAFTAR",
      onButtonPressed: () {},
      children: [
        const TextField(decoration: InputDecoration(fillColor: Colors.white, filled: true, hintText: "Nomor WhatsApp")),
        const SizedBox(height: 10),
        const TextField(decoration: InputDecoration(fillColor: Colors.white, filled: true, hintText: "Nama")),
        const SizedBox(height: 10),
        const TextField(decoration: InputDecoration(fillColor: Colors.white, filled: true, hintText: "Password")),
        const SizedBox(height: 10),
        const TextField(decoration: InputDecoration(fillColor: Colors.white, filled: true, hintText: "Konfirmasi Password")),
      ],
    );
  }
}