#include <WiFi.h>
#include <HTTPClient.h>

const char* ssid = ".....";
const char* password = ".....";

const int relayPin = 26;
const int pinSensor = 34; // Pin Analog

// URL API Laravel (PASTIKAN IP SESUAI IP LAPTOPMU SAAT INI)
const char* serverUrl = "http://192.168.XXX.XX:8000/api/sensor/update-otomatis";

void setup() {
  Serial.begin(115200);
  pinMode(relayPin, OUTPUT);
  digitalWrite(relayPin, HIGH); // Awalnya OFF (Active Low)

  WiFi.begin(ssid, password);
  Serial.print("Menghubungkan ke WiFi");
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  Serial.println("\nWiFi Terhubung!");
}

void loop() {
  // 1. Membaca & Mengolah Data Sensor
  int analogValue = analogRead(pinSensor);
  // Menggunakan rentang 4095 (Kering) sampai 2257 (Basah)
  int kelembapan = map(analogValue, 4095, 2257, 0, 100);
  kelembapan = constrain(kelembapan, 0, 100); 

  Serial.print("Raw: "); Serial.print(analogValue);
  Serial.print(" | Percent: "); Serial.println(kelembapan);

  // 2. Logika Otomatis Pompa
  String statusPompa = "OFF";
  if (kelembapan < 40) {
    digitalWrite(relayPin, LOW); // Pompa NYALA
    statusPompa = "ON";
    Serial.println("Tanah Kering -> Pompa ON");
  } else {
    digitalWrite(relayPin, HIGH); // Pompa MATI
    statusPompa = "OFF";
    Serial.println("Tanah Lembab -> Pompa OFF");
  }

  // 3. Kirim Data ke Laravel
  if (WiFi.status() == WL_CONNECTED) {
    HTTPClient http;
    http.begin(serverUrl);
    http.addHeader("Content-Type", "application/x-www-form-urlencoded");
    
    String httpRequestData = "kelembapan=" + String(kelembapan) + "&status=" + statusPompa;
    int httpResponseCode = http.POST(httpRequestData);
    
    if (httpResponseCode > 0) {
      Serial.println("Data berhasil terkirim ke Laravel!");
    } else {
      Serial.println("Gagal mengirim data.");
    }
    http.end();
  }

  delay(3000); // Tunggu 3 detik
}
