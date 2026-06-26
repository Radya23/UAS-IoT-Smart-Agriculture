# **SISTEM-MIKROKONTROLLER-KELOMPOK-6**

**JUDUL PROYEK**
----------------------------------------------------------------------------------------------------------------------------------------
Implementasi Smart Agriculture: Sistem Penyiraman Otomatis Berbasis ESP32 dengan Integrasi Keamanan Data dan Monitoring Realtime

**PENJELASAN PROYEK**
----------------------------------------------------------------------------------------------------------------------------------------
Sistem ini dirancang untuk melakukan penyiraman tanaman secara otomatis berdasarkan data kelembapan tanah yang dibaca oleh sensor secara realtime. ESP32 berfungsi sebagai pusat pemrosesan utama yang mengolah parameter sensor dan mengontrol aktuator pompa air secara mandiri. Pengguna dapat memantau tingkat kelembapan tanah dan status aktif/tidaknya pompa melalui aplikasi mobile. Komunikasi data dari perangkat ke server menggunakan protokol HTTP yang dilengkapi dengan lapisan enkripsi untuk menjamin keamanan data selama pengiriman. Sistem ini dirancang untuk mengoptimalkan penggunaan air secara efisien dengan memastikan tanaman hanya disiram saat kondisi tanah membutuhkan air.

**CARA KERJA**
----------------------------------------------------------------------------------------------------------------------------------------
1. ESP32 menginisialisasi koneksi ke jaringan WiFi yang tersedia.
2. ESP32 memproses data biner/analog dari sensor; jika tingkat kelembapan berada di bawah ambang batas (threshold tanah kering), ESP32 akan mengirim sinyal ke pin output untuk mengaktifkan modul relai yang menggerakkan Pompa Air Mini 5V.
3. Sebelum dikirim ke server, data hasil pembacaan kelembapan tanah dan status pompa dienkripsi terlebih dahulu di sisi ESP32 demi menjaga integritas data.
4. Server backend menerima data enkripsi tersebut, melakukan proses dekripsi, dan menyimpan datanya ke dalam basis data MySQL.
5. Aplikasi mobile melakukan request data ke server melalui RESTful API untuk menampilkan kondisi lahan secara realtime.
6. Melalui aplikasi mobile, pengguna juga dapat mengirimkan perintah kontrol manual untuk menyalakan atau mematikan pompa air dari jarak jauh.
   
**KOMPONEN PROYEK**
----------------------------------------------------------------------------------------------------------------------------------------
PERANGKAT KERAS:
1. ESP32 Development Board
2. Modul Relay
3. Kabel Jumper
4. Baterai
5. Pompa Air Mini 5V (termasuk modul relai sebagai penggerak pompa)

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
