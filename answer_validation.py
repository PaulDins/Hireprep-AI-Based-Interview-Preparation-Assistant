


from sentence_transformers import SentenceTransformer, util
import mysql.connector

# Load SBERT model
model = SentenceTransformer('all-MiniLM-L6-v2')

# Connect to MySQL database
db_connection = mysql.connector.connect(
    host="localhost",
    user="root",
    password="",
    database="interview_prep"
)

cursor = db_connection.cursor()

# Fetch all correct answers from the 'questions' table
cursor.execute("SELECT id, answer FROM questions")
question_answers = {row[0]: row[1] for row in cursor.fetchall()}  # {q_id: correct_answer}

# Fetch user answers with 'pending' status
user_id = 1  # Change this to the actual user_id
cursor.execute("SELECT id, user_id, q_id, answer FROM answer WHERE user_id = %s AND status = %s",
               (user_id, "pending"))
user_answers = cursor.fetchall()

# Prepare data for printing scores
print(f"{'Question ID':<12} | {'Similarity Score':<17} | {'Score (Out of 10)'}")
print("-" * 65)

total_score = 0
num_questions = 0  # To calculate an average score
counter=0

# Process answers using BERT
for answer_id, user_id, q_id, user_response in user_answers:
    correct_answer = question_answers.get(q_id, "")

    if not correct_answer.strip() or not user_response.strip():
        # For unanswered or empty responses, set score to 0
        similarity_score = 0.0
        score_out_of_10 = 0.00
    else:
        # Encode both answers using BERT
        correct_embedding = model.encode(correct_answer, convert_to_tensor=True)
        user_embedding = model.encode(user_response, convert_to_tensor=True)

        # Compute cosine similarity using SBERT
        similarity_score = util.pytorch_cos_sim(correct_embedding, user_embedding).item()

        # Clip the similarity score to avoid negative values
        similarity_score = max(similarity_score, 0)  # Ensure similarity score is at least 0

        # Convert similarity to a score out of 10
        score_out_of_10 = round(similarity_score * 10, 2)

    total_score += score_out_of_10
    num_questions += 1
    counter+=1

    # Print individual scores
    print(f"{counter:<10} | {similarity_score:<18.2f} | {score_out_of_10}/10")

# Compute final score percentage
if num_questions > 0:
    final_score = round((total_score / (num_questions * 10)) * 100, 2)  # Normalize to 100
else:
    final_score = 0

# Print final user score
print("\nFinal User Score:")
print("-" * 30)
print(f"Total Score = {final_score:.2f}/100")

with open("answer_score.txt", "w") as file:
    file.write(f"{final_score:.2f}")

# Close connection
cursor.close()
db_connection.close()


# In[ ]:


#pip install sentence-transformers
# pip install "sentence-transformers<2.0.0"
# pip install "transformers<4.0.0"


# # In[ ]:


# pip install "sentence-transformers<2.0.0"
# pip install "transformers<4.0.0"
# pip install "torch<1.10.0"

