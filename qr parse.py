import serial
import webbrowser

# Open serial port
ser = serial.Serial('/dev/cu.usbserial-A5XK3RJT', 115200)  # Adjust the port and baud rate

while True:
    if ser.in_waiting > 0:
        data = ser.readline().decode('utf-8').rstrip()  # Read data from serial port
        print("Received URL:", data)  # Print received data
        webbrowser.open(data)  # Open URL in default web browser
