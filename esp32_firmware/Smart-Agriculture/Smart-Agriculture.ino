#include <WiFi.h>
#include <HTTPClient.h>

const char* ssid = "Redmi Note 9";
const char* password = "modallahhh";
const int relayPin = 26;

void setup() {
  pinMode(relayPin, OUTPUT);
  digitalWrite(relayPin, LOW); 

  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
  }
}

void loop() {
  if (WiFi.status() == WL_CONNECTED) {
    HTTPClient http;
    http.begin("http://192.168.236.53:8000/api/sensor/status");
    int httpCode = http.GET();

    if (httpCode == HTTP_CODE_OK) {
      String payload = http.getString();
      if (payload.indexOf("ON") != -1) {
        digitalWrite(relayPin, LOW); 
      } else if (payload.indexOf("OFF") != -1) {
        digitalWrite(relayPin, LOW);  
      }
    }
    http.end();
  }
  delay(2000); 
}