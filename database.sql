
#sqlite3 /home/pi/temperature_sensor.db 

CREATE TABLE IF NOT EXISTS sensor_3(id INTEGER PRIMARY KEY AUTOINCREMENT, data TEXT, godz TEXT, temp TEXT);

