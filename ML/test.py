import tensorflow as tf
import matplotlib.pyplot as plt
import seaborn as sns
import numpy as np
from sklearn.metrics import classification_report, confusion_matrix
from sklearn.metrics import precision_recall_fscore_support
from tensorflow.keras.models import load_model

# Load the trained model
model = load_model("best_model.h5")

# Paths to the test data
TEST_PATH = "C:\\Users\\USER\\Desktop\\Final_Project\\FER_training\\data\\test"  # Update with your test path
IMG_SIZE = (299, 299)
BATCH_SIZE = 32

# Data preprocessing (rescaling only for test data)
test_datagen = tf.keras.preprocessing.image.ImageDataGenerator(rescale=1.0 / 255)

# Data generator for the test data
test_generator = test_datagen.flow_from_directory(
    TEST_PATH,
    target_size=IMG_SIZE,
    batch_size=BATCH_SIZE,
    class_mode="categorical"
)

# Evaluate the model on the test data
test_loss, test_accuracy = model.evaluate(test_generator)
print(f"Test Loss: {test_loss}")
print(f"Test Accuracy: {test_accuracy}")

# Get predictions from the model
y_pred = model.predict(test_generator)
y_pred_classes = np.argmax(y_pred, axis=1)  # Get class with highest probability

# True labels from the generator
y_true = test_generator.classes

# Class names (the labels used in the generator, e.g., 'anger', 'happy', etc.)
class_names = list(test_generator.class_indices.keys())

# Confusion Matrix
cm = confusion_matrix(y_true, y_pred_classes)

# Plot confusion matrix
plt.figure(figsize=(8, 6))
sns.heatmap(cm, annot=True, fmt="d", cmap="Blues", xticklabels=class_names, yticklabels=class_names)
plt.xlabel('Predicted')
plt.ylabel('True')
plt.title('Confusion Matrix')
plt.show()

# Calculate precision, recall, and F1-score
precision, recall, f1, _ = precision_recall_fscore_support(y_true, y_pred_classes, average=None)

# Print classification report (for precision, recall, and F1-score)
report = classification_report(y_true, y_pred_classes, target_names=class_names)
print(report)

# Plot Precision, Recall, and F1-Score for each class (Line Graph)
plt.figure(figsize=(12, 6))

# Plot Precision (Line graph)
plt.subplot(1, 3, 1)
plt.plot(class_names, precision, marker='o', color='skyblue', label='Precision', linestyle='-', markersize=6)
plt.title('Precision')
plt.xlabel('Emotion')
plt.ylabel('Precision')
plt.xticks(rotation=45)
plt.grid(True)

# Plot Recall (Line graph)
plt.subplot(1, 3, 2)
plt.plot(class_names, recall, marker='o', color='lightgreen', label='Recall', linestyle='-', markersize=6)
plt.title('Recall')
plt.xlabel('Emotion')
plt.ylabel('Recall')
plt.xticks(rotation=45)
plt.grid(True)

# Plot F1-Score (Line graph)
plt.subplot(1, 3, 3)
plt.plot(class_names, f1, marker='o', color='salmon', label='F1-Score', linestyle='-', markersize=6)
plt.title('F1-Score')
plt.xlabel('Emotion')
plt.ylabel('F1-Score')
plt.xticks(rotation=45)
plt.grid(True)

# Show the plots
plt.tight_layout()
plt.show()
