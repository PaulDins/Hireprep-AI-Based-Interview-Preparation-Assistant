import tensorflow as tf
from tensorflow.keras.applications import InceptionV3
from tensorflow.keras.preprocessing.image import ImageDataGenerator
from tensorflow.keras.layers import Dense, GlobalAveragePooling2D
from tensorflow.keras.models import Model
from tensorflow.keras.callbacks import ModelCheckpoint
import matplotlib.pyplot as plt

# Paths to dataset
TRAIN_PATH = "C:\\Users\\USER\\Desktop\\Final_Project\\FER_training\\data\\train"
VALID_PATH = "C:\\Users\\USER\\Desktop\\Final_Project\\FER_training\\data\\val"
IMG_SIZE = (299, 299)
BATCH_SIZE = 32
EPOCHS = 10  # Single-phase training for 100 epochs

# Data Augmentation for Training Data
train_datagen = ImageDataGenerator(
    rescale=1.0 / 255,
    rotation_range=30,
    width_shift_range=0.2,
    height_shift_range=0.2,
    shear_range=0.2,
    zoom_range=0.2,
    horizontal_flip=True
)

# Only Rescaling for Validation Data (No Augmentation)
valid_datagen = ImageDataGenerator(rescale=1.0 / 255)

# Data Generators
train_generator = train_datagen.flow_from_directory(
    TRAIN_PATH,
    target_size=IMG_SIZE,
    batch_size=BATCH_SIZE,
    class_mode="categorical"
)

val_generator = valid_datagen.flow_from_directory(
    VALID_PATH,
    target_size=IMG_SIZE,
    batch_size=BATCH_SIZE,
    class_mode="categorical"
)

# Load Pretrained InceptionV3
base_model = InceptionV3(weights="imagenet", include_top=False, input_shape=(299, 299, 3))


# Add Custom Classification Head
x = base_model.output
x = GlobalAveragePooling2D()(x)
x = Dense(512, activation="relu")(x)  
x = Dense(256, activation="relu")(x)
output_layer = Dense(7, activation="softmax")(x)  # 8 classes


model = Model(inputs=base_model.input, outputs=output_layer)



# Compile Model
model.compile(optimizer=tf.keras.optimizers.Adam(learning_rate=1e-4),
              loss="categorical_crossentropy",
              metrics=["accuracy"])


# Model Checkpoint - Saves only the best model
checkpoint = ModelCheckpoint(
    filepath="best_model.h5",
    monitor="val_accuracy",   
    save_best_only=True,      
    save_weights_only=False,
    verbose=1
)

# Train Model
history = model.fit(train_generator,
          validation_data=val_generator,
          epochs=EPOCHS,
          callbacks=[checkpoint]) 
 

# Save Final Model
model.save("emotion_model.hdf5")
print("Final model saved successfully!")



# Plot accuracy
plt.figure(figsize=(12, 4))
plt.subplot(1, 2, 1)
plt.plot(history.history['accuracy'])
plt.plot(history.history['val_accuracy'])
plt.title('Model Accuracy')
plt.ylabel('Accuracy')
plt.xlabel('Epoch')
plt.legend(['Train', 'Validation'], loc='upper left')

# Plot loss
plt.subplot(1, 2, 2)
plt.plot(history.history['loss'])
plt.plot(history.history['val_loss'])
plt.title('Model Loss')
plt.ylabel('Loss')
plt.xlabel('Epoch')
plt.legend(['Train', 'Validation'], loc='upper left')
plt.savefig('training_history.png')
