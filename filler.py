import mysql.connector
import re
#import matplotlib.pyplot as plt
from collections import defaultdict

# List of common filler words
filler_words = ["uh", "um", "like", "you know", "actually", "basically", "literally", "so", "right", "well"]

# Function to detect filler words and count them
def detect_filler_words(text, filler_words):
    detected = defaultdict(int)
    word_count = len(text.split())
    filler_count = 0

    for word in filler_words:
        matches = re.findall(r'\b' + re.escape(word) + r'\b', text, re.IGNORECASE)
        filler_count += len(matches)
        if matches:
            detected[word] += len(matches)
    
    return filler_count, word_count, detected

# Function to calculate score based on filler word usage
def calculate_score(filler_count, word_count):
    filler_percentage = (filler_count / word_count) * 100 if word_count else 0

    # Refined scoring based on filler percentage
    if filler_percentage > 15:
        score = 50  # Poor communication
        communication_quality = "Poor"
    elif filler_percentage > 10:
        score = 70  # Moderate communication
        communication_quality = "Moderate"
    elif filler_percentage > 5:
        score = 85  # Good communication
        communication_quality = "Good"
    else:
        score = 100  # Excellent communication (minimal fillers)
        communication_quality = "Excellent"

    return score, filler_percentage, communication_quality

# Visualization of filler word distribution
# def plot_filler_distribution(detected_fillers):
#     if not detected_fillers:
#         print("No filler words detected!")
#         return

#     words = list(detected_fillers.keys())
#     counts = list(detected_fillers.values())

#     plt.figure(figsize=(10, 6))
#     plt.bar(words, counts, color='skyblue')
#     plt.xlabel('Filler Words')
#     plt.ylabel('Frequency')
#     plt.title('Filler Word Distribution')
#     plt.xticks(rotation=45)
    #plt.show()

# Connect to the MySQL database
db_connection = mysql.connector.connect(
    host="localhost",  # Replace with your host
    user="root",  # Replace with your MySQL username
    password="",  # Replace with your MySQL password
    database="interview_prep"  # Replace with your database name
)

cursor = db_connection.cursor()

# Read user_id from the file
with open("user_id.txt", "r") as file:
    user_id = file.read().strip()
    
user_id = int(user_id)

# Fetch all answers from the 'answer' table
cursor.execute("SELECT * FROM answer WHERE user_id = %s AND status = %s", (user_id, "pending"))
answers = cursor.fetchall()

# Initialize variables to accumulate results
total_filler_count = 0
total_word_count = 0
total_score = 0
total_answers = 0
detected_fillers = defaultdict(int)
total_scores = []  # To store individual scores for overall communication quality

# Loop through each answer and detect filler words
for row in answers:
    answer_text = row[3]

    filler_count, word_count, detected = detect_filler_words(answer_text, filler_words)

    total_filler_count += filler_count
    total_word_count += word_count
    total_answers += 1

    for word, count in detected.items():
        detected_fillers[word] += count

    score, filler_percentage, communication_quality = calculate_score(filler_count, word_count)
    total_score += score
    total_scores.append(score)

    #print(f"Answer ID {row[0]} - Score: {score} - Communication Quality: {communication_quality}")

# Calculate overall communication quality
average_score = total_score / total_answers if total_answers else 0

# Determine overall communication quality based on average score
if average_score <= 60:
    overall_quality = "Poor"
elif average_score <= 80:
    overall_quality = "Moderate"
elif average_score <= 90:
    overall_quality = "Good"
else:
    overall_quality = "Excellent"

overall_filler_percentage = (total_filler_count / total_word_count) * 100 if total_word_count else 0



print("\nDetected Filler Words and Their Counts:")
for word, count in detected_fillers.items():
    print(f"{word}: {count}")
    
with open("filler_output.txt", "w") as file:
    file.write(
               f"Total Detected Fillers: {total_filler_count}\n"
               f"Total Word Count: {total_word_count}\n"
               f"Overall Filler Percentage: {overall_filler_percentage:.2f}%\n"
               f"Average Score: {average_score:.2f}\n"
               f"Overall Communication Quality: {overall_quality}\n")

print("Results saved to filler_output.txt")

with open("filler_score.txt", "w") as file:
    file.write(f"{average_score:.2f}")

# Plot the detected filler words
#plot_filler_distribution(detected_fillers)
# Save the plot as an image file
#plt.savefig('filler_distribution.png')
# Close the database connection
cursor.close()
db_connection.close()
