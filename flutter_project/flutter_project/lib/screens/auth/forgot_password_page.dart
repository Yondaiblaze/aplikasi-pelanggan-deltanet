import 'package:flutter/material.dart';
import '../../widgets/auth_template.dart';

class ForgotPasswordPage extends StatelessWidget {
  const ForgotPasswordPage({super.key});
  @override
  Widget build(BuildContext context) {
    return AuthTemplate(
      title: "FORGOT PASSWORD",
      buttonText: "KIRIM OTP",
      onButtonPressed: () {},
      children: [
        const TextField(decoration: InputDecoration(fillColor: Colors.white, filled: true, hintText: "Nomor WhatsApp")),
      ],
    );
  }
}