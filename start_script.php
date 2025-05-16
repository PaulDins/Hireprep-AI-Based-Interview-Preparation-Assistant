<?php
/*
session_start();

// Prevent duplicate starts
if (!isset($_SESSION['script_started'])) {
    $_SESSION['script_started'] = true;

    // Run the Python script
    //exec("python3 ML/detection.py > /dev/null 2>&1 &");
	$python = `python ./ML/detection.py`;
	
	// Log output for debugging
    file_put_contents("script_log.txt", $python);

    // Simulate script startup time (optional)
    sleep(3); 
}

// Send a success response
echo "Script started successfully";
*/

$myfile = fopen("ML/a.txt", "w") or die("Unable to open file!");
$txt = "1";
fwrite($myfile, $txt);
fclose($myfile);

?>
