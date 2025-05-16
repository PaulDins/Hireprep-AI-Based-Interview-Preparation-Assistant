<?php
include('header.php');
?>

<style>
#myBar {
	width: 10%;
	height: 30px;
	background-color: #8C0E0ED6;
	text-align: center;
	line-height: 30px;
	color: white;
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
                                    <h1 data-animation="bounceIn" data-delay="0.2s">Interview</h1>
                                    <!-- breadcrumb Start-->
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                            <li class="breadcrumb-item"><a href="#">Interview</a></li> 
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
                    <div class="col-lg-4 col-md-6 col-sm-8">
                        <a href="javascript:void(0);" onclick="startInterview();">
						<div class="single-services mb-30" style="background: #fadbff;">
                            <div class="features-icon">
                                <img src="assets/img/icon/icon1.svg" alt="">
                            </div>
                            <div class="features-caption">
                                <h3>Start Exam</h3>
                                <p>Click the button below to begin your exam. </p>
                            </div>
                        </div>
						</a>
                    </div>
					
					
					<!--
                    <div class="col-lg-4 col-md-6 col-sm-8">
                        <div class="single-services mb-30">
                            <div class="features-icon">
                                <img src="assets/img/icon/icon2.svg" alt="">
                            </div>
                            <div class="features-caption">
                                <h3>Expert instructors</h3>
                                <p>The automated process all your website tasks.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-8">
                        <div class="single-services mb-30">
                            <div class="features-icon">
                                <img src="assets/img/icon/icon3.svg" alt="">
                            </div>
                            <div class="features-caption">
                                <h3>Life time access</h3>
                                <p>The automated process all your website tasks.</p>
                            </div>
                        </div>
                    </div>
					-->
                </div>
				<div id="myProgress" style="width: 100%; background-color: #ddd; display: none;">
					<div id="myBar" style="width: 0%; height: 30px; background-color: #C86FFF; text-align: center; line-height: 30px; color: white;"></div>
				
				</div>
				<p id="progressText" style="display: none;">Starting interview... Please wait.</p>
            </div>
        </div>
    </main>
<br><br><br><br>	


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

function startInterview() {
    $("#myProgress").hide();
	// Show the progress bar
    document.getElementById("myProgress").style.display = "block";

     $("#myProgress, #progressText").show(); // Show both progress bar and text
	// Start progress bar animation
    progressBar();

    // Call the script starter after a short delay
    setTimeout(function() {
        $.get("start_script.php", function(response) {
            console.log("Script Response:", response);

            // Redirect to exam page
            window.location.href = "exam.php";
        }).fail(function(error) {
            alert("Error starting interview. Please try again.");
        });
    }, 5000); // Wait 5 seconds before calling the script
}


function progressBar() {
    var elem = document.getElementById("myBar");   
    var width = 0;
    var id = setInterval(frame, 100); // Adjust speed here
    function frame() {
        if (width >= 100) {
            clearInterval(id);
        } else {
            width++; 
            elem.style.width = width + '%'; 
            elem.innerHTML = width + '%';
        }
    }
}
</script>


<?php
include('footer.php');
?>