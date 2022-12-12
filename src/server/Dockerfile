FROM python:3.9

WORKDIR /code

COPY ./requirements.txt /code/requirements.txt

RUN pip install --no-cache-dir --upgrade -r /code/requirements.txt
RUN pip3 install paho-mqtt
RUN pip3 install mysql-connector-python

COPY ./app /code/app

CMD ["python3", "app/server.py"]