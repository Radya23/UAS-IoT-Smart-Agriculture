# **SISTEM-MIKROKONTROLLER-KELOMPOK-6**

**JUDUL PROYEK**
----------------------------------------------------------------------------------------------------------------------------------------
Implementasi Smart Agriculture: Sistem Penyiraman Otomatis Berbasis ESP32 dengan Integrasi Keamanan Data dan Monitoring Realtime

**PENJELASAN PROYEK**
----------------------------------------------------------------------------------------------------------------------------------------
PENJELASAN PROYEK
Sistem ini adalah solusi cerdas untuk manajemen penyiraman tanaman secara autonomous (mandiri). Sistem membaca data kelembapan tanah melalui sensor secara real-time dan menggunakan mikrokontroler ESP32 sebagai pusat pemrosesan logika untuk mengontrol aktuator pompa air tanpa perlu intervensi manusia. Data kelembapan dan status aktivitas pompa dikirimkan secara berkala ke server backend untuk pemantauan dan pencatatan histori otomatis di dasbor web. Sistem ini bertujuan mengoptimalkan efisiensi air dengan menyiram tanaman hanya saat kondisi tanah berada di bawah ambang batas (kering).

**CARA KERJA**
----------------------------------------------------------------------------------------------------------------------------------------
1. nilai analog dari sensor kelembapan tanah yang kemudian dikonversi menjadi persentase kelembapan (0% - 100%).
2. Autonomous Logic: ESP32 menerapkan logika ambang batas (thresholding). Jika kelembapan di bawah 40% (kering), pompa diaktifkan secara otomatis. Jika kelembapan berada di atas 40% (normal hingga basah), pompa dihentikan.
3. Data Logging: ESP32 mengirimkan data kelembapan dan status pompa ke server Laravel melalui RESTful API (POST request) setiap 3 detik.
4. Data Visualization: Dasbor web melakukan fetch data secara real-time dari database untuk menampilkan persentase kelembapan dalam bentuk progress bar yang dinamis serta tabel histori aktivitas penyiraman.
   
**KOMPONEN PROYEK**
----------------------------------------------------------------------------------------------------------------------------------------
PERANGKAT KERAS:
1. ESP32 Development Board
2. Sensor Kelembapan Tanah (Resistif)
3. Modul Relay 1-Channel
4. Kabel Jumper
5. Baterai/Power Supply
6. Pompa Air Mini 5V

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
