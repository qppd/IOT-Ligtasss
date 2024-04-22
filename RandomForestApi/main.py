from flask import Flask, request, jsonify, Response
import joblib
import subprocess
import os
import cv2
from flask_cors import CORS
from datetime import datetime
import time
import threading  # Import threading module
import uuid

app = Flask(__name__)
CORS(app)

model = joblib.load("random_forest_fire_detection_model.joblib")


# Define a dictionary to store video output writers for each camera
output_files = {}

@app.route("/detect-fire", methods=["POST"])
def detect_fire():
    data = request.json
    
    temperature = data.get("temperature")
    humidity = data.get("humidity")
    smoke = data.get("smoke")
    flame = data.get("flame")
    
    prediction = model.predict([[temperature, humidity, smoke, flame]])
    
    if prediction == 0:
        result = "0"
    elif prediction == 1:
        result = "1"
    else:
        result = "2"
    
    return jsonify({"result": result})

def check_gate():
    data = request.json
    
    metal = data.get("metal")
    body_temperature = data.get("body_temperature")
   
    prediction = model.predict([[body_temperature, metal]])
    
    if prediction == 0:
        result = "Did not pass"
    elif prediction == 1:
        result = "Passed"
   
    return jsonify({"result": result})

@app.route('/video_feed/<path:param>')
def video_feed(param):
    return Response(generate_frames(param), mimetype='multipart/x-mixed-replace; boundary=frame')

def generate_frames(param):

    param = param.split("=")

    ip_address = param[0]
    camera_id = param[1]

    print(f"Connecting to IP Cam at {ip_address}")
    print(f"Connected to Camera {camera_id}")
    
    rtsp_url = f'{ip_address}'
    cap = cv2.VideoCapture(rtsp_url)

    input_frame_rate = cap.get(cv2.CAP_PROP_FPS)
    print("Input Frame Rate:", input_frame_rate)

    frame_size = (int(cap.get(3)), int(cap.get(4)))
    fourcc = cv2.VideoWriter_fourcc(*'avc1')

    # camera_id = str(uuid.uuid4())
    # output_filename = f'C:/xampp/htdocs/iot/storage/app/public/videos/{current_date}_{camera_id}.mp4'
    current_date = datetime.now().strftime("%Y-%m-%d-%H-%M-%S")
    output_filename = f'C:/xampp/htdocs/iot/storage/app/public/videos/{camera_id}_{current_date}.mp4'
    out = cv2.VideoWriter(output_filename, fourcc, input_frame_rate, frame_size) 

    output_files[ip_address] = out
    
    try:
        while True:
            start_time = time.time() 
            ret, frame = cap.read()
            if not ret:
                break

            ret, buffer = cv2.imencode('.jpg', frame)
            frame_bytes = buffer.tobytes()
            yield (b'--frame\r\n' b'Content-Type: image/jpeg\r\n\r\n' + frame_bytes + b'\r\n')

            out.write(frame)  

            end_time = time.time()
            processing_time = end_time - start_time
            sleep_time = max(0, 1 / input_frame_rate - processing_time)
            time.sleep(sleep_time)
    finally:
        # Release resources in the finally block
        out.release()
        cap.release()
        cv2.destroyAllWindows()

if __name__ == "__main__":
    app.run(debug=True)
    # Use threading to run Flask in multiple threads
    threading.Thread(target=app.run, kwargs={'debug':True}).start()

