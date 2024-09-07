from flask import Flask, request, jsonify
import requests
import pymysql
from datetime import datetime


app = Flask(__name__)

# Conexión a la base de datos

db_connection = pymysql.connect(
    host='sql-app4',
    user='root',
    password='root',
    db='app4'
)
# Funcion para probar conexion a la BD
def test_db_connection():
    conn = None
    try:
        # Establecer la conexión a la base de datos
        conn = pymysql.connect(
            host='sql-app4',
            user='root',
            password='root',
            db='app4'
        )
        
        # Crear un cursor y ejecutar una consulta simple
        with conn.cursor() as cursor:
            cursor.execute("SELECT VERSION()")
            version = cursor.fetchone()
            print(f"Conexión exitosa a la base de datos. Versión de MySQL: {version[0]}")

    except pymysql.MySQLError as e:
        print(f"Error al conectar a la base de datos: {e}")

    finally:
        if conn:
            conn.close()
            print("Conexión cerrada")

# Llamar a la función para probar la conexión
test_db_connection()


# Función para hacer el request al api-gateway
def query_rx_sms(begintime, endtime, num, port):
    url = 'https://apisms.duckdns.org/API/QueryRxSMS'
    headers = {
        'Content-Type': 'application/json',
        'Authorization': 'Basic QXBpVXNlckFkbWluOjQ2a09lMjEwTGJvbQ=='
    }
    data = {
        "event": "queryrxsms",
        "begintime": begintime,
        "endtime": endtime,
        "num": num,
        "port": port
    }
    
    response = requests.post(url, headers=headers, json=data)
    return response.text  # La respuesta es un string

# Función para parsear y guardar la respuesta en la base de datos
def insert_test_data():
    try:
        with db_connection.cursor() as cursor:
            # Datos de prueba para testear el almacenamiento en el BD
            id_type_event = 1
            date_event = datetime.strptime("2024-08-20", "%Y-%m-%d").date()
            phone = "1155887744"
            description = "Prueba de inserción 2"
            link_maps = "http://maps.google.com/?q=-34.67683,-058.72408"
            gps_signal = "11223"
            date = datetime.strptime("2024-08-20", "%Y-%m-%d").date()
            speed = "150 km/h"
            batery = "80%"
            id_tracker = "88821231"
            operator_info = "998313212"

            sql = """
            INSERT INTO event_response (
                id_type_event, date_event, phone, description, link_maps, 
                gps_signal, date, speed, batery, id_tracker, operator_info
            ) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)
            """

            # Ejecucion de la query
            cursor.execute(sql, (
                id_type_event, date_event, phone, description, link_maps, 
                gps_signal, date, speed, batery, id_tracker, operator_info
            ))

            # Confirmar los cambios con un commit
            db_connection.commit()
            print("Datos insertados correctamente")

    except pymysql.MySQLError as e:
        print(f"Error al insertar datos en la base de datos: {e}")
        db_connection.rollback()

    #finally:
    #    db_connection.close()

#insert_test_data()


# Endpoint para hacer el request y guardar la respuesta
@app.route('/fetch-sms', methods=['POST'])
def fetch_sms():
    req_data = request.get_json()
    
    begintime = req_data.get('begintime')
    endtime = req_data.get('endtime')
    num = req_data.get('num')
    port = req_data.get('port')
    
    # Realiza la petición al servicio externo
    response_data = query_rx_sms(begintime, endtime, num, port)

    insert_test_data()
    
    # Guardar la respuesta en la base de datos
    #save_to_database(response_data)
    
    #total = response_data.split(';')
    
    #total2 = total.split(',')
    #print("total: {total}")
    #print("total2: {total2}")
    
    #return jsonify({"status": "success", "data": total})
    
    return jsonify({"status": "success", "data": response_data})

@app.route('/')
def hola():
    return "Docker Python Flask APP4 Funcionando!"

if __name__ == '__main__':
    app.run(debug=True)
