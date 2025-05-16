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
                        <h1 data-animation="bounceIn" data-delay="0.2s">View Result</h1>
                        <!-- breadcrumb Start-->
                        <nav aria-label="breadcrumb">
                           <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="exam.php">Back</a></li>
                              <li class="breadcrumb-item"><a href="index1.php">Home</a></li>
                              <li class="breadcrumb-item"><a href="#">View Result</a></li>
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
   <!-- End Button -->
   <!--? Start Align Area -->
   <div class="whole-wrap">
      <div class="container box_1170">
         <!-- confidence score -->
		 <div class="section-top-border">
            <h1 class="mb-30">Confidence Score</h1>
            <div class="row">
               <div class="col-md-9 mt-sm-20" style=" background-color: #e1f3ed; padding:20px; border-radius:10px;">
                  <?php
                     $label=trim(file_get_contents("confident_score.txt"));

                     if($label=='low'){
                        echo '<b>Low Confidence</b>';
                        echo '<p>You appeared tensed and stressed throughout the interview. Try to stay calm and composed for better impact!</p>';
                     }elseif($label=='medium'){
                        echo '<b>Medium Confidence</b>';
                        echo '<p>You showed some fear and sadness, which may have affected your delivery. Focus on building self-assurance!</p>';
                     }else{
                        echo '<b>High Confidence</b>';
                        echo '<p>Great job! Your expressions were confident and composed, making a strong impression.</p>';
                     }


                  ?>
               </div>
            </div>
         </div>

         <!-- Filler score -->
		 <div class="section-top-border">
            <h1 class="mb-30">Filler words</h1>
            <div class="row">
               <div class="col-md-9 mt-sm-20" style=" background-color: #e1f3ed; padding:20px; border-radius:10px;">
                  <?php
                     $filler=trim(file_get_contents("filler_output.txt"));
                     echo "<pre>$filler</pre>";
                  ?>
               </div>
            </div>
         </div>

         <!-- Answer score -->
		 <div class="section-top-border">
            <h1 class="mb-30">Answer validation Score</h1>
            <div class="row">
               <div class="col-md-9 mt-sm-20" style=" background-color: #e1f3ed; padding:20px; border-radius:10px;">
               <?php
                     //$ans=trim(file_get_contents("answer_output.txt"));
                     $python = `python answer_validation.py`;
                     echo "<pre>$python</pre>";
                  ?>
               </div>
            </div>
         </div>


      </div>
   </div>
   <!-- End Align Area -->
</main>


<?php
include('footer.php');
?>