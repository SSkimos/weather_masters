// библиотека для работы с барометром
#include <TroykaIMU.h>
#include <TroykaDHT.h>
DHT dht(4, DHT11);
Barometer barometer;

void setup() {
  // put your setup code here, to run once:
  Serial.begin(9600);
  
  barometer.begin();

  dht.begin();
}

void loop() {
  // put your main code here, to run repeatedly:
  dht.read();
  float ba_pressurePascals = barometer.readPressurePascals();
  float ba_pressureMillimetersHg = barometer.readPressureMillimetersHg();
  float ba_altitude = barometer.readAltitude();
  float ba_temperature = barometer.readTemperatureC();


  switch (dht.getState()) {
    case DHT_OK:
      Serial.print("DHT_Humidity: ");
      Serial.print(dht.getHumidity());
      Serial.print("%  ");
      Serial.print("DHT_Temperature: ");
      Serial.print(dht.getTemperatureC());
      Serial.println("C");

      Serial.print("BA_Pressure: ");
      Serial.print(ba_pressurePascals);
      Serial.print(" Pa\t");
      Serial.print(ba_pressureMillimetersHg);
      Serial.print(" mmHg\t");
      Serial.print("BA_Height: ");
      Serial.print(ba_altitude);
      Serial.print(" m \t");
      Serial.print("BA_Temperature: ");
      Serial.print(ba_temperature);
      Serial.println(" C");
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

  delay(2000);
}
