# Prueba Técnica - Eduardo Rodríguez Galán

## Description
This application allows to track all arrivals to an airport in an interval of time.

## Requisitos
- Docker installed

## Instalation
1. Clone the repo into your machine
   ```bash
   git clone git@github.com:egalan26/pruebaFlight.git
   ```
2. Change directory into the project folder
    ```
    cd pruebaFlight
    ```
3. Build images 
   ```
      make buildup
   ```
4. Start project with docker-compose
    ```
   docker-compose up
   ```
5. Wait some minutes for node to build and serve the project
6. Goto to http://localhost:8080/ and enjoy :)