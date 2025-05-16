<?php
include('header.php');
include('connection.php');

?>
<style>
.form-control{
	font-size: 1.7rem !important;
}

</style>
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
                                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                            <li class="breadcrumb-item"><a href="#">Exam</a></li> 
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
$question_limit = 5; // Fetch 10 questions per round

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

    // Fetch questions from each skill using round-robin
    foreach ($user_skills as $skill) {
        $query = "SELECT * FROM questions 
                  WHERE level = '$experience_level' 
                  AND FIND_IN_SET('$skill', skill) 
                  AND id NOT IN (SELECT q_id FROM answer WHERE user_id = '$user_id')
                  LIMIT $question_limit";

        $result = mysqli_query($con, $query);
        
        while ($question = mysqli_fetch_assoc($result)) {
            $all_questions[$skill][] = $question;
        }
    }

    // Apply round-robin scheduling
    $index = 0;
    while (count($selected_questions) < $question_limit) {
        foreach ($user_skills as $skill) {
            if (isset($all_questions[$skill][$index])) {
                $selected_questions[] = $all_questions[$skill][$index];
            }
            if (count($selected_questions) >= $question_limit) break;
        }
        $index++;
    }

    // Store selected questions in session
    $_SESSION['selected_questions'] = $selected_questions;
    $_SESSION['question_index'] = 0; // Reset index
}

// **Handle Answer Submission**
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['q_id']) && isset($_POST['answer'])) {
    $q_id = $_POST['q_id'];
    $answer = mysqli_real_escape_string($con, $_POST['answer']);

    // Insert answer into the database with 'pending' status
    mysqli_query($con, "INSERT INTO answer (user_id, q_id, answer, status) VALUES ('$user_id', '$q_id', '$answer', 'pending')");

    // Move to the next question
    $_SESSION['question_index']++;
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
						<?php
							session_start();

							if (!isset($_SESSION['script_started'])) {
								$_SESSION['script_started'] = true;
								// Run the script only once when the first question loads
								$python = `python ./ML/detection.py > /dev/null 2>&1 &`;
							}

							// If questions are completed, stop the script
							if (!$qstn && isset($_SESSION['script_started'])) {
								unset($_SESSION['script_started']);
								// Stop the script (kill the background process)
								shell_exec("pkill -f detection.py");
							}
							?>

							<?php if ($qstn): ?>
								<h3>
									<span><?php echo ($current_index + 1) . ") "; ?></span>
									<span id="question-text"><?php echo $qstn; ?></span>
								</h3>
								<p id="timer" style="font-size: 20px; color: red;"></p>
								<form method="POST" id="question-form">
									<input type="hidden" name="q_id" value="<?php echo $q_id; ?>">
									<textarea class="form-control" id="answer" name="answer" rows="4" cols="50" readonly></textarea>
									<br>
									<button type="submit" class="btn btn-primary">Next</button>
								</form>
							<?php else: ?>
								<div class="row">
									<div class="col-lg-6">
										<p>Interview completed. No more questions available.</p>
										<p>
											<a href='view_answer.php' class="btn btn-success">View Answers</a>
											<a href='restart.php' class="btn btn-danger">Restart Interview</a>
										</p>
									</div>
									<div class="col-lg-6 text-center">
										<img src="filler_distribution.png" class="img-fluid rounded" alt="Filler Word Analysis">
									</div>
								</div>
							<?php endif; ?>

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
	function detectSilence() {
        silenceTimer = setInterval(() => {
            let currentTime = Date.now();
            if (currentTime - lastSpeechTime > 9000) { // 5 seconds of silence
                alert("No response detected! Moving to the next question.");
                clearInterval(silenceTimer);
                clearInterval(countdown);
                stopVoiceRecognition();
                document.getElementById("question-form").submit(); // Move to next question
            }
        }, 1000);
    }

    window.onload = function () {
        startExamProcess();
    };
</script>



<?php
include('footer.php');
?>