#include <SoftwareSerial.h>
#include <TroykaIMU.h>
#include <TroykaDHT.h>

#define DHTPIN 8
#define DHTTYPE DHT11
#define WIFI_SERIAL esp

SoftwareSerial esp (2, 3);
DHT dht (DHTPIN, DHTTYPE);
Barometer barometer;