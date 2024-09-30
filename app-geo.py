from flask import Flask, request, jsonify
from flask_cors import CORS

app = Flask(__name__)
CORS(app)

# Variable para almacenar coordenadas. Luego guardar en la BD
coordenadas = []

# Metodo para postear las coordenadas
@app.route('/coordenadas', methods=['POST'])
def agregar_coordenada():
    data = request.get_json()
    latitud = data.get('latitud')
    longitud = data.get('longitud')
    # Validacion de campos del body
    if latitud and longitud:
        coordenadas.append({"latitud": latitud, "longitud": longitud})
        return jsonify({"status": "success", "coordenadas": coordenadas}), 201
    else:
        return jsonify({"error": "Faltan latitud o longitud"}), 400

# Metodo para consultar todas las coordenadas
@app.route('/coordenadas', methods=['GET'])
def obtener_coordenadas():
    return jsonify(coordenadas), 200

if __name__ == '__main__':
    app.run(debug=True)
