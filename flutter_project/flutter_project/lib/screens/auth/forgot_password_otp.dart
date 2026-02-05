import 'package:flutter/material.dart';
import '../../widgets/auth_template.dart';

class ForgotPasswordOTP extends StatelessWidget {
  const ForgotPasswordOTP({super.key});
  @override
  Widget build(BuildContext context) {
    return AuthTemplate(
      title: "FORGOT PASSWORD (OTP)",
      buttonText: "VERIFIKASI",
      onButtonPressed: () {},
      children: [
        const Text("Masukkan 6 Digit Kode OTP", style: TextStyle(fontSize: 12)),
        const SizedBox(height: 15),
        Row(
          mainAxisAlignment: MainAxisAlignment.spaceEvenly,
          children: List.generate(6, (index) => Container(
            width: 35,
            height: 40,
            color: Colors.white,
            child: const TextField(textAlign: TextAlign.center, keyboardType: TextInputType.number),
          )),
        ),
      ],
    );
  }
}