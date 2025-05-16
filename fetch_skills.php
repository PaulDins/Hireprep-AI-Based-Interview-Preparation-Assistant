<?php
include('connection.php');

if (isset($_POST['job_role'])) {
    $job_role = $_POST['job_role'];
    
    // Fetch skills based on the selected job role
    $sel = mysqli_query($con, "SELECT * FROM skills WHERE job_post_id = '$job_role'");
    
    // Check if any skills are found
    if (mysqli_num_rows($sel) > 0) {
        while ($rows = mysqli_fetch_array($sel)) {
             echo '<label style="margin-right: 15px;">
                    <input type="checkbox" name="skills[]" value="' . $rows['id'] . '">
                    ' . $rows['skill_name'] . '
                  </label>';
        }
    } else {
        echo '<p>No skills available for this job role.</p>';
    }
}
?>
