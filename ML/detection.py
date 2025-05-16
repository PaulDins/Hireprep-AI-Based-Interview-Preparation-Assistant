import numpy as np
import tensorflow as tf
import cv2
import mysql.connector
import statistics
import time
from keras.models import load_model

# Load the trained model
print("Loading model...")
model = load_model("emotion_model.hdf5")  # model path
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

# Function to save detected emotion into the database
def save_emotion_to_db(emotion):
    query = "INSERT INTO emotions (emotion) VALUES (%s)"
    cursor.execute(query, (emotion,))
    conn.commit()

# Function to determine the most common emotion & confidence level
def get_emotion_confidence(emotion_window):
    if not emotion_window:
        return "neutral", "medium"

    emotion_mode = statistics.mode(emotion_window)  

    if emotion_mode in ['happy', 'neutral']:
        confidence = "high"  # Positive emotions, less confident
    elif emotion_mode in ['sad', 'fear', 'surprise']:
        confidence = "medium"  # Neutral or uncertain emotions
    else:
        confidence = "low"  # Strong emotions, possible tension

    return emotion_mode, confidence

camera_running = False

while True:
    try:
        with open("a.txt", "r") as file:
            signal = file.read().strip()
    except FileNotFoundError:
        print("Waiting for signal... (a.txt not found)")
        time.sleep(5)
        continue  # Retry

    if signal == "1" and not camera_running:
        print("Starting emotion detection...")
        camera_running = True
        cap = cv2.VideoCapture(0)  # Open the camera
        emotion_window = []  

    elif signal == "0" and camera_running:
        print("Stopping emotion detection...")
        camera_running = False
        cap.release()
        cv2.destroyAllWindows()
        continue  

    if camera_running:
        ret, frame = cap.read()
        if not ret:
            print("Failed to grab frame")
            continue

        # Preprocess the frame
        img = cv2.resize(frame, (299, 299))  
        img = img.astype("float32") / 255.0  # Normalize
        img = np.expand_dims(img, axis=0)  # Add batch dimension

        # Make prediction
        predictions = model.predict(img, verbose=0)
        predicted_class_indices = np.argmax(predictions, axis=1)
        detected_emotion = labels[predicted_class_indices[0]]

        
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

        # Press 'q' to exit manually
        if cv2.waitKey(1) & 0xFF == ord('q'):
            break

    time.sleep(1)  

# Cleanup
if camera_running:
    cap.release()
    cv2.destroyAllWindows()
conn.close()
print("Emotion detection script stopped.")
