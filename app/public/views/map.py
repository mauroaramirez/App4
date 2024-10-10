from flask import Flask, render_template
import requests

app = Flask(__name__)

# Ruta para obtener un solo registro desde el endpoint gpsnow
@app.route('/gpsnow')
def gps_now():
    url = 'http://149.50.133.15:5000/gpsnow/4208298709'
    response = requests.get(url, auth=('admin', 'password'))

    # Suponemos que la respuesta es una lista con un solo objeto
    gps_data = response.json()[0]

    # Renderizamos el template 'map.html' pasando gps_data
    return render_template('map.html', gps_data=gps_data)

# Ruta para obtener múltiples registros desde el endpoint gpsbyall
@app.route('/gpsbyall')
def gps_by_all():
    url = 'http://149.50.133.15:5000/gpsbyall/4208298709'
    response = requests.get(url, auth=('admin', 'password'))

    # La respuesta es una lista de objetos
    gps_data_list = response.json()

    # Renderizamos el template 'map_multiple.html' pasando gps_data_list
    return render_template('map_multiple.html', gps_data_list=gps_data_list)

if __name__ == '__main__':
    app.run(debug=True)
