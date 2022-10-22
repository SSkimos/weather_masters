#include "ESP8266.h"
#include <SoftwareSerial.h>
#include <TroykaDHT.h>

#define SSID "HUAWEI-041"
#define PASSWORD "KaSAMeeD_01341"

SoftwareSerial mySerial(8, 9);
ESP8266 wifi(mySerial);
DHT dht(A0, DHT11);
String name = "nuokiDHT1001";

void setup() {
  Serial.begin(9600);
  
  if (wifi.joinAP(SSID, PASSWORD)) {
    Serial.println("https://dweet.io/follow/" + name);
  } else {
    Serial.println("Wi-Fi connection error");
  }
  dht.begin();
}

void loop() {
  dht.read();
  switch (dht.getState()) {
    case DHT_OK:
      if (wifi.createTCP("www.dweet.io", 80)) {
        String data = "GET /dweet/for/" + name + "?";
        data += "temp=" + String(dht.getTemperatureC()) + " HTTP/1.1\r\n";
        data += "Host: dweet.io\r\n\r\n";
        wifi.send(data.c_str(), data.length());
        wifi.releaseTCP();
      } else {
        Serial.println("create TCP error");
      }
      break;
    case DHT_ERROR_CHECKSUM:
      Serial.println("Checksum error");
      break;
    // превышение времени ожидания
    case DHT_ERROR_TIMEOUT:
      Serial.println("Time out error");
      break;
    // данных нет, датчик не реагирует или отсутствует
    case DHT_ERROR_NO_REPLY:
      Serial.println("Sensor not connected");
      break;
  }
  delay(1000);
}
