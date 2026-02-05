import 'package:flutter/material.dart';
import 'screens/dashboard/dashboard_page.dart';
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
