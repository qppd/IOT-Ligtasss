import requests

# JSON data to send in the request body
data = {"temperature": 38.7, "humidity": 70}  # Replace this with your actual JSON data

# URL of your Flask server
url = "http://localhost:5000/detect-fire"  # Update the URL if your server is running on a different address or port

# Send POST request with JSON data
response = requests.post(url, json=data)

# Check the response
if response.status_code == 200:
    print("Request successful!")
    print("Response JSON:", response.json())
else:
    print("Request failed with status code:", response.status_code)