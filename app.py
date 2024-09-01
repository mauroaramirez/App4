from flask import Flask, request, jsonify
import requests
import pymysql

app = Flask(__name__)

# Configuración de la conexión a la base de datos MySQL
db_connection = pymysql.connect(
    host='sql-app4',
    user='root',
    password='root',
    db='app4'
)

# Función para hacer la petición al servicio externo
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
def save_to_database(response_data):
    try:
        with db_connection.cursor() as cursor:
            # Dividir los eventos
            events = response_data.split(';')
            total_events = int(events[0].split(':')[1])  # Total de eventos
            
            for event in events[1:]:
                if event.strip() == "":
                    continue
                
                parts = event.split(':')
                
                date_event = parts[0]  # Fecha y hora del evento
                id_type_event = parts[1]  # ID del tipo de evento
                
                phone = parts[2].split('(-1)')[1]  # Número de teléfono
                description = parts[3].split('http')[0].strip()  # Descripción
                link_maps = "http" + parts[3].split('http')[1].split(' ')[0]  # Link de Google Maps
                
                # Extraer las partes entre "V:V," y "|E"
                extra_info = parts[3].split('   V:V,')[1].split('|E')[0]
                
                gps_signal = extra_info.split(',')[0]  # Señal GPS (en este caso siempre parece ser "V:V")
                date = extra_info.split(',')[1]  # Fecha y hora de la señal
                speed = extra_info.split('S:')[1].split('km/h')[0]  # Velocidad
                batery = extra_info.split('Bat:')[1].split('%')[0]  # Batería
                id_tracker = extra_info.split(',')[3]  # ID del rastreador
                operator_info = extra_info.split(',')[4].split(';')[0]  # Información del operador
                
                # Inserta los datos en la tabla event_response
                sql = """
                INSERT INTO event_response (
                    id_type_event, date_event, phone, description, 
                    link_maps, gps_signal, date, speed, batery, 
                    id_tracker, operator_info
                ) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)
                """
                cursor.execute(sql, (
                    id_type_event, date_event, phone, description, 
                    link_maps, gps_signal, date, speed, batery, 
                    id_tracker, operator_info
                ))
        db_connection.commit()
    except Exception as e:
        print(f"Error al guardar en la base de datos: {e}")
        db_connection.rollback()

# Endpoint para hacer la petición y guardar la respuesta
@app.route('/fetch-sms', methods=['POST'])
def fetch_sms():
    req_data = request.get_json()
    
    begintime = req_data.get('begintime')
    endtime = req_data.get('endtime')
    num = req_data.get('num')
    port = req_data.get('port')
    
    # Realiza la petición al servicio externo
    response_data = query_rx_sms(begintime, endtime, num, port)
    
    # Guardar la respuesta en la base de datos
    save_to_database(response_data)
    
    #total = response_data.split(';')
    
    #total2 = total.split(',')
    print("total: {total}")
    
    #return jsonify({"status": "success", "data": total})
    
    return jsonify({"status": "success", "data": response_data})

@app.route('/')
def hola():
    return "Docker Python Flask APP4 Funcionando!"

if __name__ == '__main__':
    app.run(debug=True)
