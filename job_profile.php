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
                                <h1 data-animation="bounceIn" data-delay="0.2s">Job Profile</h1>
                                <!-- breadcrumb Start-->
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="index1.php">Home</a></li>
                                        <li class="breadcrumb-item"><a href="#">Job Profile</a></li> 
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
					<h2 class="contact-title"></h2>
				</div>
				<div class="col-lg-12">
					<form class="form-contact contact_form" method="post"  >
						
						
						<div class="col-12">
							<h2 class="contact-title">Qualification Details</h2>
						</div>
						
						<div class="row">
							<!-- Name -->
							<div class="col-sm-6">
								<div class="form-group">
									<label>College name</label>
									<input class="form-control valid" name="college" id="name" type="text" 
										   onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your name'" value="<?php echo $row1['college']?>"
										   placeholder="College name">
								</div>
							</div>
							<!-- Email -->
							<div class="col-sm-6">
								<div class="form-group">
									<label>Degree</label>
									<input class="form-control valid" name="degree" id="email" type="text" 
										   onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter email address'" value="<?php echo $row1['degree']?>"
										   placeholder="Degree">
								</div>
							</div>
							<!-- Phone -->
							<div class="col-sm-6">
								<div class="form-group">
									<label>CGPA</label>
									<input class="form-control valid" name="cgpa" id="phone" type="text" 
										   onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter phone'" value="<?php echo $row1['cgpa']?>"
										   placeholder="CGPA">
								</div>
							</div>
						</div>
						
						<div class="col-12">
							<h2 class="contact-title">Job Details</h2>
						</div>
						
						<div class="row">
							<!-- Name -->
							<div class="col-sm-6">
								<div class="form-group">
									<label>Job Role</label>
									<select class="form-control" name="job_role" id="job_role" onchange="fetchSkills(this.value)">
										<option value="">Select Job Role</option>
										<?php
										// Fetch all job roles from the job_post table
										$sel = mysqli_query($con, "SELECT * FROM job_post");
										while ($rows = mysqli_fetch_array($sel)) {
											// Check if the job role ID matches the selected one
											$selected = ($rows['id'] == $selected_job_role) ? 'selected' : '';
											echo "<option value='{$rows['id']}' $selected>{$rows['job_name']}</option>";
										}
										?>
									</select>
								</div>
							</div>

							<div class="col-sm-6">
								<div class="form-group">
    <label>Skills</label><br>
    <div id="skillsContainer">
        <?php
        // Assuming $row1['skills'] contains a comma-separated list of skill IDs (e.g., '1,2,3')
        $selected_skills = !empty($row1['skills']) ? explode(',', $row1['skills']) : [];

        // Fetch selected job role ID
        $selected_job_role = $row1['job_role'];

        // Fetch skills associated with the selected job role
        $skillsQuery = mysqli_query($con, "
            SELECT s.id, s.skill_name
            FROM skills s
            WHERE s.job_post_id = '$selected_job_role'
        ");

        // Loop through and display skills as checkboxes
        while ($skillRow = mysqli_fetch_array($skillsQuery)) {
            // Check if the skill ID is in the selected_skills array
            $checked = in_array($skillRow['id'], $selected_skills) ? 'checked' : '';
            echo "<label style='display: inline-block; margin-right: 10px;'>
                    <input type='checkbox' name='skills[]' value='{$skillRow['id']}' $checked> 
                    {$skillRow['skill_name']}
                  </label>";
        }
        ?>
    </div>
</div>
							</div>
							<!-- Phone -->
							<div class="col-sm-6">
								<div class="form-group">
									<label>Experience (years)</label>
									<input class="form-control valid" name="experience" id="phone" type="text" 
										   onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter phone'" value="<?php echo $row1['experience']?>"
										   placeholder="Experience">
								</div>
							</div>
						</div>
						
						<!-- Submit Button -->
						<div class="form-group mt-3">
							<input type="submit" name="submit" class="button button-contactForm boxed-btn" value="Submit">
						</div>
					</form>
				</div>

				
			</div>

        </div>
    </section>

<script>
function fetchSkills(jobRoleId) {
    if (jobRoleId == "") {
        document.getElementById("skillsContainer").innerHTML = "";
        return;
    }
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "fetch_skills.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhr.onload = function () {
        if (xhr.status == 200) {
            document.getElementById("skillsContainer").innerHTML = xhr.responseText;
        }
    };
    xhr.send("job_role=" + jobRoleId);
}

</script>
    <!-- Contact Area End -->
	
<?php
if(isset($_POST['submit']))
{
    
    $college = $_POST['college'];
    $degree = $_POST['degree'];
    $cgpa = $_POST['cgpa'];
    
    $job_role = $_POST['job_role'];
    $experience = $_POST['experience'];
    $uid = $_SESSION['uid'];

    // Store skills as a comma-separated string
    if(isset($_POST['skills']) && is_array($_POST['skills'])) {
        $skills = implode(',', $_POST['skills']);
    } else {
        $skills = ''; // If no skills are selected
    }
	
    // Check if the user already has a record
    $check = mysqli_query($con, "SELECT * FROM `job_profile` WHERE `user_id` = '$uid'");
    
    if(mysqli_num_rows($check) > 0) {
        // Update existing record
        $update = "UPDATE `job_profile` 
                   SET `college` = '$college',
                       `degree` = '$degree',
                       `cgpa` = '$cgpa',
                       `job_role` = '$job_role',
                       `skills` = '$skills',
                       `experience` = '$experience'
                   WHERE `user_id` = '$uid'";
        if(mysqli_query($con, $update)) {
            echo "<script>alert('Profile updated successfully!'); window.location='job_profile.php'</script>";
        } else {
            echo "<script>alert('Error updating profile!');</script>";
        }
    } else {
        // Insert new record
        $ins = "INSERT INTO `job_profile`(`user_id`, `college`, `degree`, `cgpa`, `job_role`, `skills`, `experience`) 
                VALUES ('$uid', '$college', '$degree', '$cgpa', '$job_role', '$skills', '$experience')";
        if(mysqli_query($con, $ins)) {
            echo "<script>alert('Profile created successfully!'); window.location='job_profile.php'</script>";
        } else {
            echo "<script>alert('Error creating profile!');</script>";
        }
    }
}

?>	
	
	
	
</main>
<?php
include('footer.php');
?>