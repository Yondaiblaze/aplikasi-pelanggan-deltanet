import 'package:flutter/material.dart';

class AuthTemplate extends StatelessWidget {
  final String title;
  final List<Widget> children;
  final String buttonText;
  final VoidCallback onButtonPressed;

  const AuthTemplate({
    super.key,
    required this.title,
    required this.children,
    required this.buttonText,
    required this.onButtonPressed,
  });

  @override
  Widget build(BuildContext context) {
    // Mengambil ukuran layar
    final size = MediaQuery.of(context).size;
    final bool isSmallScreen = size.width < 600;

    return Scaffold(
      // Background dibuat sedikit off-white agar Card lebih menonjol
      backgroundColor: const Color(0xFFF8FAFC),
      body: SafeArea(
        child: Center(
          child: SingleChildScrollView(
            // Padding dinamis agar di HP tidak terlalu mepet pinggir
            padding: EdgeInsets.symmetric(horizontal: isSmallScreen ? 20 : 40),
            child: Column(
              mainAxisAlignment: MainAxisAlignment.center,
              children: [
                const SizedBox(height: 20),
                // --- LOGO (Ukuran dinamis sesuai layar) ---
                Row(
                  mainAxisAlignment: MainAxisAlignment.center,
                  children: [
                    Icon(
                      Icons.speed_rounded, 
                      color: const Color(0xFF003399), 
                      size: isSmallScreen ? 45 : 55
                    ),
                    const SizedBox(width: 10),
                    RichText(
                      text: TextSpan(
                        style: TextStyle(
                          fontSize: isSmallScreen ? 36 : 46, 
                          fontWeight: FontWeight.w900,
                          fontFamily: 'sans-serif',
                        ),
                        children: const [
                          TextSpan(text: 'Delta', style: TextStyle(color: Color(0xFF003399))),
                          TextSpan(text: 'Net', style: TextStyle(color: Colors.orange)),
                        ],
                      ),
                    ),
                  ],
                ),
                
                const SizedBox(height: 40),

                // --- CARD UTAMA ---
                Container(
                  constraints: const BoxConstraints(maxWidth: 420),
                  decoration: BoxDecoration(
                    color: const Color(0xFFE2E8F0), // Abu-abu Slate yang lebih bersih
                    borderRadius: BorderRadius.circular(16),
                    boxShadow: [
                      BoxShadow(
                        color: Colors.black.withOpacity(0.06),
                        blurRadius: 15,
                        offset: const Offset(0, 8),
                      ),
                    ],
                  ),
                  child: Column(
                    mainAxisSize: MainAxisSize.min,
                    children: [
                      // Header Card Gelap
                      Container(
                        width: double.infinity,
                        padding: const EdgeInsets.symmetric(vertical: 18),
                        decoration: const BoxDecoration(
                          color: Color(0xFF334155), // Slate gelap (lebih modern dari grey puro)
                          borderRadius: BorderRadius.only(
                            topLeft: Radius.circular(16),
                            topRight: Radius.circular(16),
                          ),
                        ),
                        child: Text(
                          title,
                          textAlign: TextAlign.center,
                          style: const TextStyle(
                            color: Colors.white,
                            fontSize: 16,
                            fontWeight: FontWeight.w700,
                            letterSpacing: 2.0,
                          ),
                        ),
                      ),
                      
                      // Isi Form
                      Padding(
                        padding: const EdgeInsets.fromLTRB(25, 35, 25, 40),
                        child: Column(
                          children: [
                            // Input styling seragam
                            Theme(
                              data: Theme.of(context).copyWith(
                                inputDecorationTheme: InputDecorationTheme(
                                  filled: true,
                                  fillColor: Colors.white,
                                  contentPadding: const EdgeInsets.all(18),
                                  // Border tipis agar terlihat rapi di layar HP
                                  enabledBorder: OutlineInputBorder(
                                    borderRadius: BorderRadius.circular(12),
                                    borderSide: BorderSide(color: Colors.grey.shade200),
                                  ),
                                  focusedBorder: OutlineInputBorder(
                                    borderRadius: BorderRadius.circular(12),
                                    borderSide: const BorderSide(color: Color(0xFF6A9CFD), width: 2),
                                  ),
                                  hintStyle: TextStyle(color: Colors.grey.shade400, fontSize: 14),
                                ),
                              ),
                              child: Column(
                                children: children.map((widget) {
                                  // Menambah jarak otomatis antar widget di dalam list
                                  return Padding(
                                    padding: const EdgeInsets.only(bottom: 16.0),
                                    child: widget,
                                  );
                                }).toList(),
                              ),
                            ),
                            
                            const SizedBox(height: 20),
                            
                            // Tombol Login/Action
                            SizedBox(
                              width: double.infinity,
                              height: 58,
                              child: ElevatedButton(
                                onPressed: onButtonPressed,
                                style: ElevatedButton.styleFrom(
                                  backgroundColor: const Color(0xFF6A9CFD),
                                  foregroundColor: Colors.white,
                                  elevation: 2,
                                  shadowColor: const Color(0xFF6A9CFD).withOpacity(0.4),
                                  shape: RoundedRectangleBorder(
                                    borderRadius: BorderRadius.circular(12),
                                  ),
                                ),
                                child: Text(
                                  buttonText,
                                  style: const TextStyle(fontSize: 16, fontWeight: FontWeight.w800),
                                ),
                              ),
                            ),
                          ],
                        ),
                      ),
                    ],
                  ),
                ),
                const SizedBox(height: 40),
              ],
            ),
          ),
        ),
      ),
    );
  }
}