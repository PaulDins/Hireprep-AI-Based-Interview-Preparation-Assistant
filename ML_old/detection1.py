import cv2
import numpy as np
import statistics
from keras.models import load_model
from utils.datasets import get_labels
from utils.inference import detect_faces, draw_text, draw_bounding_box, apply_offsets
from utils.preprocessor import preprocess_input
from keras import backend as K
import time
import mysql.connector

# Connect to MySQL Database
conn = mysql.connector.connect(
    host="localhost",
    user="root",
    password="",
    database="interview_prep"
)
cursor = conn.cursor()

def save_emotion_to_db(emotion):
    """Function to save detected emotion into the database."""
    query = "INSERT INTO emotions (emotion) VALUES (%s)"
    cursor.execute(query, (emotion,))
    conn.commit()

def wait_for_start_signal():
    """Continuously checks a.txt until it contains '1' to start the exam."""
    while True:
        try:
            with open("a.txt", "r") as file:
                start_signal = file.read().strip()
                if start_signal == "1":
                    print("Exam started!")
                    break
                else:
                    print("Waiting for exam to start...")
        except FileNotFoundError:
            print("Waiting for exam to start... (a.txt not found)")
        
        time.sleep(5)  # Wait for 5 seconds before checking again


def predict():
    
    wait_for_start_signal()
    
    # parameters for loading data and images
    emotion_model_path = "C:\\xampp\\htdocs\\interview_prep\\ML\\models\\emotion_model.hdf5"
    emotion_labels = get_labels('fer2013')

    # hyper-parameters for bounding boxes shape
    frame_window = 10
    emotion_offsets = (20, 40)

    # loading models
    face_cascade = cv2.CascadeClassifier("C:\\xampp\\htdocs\\interview_prep\\ML\\models\\haarcascade_frontalface_default.xml")
    emotion_classifier = load_model(emotion_model_path)

    # getting input model shapes for inference
    emotion_target_size = emotion_classifier.input_shape[1:3]

    # starting lists for calculating modes
    emotion_window = []

    # starting video streaming
    #cv2.namedWindow('window_frame') #to view window
    cap = cv2.VideoCapture(0)  # Webcam source

    start_time = time.time()  # Record the start time
    question_counter = 0  # Track number of questions asked
    max_questions = 10  # Set to 10 questions

    while cap.isOpened() and question_counter < max_questions:
        ret, bgr_image = cap.read()

        gray_image = cv2.cvtColor(bgr_image, cv2.COLOR_BGR2GRAY)
        rgb_image = cv2.cvtColor(bgr_image, cv2.COLOR_BGR2RGB)

        faces = face_cascade.detectMultiScale(gray_image, scaleFactor=1.1, minNeighbors=5,
                                              minSize=(30, 30), flags=cv2.CASCADE_SCALE_IMAGE)

        for face_coordinates in faces:
            x1, x2, y1, y2 = apply_offsets(face_coordinates, emotion_offsets)
            gray_face = gray_image[y1:y2, x1:x2]
            try:
                gray_face = cv2.resize(gray_face, (emotion_target_size))
            except:
                continue

            gray_face = preprocess_input(gray_face, True)
            gray_face = np.expand_dims(gray_face, 0)
            gray_face = np.expand_dims(gray_face, -1)
            emotion_prediction = emotion_classifier.predict(gray_face)
            emotion_probability = np.max(emotion_prediction)
            emotion_label_arg = np.argmax(emotion_prediction)
            emotion_text = emotion_labels[emotion_label_arg]
            save_emotion_to_db(emotion_text) #save to db
            emotion_window.append(emotion_text)

            if len(emotion_window) > frame_window:
                emotion_window.pop(0)

            try:
                emotion_mode = statistics.mode(emotion_window)
            except:
                continue

            # Define emotion-based color for bounding box
            if emotion_text == 'angry':
                color = emotion_probability * np.asarray((255, 0, 0))
            elif emotion_text == 'sad':
                color = emotion_probability * np.asarray((0, 0, 255))
            elif emotion_text == 'happy':
                color = emotion_probability * np.asarray((255, 255, 0))
            elif emotion_text == 'surprise':
                color = emotion_probability * np.asarray((0, 255, 255))
            elif emotion_text == 'fear':
                color = emotion_probability * np.asarray((238, 130, 238))
            elif emotion_text == 'disgust':
                color = emotion_probability * np.asarray((255, 20, 147))
            else:
                color = emotion_probability * np.asarray((0, 255, 0))

            color = color.astype(int)
            color = color.tolist()

            draw_bounding_box(face_coordinates, rgb_image, color)
            draw_text(face_coordinates, rgb_image, emotion_mode, color, 0, -45, 1, 1)

        bgr_image = cv2.cvtColor(rgb_image, cv2.COLOR_RGB2BGR)
        #cv2.imshow('window_frame', bgr_image) #to view window

        # Time check for 1 minute per question (60 seconds)
        if time.time() - start_time > 60:
            question_counter += 1
            start_time = time.time()  # Reset time for next question
            print(f"Question {question_counter} answered.")

        # Allow OpenCV to process window events
        if cv2.waitKey(1) & 0xFF == ord('q'):
            print("Manual exit triggered. Exiting...")
            break
        
        # # Check for stop signal in a text file
        # try:
        #     with open("stop_signal.txt", "r") as f:
        #         stop_signal = f.read().strip()
        #         if stop_signal == "q":
        #             print("Stop signal received. Exiting...")
        #             break
        # except FileNotFoundError:
        #     pass  # Ignore if file doesn't exist


    cap.release()
    cv2.destroyAllWindows()
    K.clear_session()

    # Calculate the most common emotion detected and infer confidence
    emotion_mode = statistics.mode(emotion_window) if emotion_window else "neutral"
    if emotion_mode in ['happy', 'surprise','neutral']:
        output = "high"  # Not confident (calm, positive emotions)
    elif emotion_mode in ['sad', 'fear']:
        output = "medium"  # Neutral emotions
    else:
        output = "low"  # Negative but strong emotions (could indicate tension or stress)

    return emotion_mode, output

out = predict()
print(out)

with open("output.txt", "w") as file:
    file.write(str(out))