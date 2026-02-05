import 'package:flutter/material.dart';
import '../../widgets/auth_template.dart';

class LoginPage extends StatelessWidget {
  const LoginPage({super.key});
  @override
  Widget build(BuildContext context) {
    return AuthTemplate(
      title: "LOGIN",
      buttonText: "LOGIN",
      onButtonPressed: () {},
      children: [
        const TextField(decoration: InputDecoration(fillColor: Colors.white, filled: true, hintText: "Nomor WhatsApp")),
        const SizedBox(height: 15),
        const TextField(decoration: InputDecoration(fillColor: Colors.white, filled: true, hintText: "Password")),
      ],
    );
  }
}