#include <TroykaIMU.h>

Barometer barometer;

void setup() {
  // put your setup code here, to run once:
  Serial.begin(9600);

  Serial.println("Barometer begin");

  barometer.begin();

  Serial.println("Initialization completed");
}

void loop() {
  // put your main code here, to run repeatedly:
  float pressurePascals = barometer.readPressurePascals();

  float pressureMillimetersHg = barometer.readPressureMillimetersHg();

  float altitude = barometer.readAltitude();

  float temperature = barometer.readTemperatureC();

  Serial.print("Pressure: ");
  Serial.print(pressurePascals);
  Serial.print(" Pa\t");
  Serial.print(pressureMillimetersHg);
  Serial.print(" mmHg\t");
  Serial.print("Height: ");
  Serial.print(altitude);
  Serial.print(" m \t");
  Serial.print("Temperature: ");
  Serial.print(temperature);
  Serial.println(" C");
  delay(5000);
}

