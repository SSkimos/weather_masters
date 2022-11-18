# python3.6

import random, logging
from config import broker, port, topic, client_id, username, password

from paho.mqtt import client as mqtt_client


def connect_mqtt() -> mqtt_client:
    def on_connect(client, userdata, flags, rc):
        if rc == 0:
            print("Connected to MQTT Broker!")
        else:
            print("Failed to connect, return code %d\n", rc)
    client = mqtt_client.Client(client_id)
    client.username_pw_set(username, password)
    client.on_connect = on_connect
    client.connect(broker, port)
    return client


def subscribe(client: mqtt_client):
    def on_message(client, userdata, msg):
        data_list = msg.payload.decode().split('/')
        logging.basicConfig(level=logging.INFO, filename="server.log",filemode="w")
        logging.info(f"Temperature = '{data_list[0]}'")
        logging.info(f"Humidity = '{data_list[1]}'")
        logging.info(f"Pressure = '{data_list[2]}'")

    client.subscribe(topic)
    client.on_message = on_message


def run():
    client = connect_mqtt()
    subscribe(client)
    client.loop_forever()


if __name__ == '__main__':
    run()
