from flask import Flask, render_template, request, jsonify, make_response
import requests
from dotenv import load_dotenv
import os
from pathlib import Path

# Path para consultar .env.local
env_path = Path('../.env.local')

# Cargar las variables de entorno desde .env.local
load_dotenv(dotenv_path=env_path)

# Obtengo la URL y users y pass para obtener el token
GPS_API_URL = os.getenv('GPS_API_URL')
USERNAME_TOKEN = os.getenv('USERNAME_TOKEN')
PASSWORD_TOKEN = os.getenv('PASSWORD_TOKEN')

app = Flask(__name__)

# Ruta para obtener un solo registro desde el endpoint gpsnow usando un IMEI variable
@app.route('/gpsnow/<imei>')
def gps_now(imei):
    url = f'{GPS_API_URL}/gpsnow/{imei}'
    response = requests.get(url, auth=(f'{USERNAME_TOKEN}', f'{PASSWORD_TOKEN}'))

    if response.status_code == 200 and response.json():
        gps_data = response.json()[0]
        return render_template('map.html', gps_data=gps_data), 200
    else:
        return render_template('error.html', message="IMEI not found"), 404

    if response.status_code == 401:
        return make_response(jsonify({"error": "Unauthorized access"}), 401)

    if response.status_code == 500:
        return make_response(jsonify({"error": "Server error"}), 500)

# Ruta para obtener múltiples registros desde el endpoint gpsbyall usando un IMEI variable
@app.route('/gpsbyall/<imei>')
def gps_by_all(imei):
    url = f'{GPS_API_URL}/gpsbyall/{imei}'
    response = requests.get(url, auth=(f'{USERNAME_TOKEN}', f'{PASSWORD_TOKEN}'))

    if response.status_code == 200 and response.json():
        gps_data_list = response.json()
        return render_template('map_multiple.html', gps_data_list=gps_data_list), 200
    else:
        return render_template('error.html', message="IMEI not found"), 404

    if response.status_code == 401:
        return make_response(jsonify({"error": "Unauthorized access"}), 401)

    if response.status_code == 500:
        return make_response(jsonify({"error": "Server error"}), 500)

if __name__ == '__main__':
    app.run(debug=True)
