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
                                <h1 data-animation="bounceIn" data-delay="0.2s">Login Now</h1>
                                <!-- breadcrumb Start-->
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                        <li class="breadcrumb-item"><a href="#">Login</a></li> 
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
                    <?php
						error_reporting(0);
						if($_REQUEST['st']=="fail")
						{
							echo"<div class='alert alert-danger alert-dismissible fade show' role='alert'>
							<center><b>Incorrect Username or Password!<b></center>
						</div>";
						}
						?>
					<form class="form-contact contact_form"  method="post" action="redirect.php">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input class="form-control valid" name="email" id="name" type="email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your name'" placeholder="Enter your email">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input class="form-control valid" name="password"  type="password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter email address'" placeholder="Password">
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <button type="submit" name="login" class="button button-contactForm boxed-btn">Login</button>
                        </div>
                    </form>
					<center>Don't have an account? <a href="register.php" style="color:blue">Register Now</a></center>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Area End -->
</main>
<br><br>
<?php
include('footer.php');
?>