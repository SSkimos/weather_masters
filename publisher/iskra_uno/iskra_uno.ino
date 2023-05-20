#include "iskra_uno.h"

float temp_c = 0.0;
float humid = 0.0;


void setup() {
  Serial.begin(115200);
  esp.begin(115200);
  dht.begin();
}

void loop() {
  dht.read();
  
  temp_c = dht.getTemperatureC();
  humid = dht.getHumidity();
  
  Serial.print("Temperature C: ");
  Serial.println(temp_c);
  Serial.print("Humidity: ");
  Serial.println(humid);
  WIFI_SERIAL.write(temp_c);
  WIFI_SERIAL.write(humid);
  delay(10000);
}
