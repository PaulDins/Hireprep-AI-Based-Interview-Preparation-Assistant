<?php
include('header.php');
include('connection.php');
?>
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
                                    <h1 data-animation="bounceIn" data-delay="0.2s">View Answers</h1>
                                    <!-- breadcrumb Start-->
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="exam.php">Back</a></li>
                                            <li class="breadcrumb-item"><a href="index1.php">Home</a></li>
                                            <li class="breadcrumb-item"><a href="view_answer.php">View Answers</a></li> 
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

        <!-- top subjects End -->  
        <!-- ? services-area -->
        <div class="services-area services-area2 section-padding40">
            <div class="container">
                <div class="row justify-content-sm-center">
                    <div class="col-lg-12 col-md-6 col-sm-8">
						<div class="single-services mb-30">
							<div class="features-caption">
								<?php
								$user_id=$_SESSION['uid'];
								// Fetch the user's answers along with the correct answers from the questions table
								$query = "SELECT q.question, q.answer AS correct_answer, a.answer AS user_answer 
										  FROM questions q 
										  JOIN answer a ON q.id = a.q_id
										  WHERE a.user_id = '$user_id' AND a.status = 'pending'"; // Fetch all answers for the current user
										  //echo $query;

								$result = mysqli_query($con, $query);

								$i = 1; // Start numbering from 1
								while ($row = mysqli_fetch_assoc($result)) {
									// Display each question, correct answer, and the user's answer
								?>
									<h3><?php echo $i . ") " . $row['question']; ?> </h3>
									
									<!-- Correct answer (from the 'questions' table) -->
									<p><strong>Correct Answer:</strong></p>
									<p><?php echo $row['correct_answer']; ?></p> <br>
									
									<!-- User's answer (from the 'answer' table) -->
									<p style='color:red;'><strong>User Response:</strong></p>
									<p style='color:#ec6e28'><?php echo $row['user_answer']; ?></p> <br>
									
								<?php
									$i++;
								}
								?>
							</div>
						</div>
                    </div>
					
					<?php
					$python = `python answer_validation.py`;
					echo "<pre>".$python."</pre>";
					
					
					?>
					
                </div>
            </div>
        </div>
    </main>
<?php
include('footer.php');
?>