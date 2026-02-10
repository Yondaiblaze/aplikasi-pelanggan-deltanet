import 'package:flutter/material.dart';
import 'package:flutter_project/screens/auth/login_page.dart';
import 'screens/dashboard/dashboard_page.dart';
import 'screens/auth/register_page.dart';
import 'screens/auth/forgot_password_page.dart';
import 'screens/auth/forgot_password_otp.dart';
import 'screens/auth/forgot_password_new.dart';
import 'widgets/biodata_popup.dart';
import 'widgets/pemasangan_popup.dart';

void main() => runApp(const MyApp());

class MyApp extends StatelessWidget {
  const MyApp({super.key});

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      debugShowCheckedModeBanner: false,
      title: 'DeltaNet',
      theme: ThemeData(
        useMaterial3: true,
        colorScheme: ColorScheme.fromSeed(seedColor: Colors.pink),
        scaffoldBackgroundColor: Colors.grey[50],
      ),
      home: const DashboardPage(),
    );
  }
}
