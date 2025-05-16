<?php
include('header.php');
include('connection.php');

?>
<style>
.form-control{
	font-size: 1.7rem !important;
}
.stars {
            font-size: 24px;
            color: gold;
        }

        .circle-progress {
            width: 150px;
            height: 150px;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: conic-gradient(#00ffcc <?php echo $aggregate * 3.6; ?>deg, #444 0);
            box-shadow: 0px 0px 15px rgba(0, 255, 200, 0.7);
        }
        .circle-progress span {
            position: absolute;
            font-size: 24px;
            font-weight: bold;
        }
        .score-container {
            margin: 20px;
            width: 300px;
            text-align: center;
        }
         .progress-container {
            position: relative;
            width: 150px;
            height: 150px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .progress-circle::before {
            content: "";
            position: absolute;
            width: 80%;
            height: 80%;
            background: white;
            border-radius: 50%;
        }
		.progress-circle1::before {
            content: "";
            position: absolute;
            width: 80%;
            height: 80%;
            background: white;
            border-radius: 50%;
        }
		.progress-circle2::before {
            content: "";
            position: absolute;
            width: 80%;
            height: 80%;
            background: white;
            border-radius: 50%;
        }
		.progress-circle3::before {
            content: "";
            position: absolute;
            width: 80%;
            height: 80%;
            background: white;
            border-radius: 50%;
        }

        .progress-text {
            position: absolute;
            font-size: 24px;
            font-weight: bold;
            color: black;
        }


</style>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Header End -->
    <main>
        <!--? slider Area Start-->
        <section class="slider-area slider-area2">
            <div class="slider-active">
                <!-- Single Slider -->
                <div class="single-slider slider-height2">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-8 col-lg-11 col-md-12">
                                <div class="hero__caption hero__caption2">
                                    <h1 data-animation="bounceIn" data-delay="0.2s">Exam</h1>
                                    <!-- breadcrumb Start-->
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="index1.php">Home</a></li>
                                            <li class="breadcrumb-item"><a href="exam.php">Exam</a></li> 
                                        </ol>
                                    </nav>
                                    <!-- breadcrumb End -->
                                </div>
                            </div>
                        </div>
                    </div>          
                </div>
            </div>
        </section>
        <!-- Courses area start -->

<?php
// Start session
session_start();

$user_id = $_SESSION['uid']; // Logged-in user ID

// Fetch user details
$sel = mysqli_query($con, "SELECT * FROM job_profile WHERE user_id='$user_id'");
$cc = mysqli_fetch_array($sel);

$skills = $cc['skills'];
$experience = $cc['experience'];
$question_limit = 10; // Fetch 10 questions per round

// Determine experience level based on years of experience
if ($experience <= 2) {
    $experience_level = 'Basic';
} elseif ($experience <= 5) {
    $experience_level = 'Intermediate';
} else {
    $experience_level = 'Advanced';
}

// Get user's skills
$user_skills = explode(',', $skills);

// **Check if there are pending answers**
$check_status = mysqli_query($con, "SELECT COUNT(*) AS pending_count FROM answer WHERE user_id='$user_id' AND status='pending'");
$status_result = mysqli_fetch_assoc($check_status);

// **Round-robin selection of questions**
$selected_questions = [];
if ($status_result['pending_count'] == 0) {
    $all_questions = [];

    // Build query to get all questions the user hasn't answered yet
    $query = "SELECT * FROM questions 
              WHERE level = '$experience_level' 
              AND (";
    
    $skill_conditions = [];
    foreach ($user_skills as $skill) {
        $skill_conditions[] = "FIND_IN_SET('$skill', skill)";
    }
    
    $query .= implode(" OR ", $skill_conditions);
    $query .= ") AND id NOT IN (SELECT q_id FROM answer WHERE user_id = '$user_id')";
    
    $result = mysqli_query($con, $query);
    $available_questions = mysqli_num_rows($result);
    
    // If no more questions are available, clear the session variables
    if ($available_questions == 0) {
        unset($_SESSION['selected_questions']);
        unset($_SESSION['question_index']);
    } else {
        // Sort questions by skill for round-robin selection
        while ($question = mysqli_fetch_assoc($result)) {
            foreach ($user_skills as $skill) {
                if (strpos($question['skill'], $skill) !== false) {
                    $all_questions[$skill][] = $question;
                    break; // Assign question to first matching skill
                }
            }
        }

        // Apply round-robin scheduling
        $index = 0;
        while (count($selected_questions) < $question_limit && count($selected_questions) < $available_questions) {
            foreach ($user_skills as $skill) {
                if (isset($all_questions[$skill][$index])) {
                    $selected_questions[] = $all_questions[$skill][$index];
                }
                if (count($selected_questions) >= $question_limit || 
                    count($selected_questions) >= $available_questions) break;
            }
            $index++;
            // Prevent infinite loop if not enough questions
            if ($index > 100) break;
        }

        // Store selected questions in session only if we found some
        if (count($selected_questions) > 0) {
            $_SESSION['selected_questions'] = $selected_questions;
            $_SESSION['question_index'] = 0; // Reset index
        } else {
            unset($_SESSION['selected_questions']);
            unset($_SESSION['question_index']);
        }
    }
}

// // **Handle Answer Submission**
// if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['q_id']) && isset($_POST['answer'])) {
//     $q_id = $_POST['q_id'];
//     $answer = mysqli_real_escape_string($con, $_POST['answer']);

//     // Insert answer into the database with 'pending' status
//     mysqli_query($con, "INSERT INTO answer (user_id, q_id, answer, status) VALUES ('$user_id', '$q_id', '$answer', 'pending')");

//     // Move to the next question
//     $_SESSION['question_index']++;
    
//     // If we've reached the end of questions, clear session variables
//     if (!isset($_SESSION['selected_questions']) || 
//         $_SESSION['question_index'] >= count($_SESSION['selected_questions'])) {
//         unset($_SESSION['selected_questions']);
//         unset($_SESSION['question_index']);
//     }
// }

// **Handle Answer Submission**
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['q_id']) && isset($_POST['answer'])) {

    if (!isset($_SESSION['last_question_processed']) || $_SESSION['last_question_processed'] !== $q_id) {
        $q_id = $_POST['q_id'];
        $answer = mysqli_real_escape_string($con, $_POST['answer']);

        // Insert answer into the database with 'pending' status
        mysqli_query($con, "INSERT INTO answer (user_id, q_id, answer, status) VALUES ('$user_id', '$q_id', '$answer', 'pending')");

        // Mark this question as processed
        $_SESSION['last_question_processed'] = $q_id;

        // Move to the next question
        $_SESSION['question_index']++;
    }
    
    // If we've reached the end of questions, clear session variables
    if (!isset($_SESSION['selected_questions']) || 
        $_SESSION['question_index'] >= count($_SESSION['selected_questions'])) {
        unset($_SESSION['selected_questions']);
        unset($_SESSION['question_index']);
        unset($_SESSION['last_question_processed']);
    }
}


// **Get the current question from session**
$selected_questions = isset($_SESSION['selected_questions']) ? $_SESSION['selected_questions'] : array();
$current_index = isset($_SESSION['question_index']) ? $_SESSION['question_index'] : 0;
$qstn = isset($selected_questions[$current_index]) ? $selected_questions[$current_index]['question'] : null;
$q_id = isset($selected_questions[$current_index]) ? $selected_questions[$current_index]['id'] : null;
?>




		<!-- Display the Question Form -->
		<div class="col-lg-12" style="padding: 115px;">
			<div class="properties properties2 mb-30">
				<div class="properties__card">
					<div class="properties__caption">
						<?php if ($qstn){ ?>
						
							
							
							
						
							<h3>
								<span><?php echo ($current_index + 1) . ") "; ?></span>
								<span id="question-text"><?php echo $qstn; ?></span>
							</h3>
							<p id="timer" style="font-size: 20px; color: red;"></p>
							<form method="POST" id="question-form">
								<input type="hidden" name="q_id" value="<?php echo $q_id; ?>">
								<textarea class="form-control" id="answer" name="answer" rows="4" cols="50" ></textarea>
								<br>
								<!-- Next Button -->
								<button type="submit" class="btn btn-primary">
									Next
								</button>
							</form>
						<?php 
                    }
                    else{
                        ?>
						<?php
							// $myfile = fopen("ML/stop_signal.txt", "w") or die("Unable to open file!");
							// $txt = "q";
							// fwrite($myfile, $txt);
							// fclose($myfile);
							
							$myfile1 = fopen("ML/a.txt", "w") or die("Unable to open file!");
							$txt1 = "0";
							fwrite($myfile1, $txt1);
							fclose($myfile1);

                            // $myfile1 = fopen("ML/a.txt", "w") or die("Unable to open file!");
							// $txt1 = "0";
							// if(fwrite($myfile1, $txt1) !== false){
                            //     fclose($myfile1);
                            //     //header('location:exam.php');
                            //     echo "<script>window.location='exam.php'</script>";
                            // }else{
                            //     fclose($myfile1);
                            //     echo "failed!!!!!!";
                            // }
							

                            //mysqli_query($con,"truncate emotions");
							?>
						
							
							
                        <div class="courses-area section-padding40 fix" style="padding-top: 0px;">
								<div class="container">
									<p>Interview completed. </p>
									<p>
										<a href='view_answer.php' style='color:' class="btn btn-success">View Answers</a>
										<a href='restart.php' style='color:' class="btn btn-danger">Restart Interview</a>
									</p>
									
									<!-- confidence score -->
									<?php
									$query = mysqli_query($con, "SELECT * FROM emotions ORDER BY id DESC");

									$emotions = [];
									while ($row = mysqli_fetch_array($query)) {
										$emotions[] = $row['emotion'];
									}

									// Count occurrences of each emotion
									$emotion_counts = array_count_values($emotions);

									// Determine the most frequent emotion
									$emotion_mode = array_search(max($emotion_counts), $emotion_counts);

									// Define confidence levels based on emotion mode
									$confidence_levels = [
										"low" => ["score" => 40, "stars" => 2, "label" => "low"],    // 40% confidence
										"medium" => ["score" => 60, "stars" => 3, "label" => "medium"], // 60% confidence
										"high" => ["score" => 90, "stars" => 5, "label" => "high"]    // 90% confidence
									];

									// Assign confidence level and score
									if (in_array($emotion_mode, ['happy', 'neutral'])) {
										$confidence = "high";  // Positive emotions → less stress
									} elseif (in_array($emotion_mode, ['sad', 'fear', 'surprise'])) {
										$confidence = "medium";  // Neutral emotions
									} else {
										$confidence = "low";  // Strong negative emotions → stress/tension
									}

									$confidence_score = $confidence_levels[$confidence]['score'];
									$stars = $confidence_levels[$confidence]['stars'];

                                    $confidence_label = $confidence_levels[$confidence]['label'];
									file_put_contents("confident_score.txt", $confidence_label);

									// Generate star symbols
									function generateStars($numStars) {
										return str_repeat("&#9733;", $numStars) . str_repeat("&#9734;", 5 - $numStars);
									}
									
									#filler score
									$python = `python filler.py`;
									$fscore = file_get_contents("filler_score.txt");
									
									$python1 = `python answer_validation.py`;
									$ascore = file_get_contents("answer_score.txt");
									
									$aggregate = round(($confidence_score + $fscore + $ascore) / 3, 2);
									?>

<style>
        .progress-circle {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            background: conic-gradient(
                #C86FFF <?php echo $aggregate * 3.6; ?>deg,  /* Fills based on percentage */
                #eee 0deg
            );
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }
		
		.progress-circle1 {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            background: conic-gradient(
                #f3b4cd <?php echo $ascore * 3.6; ?>deg,  /* Fills based on percentage */
                #eee 0deg
            );
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }
		.progress-circle2 {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            background: conic-gradient(
                #ffddb0 <?php echo $fscore * 3.6; ?>deg,  /* Fills based on percentage */
                #eee 0deg
            );
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }
		.progress-circle3 {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            background: conic-gradient(
rgb(130, 226, 226) <?php echo $confidence_score * 3.6; ?>deg,  /* Fills based on percentage */
                #eee 0deg
            );
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }
		
		.vprogress-container {
            width: 100%;
            max-width: 1100px; /* Set max width */
            height: 30px; /* Bar height */
            background-color: #eee;
            border-radius: 15px;
            overflow: hidden;
            position: relative;
            border: 2px solid #b46cff;
        }

        .vprogress-bar {
            width: <?php echo $aggregate; ?>%; /* Set width dynamically */
            height: 100%;
            background: linear-gradient(90deg, #b46cff, #da69ff);
            transition: width 0.5s ease-in-out;
        }

        .vprogress-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 16px;
            font-weight: bold;
            color: black;
        }
</style>					
									 <div class="row">
										<div class="col-lg-12">
											<div class="properties properties2 mb-30">
												<div class="properties__card" style="background-color: aliceblue;">
													<div class="properties__caption">
														<h3>Interview Score</h3>
														
														<!-- aggregate score-->
														<div class="vprogress-container">
															<div class="vprogress-bar"></div>
															<span class="vprogress-text"><?php echo $aggregate; ?>%</span>
														</div>
														<br>
														<div class="properties__footer d-flex justify-content-between align-items-center" style="width: 100%;">
															<div class="restaurant-name" style="width: 100%;">
																<table style="width:100%; solid #ddd; text-align:center;">
																	<tr>
																		<th>
																			<center>
																			<div class="progress-container">
																				<div class="progress-circle3">
																					<span class="progress-text"><?php echo $confidence_score; ?>%</span>
																				</div>
																			</div></center>
																			Confidence Level: <?php echo $confidence_score;?>% 
																		</th>
																		<th>
																			<center>
																			<div class="progress-container">
																				<div class="progress-circle2">
																					<span class="progress-text"><?php echo $fscore; ?>%</span>
																				</div>
																			</div></center>
																			Filler Score: <?php echo $fscore; ?>%
																		</th>
																		<th>
																			<center>
																			<div class="progress-container">
																				<div class="progress-circle1">
																					<span class="progress-text"><?php echo $ascore; ?>%</span>
																				</div>
																			</div></center>
																			Answer Score: <?php echo $ascore; ?>%
																		</th>
																	</tr>
																</table>
                                                                <br><br>
                                                                <a href="view_result.php" style="color:#c56bff">View Details >>></a>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<!-- <img src="filler_distribution.png" class="img-fluid rounded" alt="Filler Word Analysis"> -->
									</div>

								</div>
							</div>
							
							
						<?php 
                    } 
                    ?>
					</div>
				</div>
			</div>
		</div>



        </div>
    </main>
	
	
<script>
    let recognition;
    let countdown;
    let timeLeft = 60; // 60 seconds timer
    let recordingActive = false;
    let silenceTimer; // Timer for detecting silence
    let lastSpeechTime = Date.now(); // Track last time user spoke

    function startExamProcess() {
        const questionText = document.getElementById("question-text").innerText;
        speakQuestion(questionText);

        // Wait for speech to finish, then start recording
        setTimeout(() => {
            startVoiceRecognition();
            startCountdown(); // Start the timer
            detectSilence(); // Start monitoring silence
        }, 3000);
    }

    function speakQuestion(text) {
        const speech = new SpeechSynthesisUtterance(text);
        speech.lang = 'en-US';
        speech.rate = 1;
        speech.volume = 1;
        speech.pitch = 1;
        window.speechSynthesis.speak(speech);
    }

    function startVoiceRecognition() {
        if ('webkitSpeechRecognition' in window) {
            recognition = new webkitSpeechRecognition();
            recognition.lang = 'en-US';
            recognition.interimResults = true; // Capture results even before stopping
            recognition.continuous = true; // Keep recognition running
            recognition.maxAlternatives = 1;

            recognition.onstart = function () {
                recordingActive = true;
                console.log('Voice recording started...');
            };

            recognition.onresult = function (event) {
                let transcript = "";
                for (let i = 0; i < event.results.length; i++) {
                    transcript += event.results[i][0].transcript + " ";
                }
                document.getElementById('answer').value = transcript.trim();
                lastSpeechTime = Date.now(); // Reset silence timer
            };

            recognition.onerror = function (event) {
                console.error('Speech recognition error:', event.error);
                restartRecognition();
            };

            recognition.onend = function () {
                if (recordingActive && timeLeft > 0) {
                    console.log('Restarting voice recognition...');
                    restartRecognition(); // Restart recognition if it stops before time ends
                }
            };

            recognition.start();
        } else {
            alert('Speech recognition is not supported in this browser.');
        }
    }

    function restartRecognition() {
        if (recognition && timeLeft > 0) {
            recognition.start();
        }
    }

    function stopVoiceRecognition() {
        if (recognition) {
            recordingActive = false;
            recognition.stop();
            console.log('Voice recording stopped.');
        }
    }

    function startCountdown() {
        document.getElementById("timer").innerText = `Time Left: ${timeLeft} sec`;

        countdown = setInterval(() => {
            timeLeft--;
            document.getElementById("timer").innerText = `Time Left: ${timeLeft} sec`;

            if (timeLeft === 0) {
                clearInterval(countdown);
                stopVoiceRecognition(); // Stop recording
                document.getElementById("question-form").submit(); // Auto-submit form
            }
        }, 1000);
    }

    //pause detection
	// function detectSilence() {
    //     silenceTimer = setInterval(() => {
    //         let currentTime = Date.now();
    //         if (currentTime - lastSpeechTime > 18000) { // 5 seconds of silence
    //             alert("No response detected! Moving to the next question.");
    //             clearInterval(silenceTimer);
    //             clearInterval(countdown);
    //             stopVoiceRecognition();
    //             document.getElementById("question-form").submit(); // Move to next question
    //         }
    //     }, 1000);
    // }

    function detectSilence() {
    clearInterval(silenceTimer); // Clear any existing timer first

    if (<?php echo isset($selected_questions) && count($selected_questions) > 0 ? 'true' : 'false'; ?>) {
        silenceTimer = setInterval(() => {
            let currentTime = Date.now();
            let isLastQuestion = <?php echo ($current_index >= count($selected_questions) - 1) ? 'true' : 'false'; ?>;
            
            if (currentTime - lastSpeechTime > 18000) { // 5 seconds of silence
                alert("No response detected! Moving to the next question.");
                clearInterval(silenceTimer);
                clearInterval(countdown);
                stopVoiceRecognition();
                
                if (!isLastQuestion) {
                    document.getElementById("question-form").submit(); 
                }
            }
        }, 1000);
    }
}

    window.onload = function () {
        startExamProcess();
    };
</script>




<script>
/*
$(document).ready(function() {
    var scriptStarted = <?php echo json_encode($_SESSION['script_started']); ?>;
    
    if (scriptStarted) {
        $.get("run_script.php", function(response) {
            console.log("Script executed:", response);
        }).fail(function(error) {
            console.error("Error executing script:", error);
        });
    }
});
*/
</script>



<?php
include('footer.php');
?>