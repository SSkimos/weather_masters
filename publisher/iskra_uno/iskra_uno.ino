#include "test_for_255_uno.h"

float temp_c = 0.0;
float humid = 0.0;
int pressure = 0;

void setup() {
  Serial.begin(115200);
  esp.begin(115200);
  barometer.begin();
  dht.begin();
}


void writeInt(unsigned int value){
  WIFI_SERIAL.write(lowByte(value));
  WIFI_SERIAL.write(highByte(value));
}

void loop() {
  dht.read();
  
  temp_c = dht.getTemperatureC();
  humid = dht.getHumidity();
  pressure = barometer.readPressureMillimetersHg();

  Serial.print("Temperature C: ");
  Serial.println(temp_c);
  Serial.print("Humidity: ");
  Serial.println(humid);
  Serial.print("Pressure: ");
  Serial.println(pressure);
  WIFI_SERIAL.write(temp_c);
  WIFI_SERIAL.write(humid); 
  writeInt(pressure);
  delay(10000);
}