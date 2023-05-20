from os import path
import psycopg2
from config import username, password, db_name, host, broker


class DataBase:
    def __init__(self):
        pass

    def connection():
        connection = psycopg2.connect(
        database=db_name,
        password=password,
        host=broker,
        port=host
    )


    def insert_object(self, date, temperature, humidity, pressure):
        conn = DataBase.connection()
        with conn.cursor() as cursor:
            cursor.execute(
                """INSERT INTO data(
                    mydat,
                    temperature,
                    humidity,
                    pressure
                ) VALUES (
                    {date},
                    {temperature},
                    {humidity},
                    {pressure}
                )
                """
            )

            conn.commit()
            conn.close()


