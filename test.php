<?php
$i = 1;

// Open the pop-up window before starting the loop
echo "<script type='text/javascript'>
    var popUpWindow = window.open('about:blank', '_blank', 'width=100,height=50'); // Small size for \"minimized\" look
    
    // You can add content if needed (we're not adding content here as it's minimized)
    // popUpWindow.document.write('<h1>Test Running...</h1>');
</script>";

while ($i < 100) {
  echo $i;
  $i++;
} 

// JavaScript to close the pop-up after loop execution
echo "<script type='text/javascript'>
    // Wait for the loop to finish and then close the window after a small delay
    setTimeout(function() {
        popUpWindow.close(); // Close the pop-up after a delay
    }, 500); // Close it shortly after loop ends
</script>";
?>
