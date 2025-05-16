<?php
include('header.php');
include('connection.php');

$select=mysqli_query($con,"select * from user where id='$_SESSION[uid]'");
$row=mysqli_fetch_array($select);

$select1=mysqli_query($con,"select * from job_profile where user_id='$_SESSION[uid]'");
$row1=mysqli_fetch_array($select1);

//echo $row1['job_role'];

$selected_job_role = $row1['job_role']; 


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
                                <h1 data-animation="bounceIn" data-delay="0.2s">User Profile</h1>
                                <!-- breadcrumb Start-->
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="index1.php">Home</a></li>
                                        <li class="breadcrumb-item"><a href="#">Profile</a></li> 
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
				<div class="col-12">
					<h2 class="contact-title">Personal Details</h2>
				</div>
				<div class="col-lg-12">
					<form class="form-contact contact_form" method="post"  >
						<div class="row">
							<!-- Name -->
							<div class="col-sm-6">
								<div class="form-group">
									<label>Name</label>
									<input class="form-control valid" name="name" id="name" type="text" 
										   onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your name'"  value="<?php echo $row['name']?>"
										   placeholder="Enter your name">
								</div>
							</div>
							<!-- Email -->
							<div class="col-sm-6">
								<div class="form-group">
									<label>Email</label>
									<input class="form-control valid" name="email" id="email" type="email" 
										   onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter email address'" value="<?php echo $row['email']?>"
										   placeholder="Enter email address">
								</div>
							</div>
							<!-- Phone -->
							<div class="col-sm-6">
								<div class="form-group">
									<label>Phone</label>
									<input class="form-control valid" name="phone" id="phone" type="tel" 
										   onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter phone'" value="<?php echo $row['phone']?>"
										   placeholder="Enter phone">
								</div>
							</div>
						</div>
						
						
						<!-- Submit Button -->
						<div class="form-group mt-3">
							<input type="submit" name="submit" class="button button-contactForm boxed-btn" value="Update">
						</div>
					</form>
				</div>

				
			</div>

        </div>
    </section>


	
<?php
if(isset($_POST['submit']))
{
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    
    
    $uid = $_SESSION['uid'];


        $ins = "update user set name='$name', email='$email',phone='$phone', password='$password' where id='$uid'"; 
        if(mysqli_query($con, $ins)) {
            echo "<script>alert('Profile updated successfully!'); window.location='profile.php'</script>";
        } else {
            echo "<script>alert('Error creating profile!');</script>";
        }
    }

?>	
	
	
	
</main>
<?php
include('footer.php');
?>