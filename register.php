<?php
include('header.php');
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
                                <h1 data-animation="bounceIn" data-delay="0.2s">Register Now</h1>
                                <!-- breadcrumb Start-->
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                        <li class="breadcrumb-item"><a href="#">Register</a></li> 
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
    <!--?  Contact Area start  -->
    <section class="contact-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <form class="form-contact contact_form" method="post" >
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<input class="form-control valid" name="name" id="name" type="text" 
										   onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your name'" 
										   placeholder="Enter your name" required>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<input class="form-control valid" name="email" id="email" type="email" 
										   onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter email address'" 
										   placeholder="Enter email address" required>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<input class="form-control valid" name="phone" id="phone" type="text" 
										   onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your phone number'" 
										   placeholder="Enter your phone number" required>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<input class="form-control valid" name="password" id="password" type="password" 
										   onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your password'" 
										   placeholder="Enter your password" required>
								</div>
							</div>
						</div>
						<div class="form-group mt-3">
							<input type="submit" name="submit" class="button button-contactForm boxed-btn" value="Register">
						</div>
					</form>

					<center>Already have an account? <a href="login.php" style="color:blue">Login Now</a></center>
                </div>
            </div>
        </div>
    </section>
	
<?php
	  include("connection.php");
	  if(isset($_POST['submit']))
	  {
		  $name=$_POST['name'];
		  $email=$_POST['email'];
		  $phone=$_POST['phone'];
		  $password=$_POST['password'];
		  
		  $ins="INSERT INTO `user`(`name`, `email`, `phone`, `password`) 
		  values('$name','$email','$phone','$password')";
		  echo $ins;
		  $res=mysqli_query($con,$ins);
		  if($res)
		  {
		  echo '<script>alert("Succesfully Registered!")
			  window.location="login.php";
			  </script>';
		  }
		  
	  }
	  ?>
    <!-- Contact Area End -->
</main>
<?php
include('footer.php');
?>