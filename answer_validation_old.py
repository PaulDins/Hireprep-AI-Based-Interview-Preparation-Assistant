from sklearn.feature_extraction.text import TfidfVectorizer
from sklearn.metrics.pairwise import cosine_similarity
import mysql.connector

# Connect to the MySQL database
db_connection = mysql.connector.connect(
    host="localhost",  
    user="root",  
    password="",  
    database="interview_prep"  
)

cursor = db_connection.cursor()

# Fetch all correct answers from the questions table
cursor.execute("SELECT id, answer FROM questions")
question_answers = {row[0]: row[1] for row in cursor.fetchall()}  # Dictionary {q_id: correct_answer}

#user_id = 1  # Specify the user ID
with open("user_id.txt", "r") as file:
    user_id = file.read().strip()  # Read and remove any extra spaces or newlines

# Fetch all answers from the 'answer' table for the given user with 'pending' status
cursor.execute("SELECT id, user_id, q_id, answer FROM answer WHERE user_id = %s AND status = %s", (user_id, "pending"))
user_answers = cursor.fetchall()

# Initialize user scores
user_scores = {}

# Print header with proper alignment
print(f"{'Question ID':<12} | {'Similarity Score':<18} | {'Score (Out of 10)'}")
print("-" * 65)

counter=1

with open("answer_output.txt", "w") as file:
    file.write(f"{'Question':<12} | {'Similarity':<18} | {'Score'}\n")
    file.write("-" * 40 + "\n")

    for answer_id, user_id, q_id, user_response in user_answers:
        if q_id in question_answers:
            correct_answer = question_answers[q_id]
            
            # Compute cosine similarity
            vectorizer = TfidfVectorizer()
            vectors = vectorizer.fit_transform([correct_answer, user_response])
            similarity_score = cosine_similarity(vectors[0], vectors[1])[0][0]
            
            # Convert similarity to a score out of 10
            score_out_of_10 = round(similarity_score * 10, 2)

            # Store user total score
            user_scores[user_id] = user_scores.get(user_id, 0) + score_out_of_10

            # Format output
            output_line = f"{counter:<12} | {similarity_score:<18.2f} | {score_out_of_10}/10\n"
            print(output_line.strip())  # Print to console
            file.write(output_line)  # Save to file
            
            counter += 1

max_possible_score = counter * 10

# Print total scores per user
print("\nFinal User Scores:")
print("-" * 30)
# for user_id, total_score in user_scores.items():
#     print(f"Total Score = {total_score:.2f}/100")

with open("answer_score.txt", "w") as file:
    for user_id, total_score in user_scores.items():
        percentage_score = (total_score / max_possible_score) * 100 if max_possible_score > 0 else 0
        file.write(f"{percentage_score:.2f}\n")  # Write only the score without extra text
        print(f"User {user_id} Total Score = {percentage_score:.2f}%")
        

# Close connection
cursor.close()
db_connection.close()