import psycopg2
from config import user, password, db_name, host

try:
    # connect to exist database
    connection = psycopg2.connect(
        database="weather",
        password="",
        host="127.0.0.1",
        port="5432"
    )

    # the cursor for perfoming database operations
    with connection.cursor() as cursor:
        cursor.execute(
            "SELECT version();"
        )

        print(f"Server version: {cursor.fetchone()}")

    # with connection.cursor() as cursor:
    #     cursor.execute(
    #         """CREATE TABLE data(
    #             id serial PRIMARY KEY,
    #             mydat date,
    #             temperature float,
    #             humidity float,
    #             pressure float);"""
    #     )

    #     connection.commit()
    #     print("[INFO] Table created succesfully")

    
    with connection.cursor() as cursor:
        cursor.execute(
            """INSERT INTO data (mydat, temperature, humidity, pressure) VALUES
            ('12.20.22', 12.5, 38, 1000)"""
        )

        connection.commit()

except Exception as _ex:
    print("[INFO] Error while working with PostgreSQL", _ex)
finally:
    if connection:
        connection.close()
        print("[INFO] PostgreSQL connection closed")
