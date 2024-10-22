FROM python:3.8.5-alpine

# Instalar dependencias necesarias
RUN apk add --no-cache gcc musl-dev python3-dev libffi-dev openssl-dev

# Establecer el directorio de trabajo y copiar archivos
WORKDIR /app/
COPY . /app

# Actualizar pip
RUN pip install --upgrade pip

# Instalar las dependencias
RUN pip install -r requirements.txt

# Establecer variables de entorno para Flask
ENV FLASK_APP=map.py

# Comando para ejecutar la aplicación Flask
CMD ["flask", "run", "--host=0.0.0.0"]
