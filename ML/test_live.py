import numpy as np
import tensorflow as tf
import cv2
from keras.models import load_model

# Load the trained model
print("Loading model...")
model = load_model("best_model.h5")  #add model path
print("Model loaded.")

labels = ['anger', 'contempt', 'disgust', 'fear', 'happy', 'neutral', 'sad', 'surprise']

# Open the webcam
cap = cv2.VideoCapture(0)  # Use 0 for default webcam (primary camera)

while True:
    ret, frame = cap.read()
    if not ret:
        print("Failed to grab frame")
        break

    # Preprocess the frame
    img = cv2.resize(frame, (299, 299))  # Resize for InceptionV3
    img = img.astype("float32") / 255.0  # Normalize
    img = np.expand_dims(img, axis=0)  # Add batch dimension

    # Make prediction
    predictions = model.predict(img, verbose=0)
    predicted_class_indices = np.argmax(predictions, axis=1)
    predicted_label = labels[predicted_class_indices[0]]

    # Display the result on the video feed
    cv2.putText(frame, predicted_label, (50, 50), cv2.FONT_HERSHEY_SIMPLEX, 1, (0, 255, 0), 2)
    cv2.imshow("Live Prediction", frame)

    # Press 'q' to exit
    if cv2.waitKey(1) & 0xFF == ord('q'):
        break

# Release resources
cap.release()
cv2.destroyAllWindows()
