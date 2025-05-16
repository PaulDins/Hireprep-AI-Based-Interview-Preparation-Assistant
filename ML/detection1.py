import numpy as np
import tensorflow as tf
import cv2
import mysql.connector
import statistics
import time
from keras.models import load_model

# Load the trained model
print("Loading model...")
model = load_model("best_model.h5")  #  model path
print("Model loaded.")

# Define emotion labels
labels = ['anger', 'contempt', 'disgust', 'fear', 'happy', 'neutral', 'sad', 'surprise']

# Connect to MySQL Database
conn = mysql.connector.connect(
    host="localhost",
    user="root",
    password="",
    database="interview_prep"
)
cursor = conn.cursor()

# Function to save only detected emotion into the database
def save_emotion_to_db(emotion):
    query = "INSERT INTO emotions (emotion) VALUES (%s)"
    cursor.execute(query, (emotion,))
    conn.commit()

# Function to determine the most common emotion & confidence level
def get_emotion_confidence(emotion_window):
    if not emotion_window:
        return "neutral", "medium"

    emotion_mode = statistics.mode(emotion_window)  

    if emotion_mode in ['happy', 'surprise']:
        confidence = "low"  # Positive emotions, less confident
    elif emotion_mode in ['sad', 'fear', 'neutral']:
        confidence = "medium"  # Neutral or uncertain emotions
    else:
        confidence = "high"  # Strong emotions, possible tension

    return emotion_mode, confidence

camera_running = False

# Wait for a.txt signal to start
while True:
    try:
        with open("a.txt", "r") as file:
            start_signal = file.read().strip()
            if start_signal == "1" and camera_running:
                print("Starting emotion detection...")
                camera_running = False
                #break
            else:
                print("Waiting for signal...")
    except FileNotFoundError:
        print("Waiting for signal... (a.txt not found)")
    
    time.sleep(5)  # Check every 5 seconds

# Open the webcam
cap = cv2.VideoCapture(0)  # Use 0 for the default webcam
emotion_window = []  # Store detected emotions

while True:
    # Check if the exam should stop
    try:
        with open("a.txt", "r") as file:
            stop_signal = file.read().strip()
            if stop_signal == "0" and not camera_running:
                print("Stopping emotion detection...")
                camera_running = True
                #break
    except FileNotFoundError:
        print("a.txt not found, continuing...")

    ret, frame = cap.read()
    if not ret:
        print("Failed to grab frame")
        break

    # Preprocess the frame
    img = cv2.resize(frame, (299, 299))  
    img = img.astype("float32") / 255.0  # Normalize
    img = np.expand_dims(img, axis=0)  # Add batch dimension

    # Make prediction
    predictions = model.predict(img, verbose=0)
    predicted_class_indices = np.argmax(predictions, axis=1)
    detected_emotion = labels[predicted_class_indices[0]]

    # Maintain a rolling window of last 10 emotions
    emotion_window.append(detected_emotion)
    if len(emotion_window) > 10:
        emotion_window.pop(0)

    # Get the most common emotion & confidence level
    emotion_mode, confidence = get_emotion_confidence(emotion_window)

    # Save only the detected emotion to database
    save_emotion_to_db(emotion_mode)

    # Display result on video feed
    cv2.putText(frame, f"{emotion_mode} ({confidence})", (50, 50), 
                cv2.FONT_HERSHEY_SIMPLEX, 1, (0, 255, 0), 2)
    cv2.imshow("Live Emotion Detection", frame)

    # Press 'q' to exit
    if cv2.waitKey(1) & 0xFF == ord('q'):
        break

# Release resources
cap.release()
cv2.destroyAllWindows()
conn.close()
print("Emotion detection stopped.")

