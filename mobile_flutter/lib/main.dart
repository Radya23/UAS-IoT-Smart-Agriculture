import 'package:flutter/material.dart';
import 'package:percent_indicator/circular_percent_indicator.dart';
import 'package:google_fonts/google_fonts.dart';

void main() => runApp(MaterialApp(
      debugShowCheckedModeBanner: false,
      home: SmartAgricultureApp(),
      theme: ThemeData.dark().copyWith(
        textTheme: GoogleFonts.poppinsTextTheme(ThemeData.dark().textTheme),
      ),
    ));

class SmartAgricultureApp extends StatefulWidget {
  @override
  _SmartAgricultureAppState createState() => _SmartAgricultureAppState();
}

class _SmartAgricultureAppState extends State<SmartAgricultureApp> {
  double currentDisplayPercent = 0.0;
  double targetKelembapan = 85.0;
  
  // List untuk menyimpan histori waktu
  List<String> history = [];

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: Color(0xFF0F2027),
      body: SafeArea(
        child: Column(
          children: [
            SizedBox(height: 20),
            Text("SMART AGRI CONTROL", style: TextStyle(fontSize: 24, letterSpacing: 3, fontWeight: FontWeight.w900)),
            
            Expanded(
              child: Column(
                mainAxisAlignment: MainAxisAlignment.center,
                children: [
                  TweenAnimationBuilder<double>(
                    key: ValueKey(currentDisplayPercent),
                    tween: Tween<double>(begin: 0, end: currentDisplayPercent),
                    duration: Duration(seconds: 3),
                    curve: Curves.elasticOut,
                    builder: (context, value, child) {
                      return CircularPercentIndicator(
                        radius: 100.0,
                        lineWidth: 15.0,
                        percent: value / 100,
                        center: Text("${value.toInt()}%", style: TextStyle(fontSize: 40, fontWeight: FontWeight.bold)),
                        progressColor: Colors.cyanAccent,
                        backgroundColor: Colors.white10,
                        circularStrokeCap: CircularStrokeCap.round,
                      );
                    },
                  ),
                  SizedBox(height: 40),
                  Row(
                    mainAxisAlignment: MainAxisAlignment.center,
                    children: [
                      _buildButton("START", Icons.play_circle_fill, Colors.cyan, () {
                        setState(() {
                          currentDisplayPercent = targetKelembapan;
                          // Menambahkan waktu saat ini ke dalam list
                          String time = TimeOfDay.now().format(context);
                          history.insert(0, "Penyiraman: $time"); 
                        });
                      }),
                      SizedBox(width: 20),
                      _buildButton("STOP", Icons.stop_circle, Colors.pinkAccent, () {
                        setState(() {
                          currentDisplayPercent = 0.0;
                        });
                      }),
                    ],
                  ),
                ],
              ),
            ),

            // Widget Histori
            Container(
              height: 150,
              padding: EdgeInsets.all(15),
              margin: EdgeInsets.all(20),
              decoration: BoxDecoration(
                color: Colors.white.withOpacity(0.05),
                borderRadius: BorderRadius.circular(20),
              ),
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  Text("Histori Terakhir:", style: TextStyle(fontWeight: FontWeight.bold, color: Colors.cyanAccent)),
                  Divider(color: Colors.white24),
                  Expanded(
                    child: ListView.builder(
                      itemCount: history.length,
                      itemBuilder: (context, index) {
                        return Padding(
                          padding: const EdgeInsets.symmetric(vertical: 4),
                          child: Text("• ${history[index]}", style: TextStyle(color: Colors.white70)),
                        );
                      },
                    ),
                  ),
                ],
              ),
            ),
          ],
        ),
      ),
    );
  }

  Widget _buildButton(String label, IconData icon, Color color, VoidCallback onTap) {
    return InkWell(
      onTap: onTap,
      child: Container(
        padding: EdgeInsets.symmetric(horizontal: 25, vertical: 12),
        decoration: BoxDecoration(
          color: color.withOpacity(0.2),
          border: Border.all(color: color),
          borderRadius: BorderRadius.circular(50),
        ),
        child: Row(
          children: [Icon(icon, color: color), SizedBox(width: 8), Text(label)],
        ),
      ),
    );
  }
}