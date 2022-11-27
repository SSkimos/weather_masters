#include "mqtt_arduino.h"
// WiFi
const char *ssid = "HUAWEI-041";          // Enter your WiFi name
const char *password = "KaSAMeeD_01341";  // Enter WiFi password

// MQTT Broker
const char *mqtt_broker = "test.mosquitto.org";
const char *topic = "esp/test1";
const char *mqtt_username = "nuoki";
const char *mqtt_password = "123";
const int mqtt_port = 1883;

String message = "";

// Interval for sending messages (in milliseconds) to the MQTT broker
const long interval = 10000;
unsigned long previousMillis = 0;

void setup() {
  Serial.begin(115200);

  mqttClient.setUsernamePassword(mqtt_username, mqtt_password);
  // Attempt to connect to the defined Wi-Fi network
  // Serial.print("- Attempting to connect to WPA SSID: ");
  // Serial.println(ssid);
  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED) {
    // Connection attempt failed, retry again
    delay(500);
  }

  // Serial.println("- You're connected to the network!");
  // Serial.println();

  // Attempt to connect to the defined Wi-Fi network
  // Serial.print("- Attempting to connect to the MQTT broker: ");
  // Serial.println(mqtt_broker);

  // Connection attempt to the MQTT broker failed
  if (!mqttClient.connect(mqtt_broker, mqtt_port)) {
    // Serial.println("- MQTT connection failed!");
    // Serial.print("- Error code: ");
    // Serial.println(mqttClient.connectError());
  }
}

void loop() {
  // Keep the board connected to the MQTT broker
  mqttClient.poll();

  unsigned long currentMillis = millis();

  if (currentMillis - previousMillis >= interval) {
    if (Serial.available()) {
      message += String(Serial.read());
      message += " ";
      message += String(Serial.read());
      previousMillis = currentMillis;
      // Send the gathered data to an specific topic of the MQTT broker
      mqttClient.beginMessage(topic);
      mqttClient.print(message);
      mqttClient.endMessage();
      message = "";
    }
  }
}