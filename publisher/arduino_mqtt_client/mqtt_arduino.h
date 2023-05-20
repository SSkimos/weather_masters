#include <ArduinoMqttClient.h>
#include <ESP8266WiFi.h>

WiFiClient wifiClient;
MqttClient mqttClient(wifiClient);
