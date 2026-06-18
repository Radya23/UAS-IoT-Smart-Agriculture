##**SISTEM-MIKROKONTROLLER-KELOMPOK-6**

**JUDUL PROYEK**
----------------------------------------------------------------------------------------------------------------------------------------
Implementasi Smart Agriculture: Sistem Penyiraman Otomatis Berbasis ESP32 dengan Integrasi Keamanan Data dan Monitoring Realtime

**PENJELASAN PROYEK**
----------------------------------------------------------------------------------------------------------------------------------------
Sistem ini dirancang untuk melakukan penyiraman tanaman secara otomatis berdasarkan data kelembapan tanah yang dibaca oleh sensor. ESP32 berfungsi sebagai pusat pemrosesan yang mengolah data sensor dan mengontrol aktuator pompa air secara mandiri. Pengguna dapat memantau kondisi kelembapan dan status pompa melalui aplikasi mobile. Komunikasi data menggunakan protokol HTTP yang dilengkapi dengan lapisan enkripsi untuk menjamin keamanan data selama pengiriman. Sistem ini dirancang untuk mengoptimalkan penggunaan air secara efisien dengan memastikan tanaman hanya disiram saat dibutuhkan.

**CARA KERJA**
----------------------------------------------------------------------------------------------------------------------------------------
1. ESP32 terhubung ke jaringan WiFi.
2. Sensor kelembapan tanah membaca kondisi air di dalam media tanam secara berkala.
3. ESP32 memproses data; jika tanah kering (di bawah ambang batas), ESP32 mengirim sinyal ke pin output untuk mengaktifkan Pompa Air Mini 5V.
4. Data kelembapan dan status pompa dienkripsi oleh ESP32 sebelum dikirim ke server.
5. Server menerima data, melakukan dekripsi, dan menyimpan data ke dalam basis data MySQL.
6. Aplikasi mobile mengambil data dari server melalui API dan menampilkannya secara realtime.
7. Pengguna dapat memberikan perintah kontrol manual melalui aplikasi untuk menyalakan atau mematikan pompa dari jarak jauh.

**KOMPONEN PROYEK**
----------------------------------------------------------------------------------------------------------------------------------------
PERANGKAT KERAS:
1. ESP32 Development Board
2. Sensor Kelembapan Tanah (Soil Moisture Sensor)
3. Pompa Air Mini 5V (termasuk modul relai sebagai penggerak pompa)

PERANGKAT LUNAK:
1. Firmware: Arduino IDE (C++)
2. Backend: Laravel (PHP) & MySQL
3. Mobile: Flutter
4. Keamanan: Algoritma Enkripsi/Dekripsi (AES/Base64)

**Disusun Oleh :**
----------------------------------------------------------------------------------------------------------------------------------------
1. Radya Anantia Divena - 23552011415
2. Arys Rizki Zhahiral Bilhaq - 23552011352
3. Rival Maulaba - 23552011056
