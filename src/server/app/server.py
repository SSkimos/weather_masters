# python3.6

from fastapi import FastAPI
from datetime import datetime
from paho.mqtt import client as mqtt_client
import mysql.connector
from mysql.connector import connect, Error
import random

app = FastAPI()

broker = '82.148.17.22'
#broker = 'weather_gods.emqx.io'
port = 1883
topic = "Habr"
# generate client ID with pub prefix randomly
client_id = f'python-mqtt-{random.randint(0, 100)}'
username = 'IoT'
password = '123'


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
        data_list = msg.payload.decode().split(' ')
        aboba = f"""
                    INSERT INTO weather (
                        date,
                        time,
                        temp,
                        pres,
                        humidity
                    ) values (
                        '{datetime.now().date()}',
                        '{datetime.now().time()}',
                        '{data_list[0]}',
                        '{data_list[2]}',
                        '{data_list[1]}'
                    );
                    """
        cnx = mysql.connector.connect(host='localhost', password='123', username='test_user', database='test')
        cursor = cnx.cursor()
        cursor.close()
        cursor = cnx.cursor()
        cursor.execute(aboba)
        cnx.commit()

    client.subscribe(topic)
    client.on_message = on_message


def run():
    client = connect_mqtt()
    subscribe(client)
    client.loop_forever()


if __name__ == '__main__':
    run()
