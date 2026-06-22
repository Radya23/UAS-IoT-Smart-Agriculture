import 'dart:convert';
import 'dart:async';
import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'package:percent_indicator/circular_percent_indicator.dart';

void main() => runApp(MaterialApp(
  debugShowCheckedModeBanner: false, 
  home: SmartAgricultureApp(),
  theme: ThemeData.dark(), // Menggunakan dark theme agar lebih modern
));

class SmartAgricultureApp extends StatefulWidget {
  @override
  _SmartAgricultureAppState createState() => _SmartAgricultureAppState();
}

class _SmartAgricultureAppState extends State<SmartAgricultureApp> {
  double kelembapan = 0.0;
  final String apiUrl = "http://IP_SERVER_LARAVEL/api/latest";

  // Fungsi fetch data (sama seperti sebelumnya)
  Future<void> fetchData() async {
    try {
      final response = await http.get(Uri.parse(apiUrl));
      if (response.statusCode == 200) {
        var data = jsonDecode(utf8.decode(base64Decode(jsonDecode(response.body)['data'])));
        setState(() => kelembapan = (data['kelembapan'] as num).toDouble());
      }
    } catch (e) { debugPrint("Error: $e"); }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: Container(
        decoration: BoxDecoration(
          gradient: LinearGradient(
            colors: [Colors.blue.shade900, Colors.teal.shade700],
            begin: Alignment.topLeft, end: Alignment.bottomRight,
          ),
        ),
        child: Column(
          mainAxisAlignment: MainAxisAlignment.center,
          children: [
            Text("Smart Agri Monitor", style: TextStyle(fontSize: 28, fontWeight: FontWeight.bold)),
            SizedBox(height: 40),
            CircularPercentIndicator(
              radius: 130.0,
              lineWidth: 20.0,
              animation: true,
              percent: kelembapan / 100,
              center: Column(
                mainAxisAlignment: MainAxisAlignment.center,
                children: [
                  Icon(kelembapan < 40 ? Icons.water_drop : Icons.grass, size: 50, color: Colors.white),
                  Text("${kelembapan.toInt()}%", style: TextStyle(fontSize: 40, fontWeight: FontWeight.bold)),
                ],
              ),
              progressColor: kelembapan < 40 ? Colors.redAccent : Colors.lightGreenAccent,
              backgroundColor: Colors.white24,
            ),
            SizedBox(height: 50),
            Row(
              mainAxisAlignment: MainAxisAlignment.center,
              children: [
                _buildActionButton("Siram", Icons.play_arrow, Colors.blue),
                SizedBox(width: 30),
                _buildActionButton("Stop", Icons.stop, Colors.red),
              ],
            ),
          ],
        ),
      ),
    );
  }

  Widget _buildActionButton(String label, IconData icon, Color color) {
    return ElevatedButton.icon(
      style: ElevatedButton.styleFrom(backgroundColor: color, padding: EdgeInsets.symmetric(horizontal: 25, vertical: 15)),
      onPressed: () {}, // Tambahkan logika API post disini
      icon: Icon(icon), label: Text(label),
    );
  }
}