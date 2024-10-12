from flask import Flask, render_template, request, jsonify, make_response
import requests

app = Flask(__name__)

# Ruta para obtener un solo registro desde el endpoint gpsnow usando un IMEI variable
@app.route('/gpsnow/<imei>')
def gps_now(imei):
    url = f'http://149.50.133.15:5000/gpsnow/{imei}'
    response = requests.get(url, auth=('admin', 'password'))

    # Verificamos si el status code de la petición es 200 y si hay datos
    if response.status_code == 200 and response.json():
        gps_data = response.json()[0]  # Obtenemos el primer y único dato
        return render_template('map.html', gps_data=gps_data), 200
    else:
        # Si no se encuentra el IMEI o la respuesta es vacía, devolvemos 404
        return render_template('error.html', message="IMEI not found"), 404
    
    if response.status_code == 401:
        return make_response(jsonify({"error": "Unauthorized access"}), 401)

    if response.status_code == 500:
        return make_response(jsonify({"error": "Server error"}), 500)


# Ruta para obtener múltiples registros desde el endpoint gpsbyall usando un IMEI variable
@app.route('/gpsbyall/<imei>')
def gps_by_all(imei):
    url = f'http://149.50.133.15:5000/gpsbyall/{imei}'
    response = requests.get(url, auth=('admin', 'password'))

    # Verificamos si el status code de la petición es 200 y si hay datos
    if response.status_code == 200 and response.json():
        gps_data_list = response.json()  # Obtenemos todos los datos
        return render_template('map_multiple.html', gps_data_list=gps_data_list), 200
    else:
        # Si no se encuentran datos, devolvemos 404
        return render_template('error.html', message="IMEI not found"), 404
    
    if response.status_code == 401:
        return make_response(jsonify({"error": "Unauthorized access"}), 401)

    if response.status_code == 500:
        return make_response(jsonify({"error": "Server error"}), 500)


if __name__ == '__main__':
    app.run(debug=True)
