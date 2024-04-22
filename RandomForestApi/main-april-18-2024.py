from flask import Flask, request, jsonify, Response
import joblib
import subprocess
import os
import cv2
from flask_cors import CORS
from datetime import datetime
import time
#import requests
#from io import BytesIO


app = Flask(__name__)
CORS(app)
#ap = cv2.VideoCapture('rtsp://192.168.1.3:8080/playlist.m3u')

# Load the pre-trained sklearn model
model = joblib.load("random_forest_fire_detection_model.joblib")
current_date = datetime.now().strftime("%Y-%m-%d")
output_filename = f'C:/xampp/htdocs/iot/storage/app/public/videos/{current_date}.mp4'

@app.route("/detect-fire", methods=["POST"])
def detect_fire():
    # Retrieve data from the request
    data = request.json
    
    # Extract features from the received data
    temperature = data.get("temperature")
    humidity = data.get("humidity")
    smoke = data.get("smoke")
    flame = data.get("flame")
    
    # Perform fire detection using the loaded model
    prediction = model.predict([[temperature, humidity, smoke, flame]])
    #print("PREDICTION:" + prediction)
    # Convert prediction to human-readable format
    if prediction == 0:
        result = "0"
    elif prediction == 1:
        
        result = "1"
    else:
        result = "2"
    
    # Return the result as JSON
    return jsonify({"result": result})

def check_gate():
    # Retrieve data from the request
    data = request.json
    
    # Extract features from the received data
    metal = data.get("metal")
    body_temperature = data.get("body_temperature")
   
    # Perform detection using the loaded model
    prediction = model.predict([[body_temperature, metal]])
    
    if prediction == 0:
        result = "Did not pass"
    elif prediction == 1:
        result = "Passed"
    # Return the result as JSON
    return jsonify({"result": result})

@app.route('/video_feed/<path:ip_address>')
def video_feed(ip_address):
    return Response(generate_frames(ip_address), mimetype='multipart/x-mixed-replace; boundary=frame')

def generate_frames(ip_address):
    print(f"Connecting to IP Cam at {ip_address}")
    
    rtsp_url = f'{ip_address}'
    cap = cv2.VideoCapture(rtsp_url)

    input_frame_rate = cap.get(cv2.CAP_PROP_FPS)
    print("Input Frame Rate:", input_frame_rate)

    frame_size = (int(cap.get(3)), int(cap.get(4)))
    fourcc = cv2.VideoWriter_fourcc(*'X264')
    out = cv2.VideoWriter(output_filename, fourcc, input_frame_rate, frame_size) 
    
    while True:
        start_time = time.time() 

        ret, frame = cap.read()
        if not ret:
            break
        
        #frame = cv2.rotate(frame, cv2.ROTATE_180)
        
        #current_date_time = datetime.now().strftime("%Y-%m-%d %H:%M:%S")
        #cv2.putText(frame, current_date_time, (10, 30), cv2.FONT_HERSHEY_SIMPLEX, 1, (0, 255, 0), 2, cv2.LINE_AA)

        ret, buffer = cv2.imencode('.jpg', frame)
        frame_bytes = buffer.tobytes()
        yield (b'--frame\r\n' b'Content-Type: image/jpeg\r\n\r\n' + frame_bytes + b'\r\n')

        out.write(frame)  

       
        end_time = time.time()
        processing_time = end_time - start_time
        sleep_time = max(0, 1 / input_frame_rate - processing_time)
        time.sleep(sleep_time)
    
    out.release()
    cap.release()
    cv2.destroyAllWindows()

# def generate_frames():
#     print("Connecting to IP Cam")
    
#     cap = cv2.VideoCapture('rtsp://admin:1234567890@192.168.1.3/stream1')

    
#     input_frame_rate = cap.get(cv2.CAP_PROP_FPS)
#     print("Input Frame Rate:", input_frame_rate)

#     frame_size = (int(cap.get(3)), int(cap.get(4)))
#     fourcc = cv2.VideoWriter_fourcc(*'mp4v')
#     out = cv2.VideoWriter(output_filename, fourcc, input_frame_rate, frame_size) 
    
#     while True:
#         start_time = time.time() 

#         ret, frame = cap.read()
#         if not ret:
#             break
        
#         frame = cv2.rotate(frame, cv2.ROTATE_180)
        
#         current_date_time = datetime.now().strftime("%Y-%m-%d %H:%M:%S")
#         cv2.putText(frame, current_date_time, (10, 30), cv2.FONT_HERSHEY_SIMPLEX, 1, (0, 255, 0), 2, cv2.LINE_AA)

#         ret, buffer = cv2.imencode('.jpg', frame)
#         frame_bytes = buffer.tobytes()
#         yield (b'--frame\r\n' b'Content-Type: image/jpeg\r\n\r\n' + frame_bytes + b'\r\n')

#         out.write(frame)  

       
#         end_time = time.time()
#         processing_time = end_time - start_time
#         sleep_time = max(0, 1 / input_frame_rate - processing_time)
#         time.sleep(sleep_time)
    
#     out.release()
#     cap.release()
#     cv2.destroyAllWindows()


# @app.route('/video_feed')
# def video_feed():
#     return Response(generate_frames(), mimetype='multipart/x-mixed-replace; boundary=frame')


if __name__ == "__main__":
    app.run(debug=True)
