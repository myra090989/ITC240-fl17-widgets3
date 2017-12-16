<?php include 'includes/config.php'?>

<?php get_header()?>

<?php
    
//put client's email address here:    
$to = 'myra.sarmiento@seattlecentral.edu';  
    

  if(isset($_POST["FirstName"])){//show data
      
   //clean and process the post data 
    $FirstName = clean_post('FirstName'); 
    $LastName = clean_post('LastName');
    $Email = clean_post('Email');
    $Comments = clean_post('Comments');
    
$subject = "Ceramics Appointment Request From " . $FirstName . " " . $LastName . " " . date('l jS \of F Y h:i:s A');

/*      
$myText = "The user has entered the following information:" . PHP_EOL . PHP_EOL; //double newlines 
$myText .= $FirstName . " " . $LastName . PHP_EOL;
$myText .= $Comments . PHP_EOL;
 */
$myText = process_post();
      
$headers = 'From: noreply@maisarmiento.xyz' . PHP_EOL .
    'Reply-To: ' .$Email . PHP_EOL .
    'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $myText, $headers);
    
echo '
    <hr class="divider">
    <h2 class="text-center text-lg text-uppercase my-0">
    <strong>Message Sent</strong>
    </h2>
    <hr class="divider">
<p>Thank you for your information!</p>
<p>We will get back to you within 48 hours</p>
<p><a href="">Exit</a></p>
';
    
      //echo $FirstName;
    /*
    echo "
    <p>The user;s name is $FirstName $LastName.</p>
    <p>$FirstName's email is $Email.</p>
    <p>$Comments</p> 
<p>Here;s what $FirstName had to say:</p>
";
    */  
}else{//show form 
/*


Mosaic 
Beading
Private Lesson


      
      
      
*/     
echo '
        <hr class="divider">
        <h2 class="text-center text-lg text-uppercase my-0">
        <strong>Book Ceramics Appointment</strong>
        </h2>
        <hr class="divider">
        <form action="" method="post">
         <div class="row">
         <div class="form-group col-lg-4">
         <label class="text-heading">First Name</label>
         <input type="text" name="FirstName" class="form-control">
         </div>
         <div class="form-group col-lg-4">
         <label class="text-heading">Last Name</label>
         <input type="text" name="LastName" class="form-control">
         </div>
         <div class="form-group col-lg-4">
         <label class="text-heading">Email Address</label>
         <input type="email" name="Email" class="form-control">
          </div>

          <div class="clearfix"></div>
          
          <div class="form-group col-lg-4">
          <label class="text-heading">Appointment Type</label>
          <p>
          <input type="radio" name="Appointment_Type" value="Beginning hand building" /> Beginning hand building<br />
          <input type="radio" name="Appointment_Type" value="Building" /> Building<br />
          <input type="radio" name="Appointment_Type" value="Advanced Wheel Throwing" /> Advanced Wheel Throwing<br />
        </p>
       </div>
          
           <div class="form-group col-lg-4">
          <label class="text-heading">Appointment Type</label>
          <p>
          <input type="checkbox" name="Extras[]" value="Mosaic" /> Mosaic<br />
          <input type="checkbox" name="Extras[]" value="Beading" /> Beading<br />
          <input type="checkbox" name="Extras[]" value="Private Lesson" /> Private Lesson<br />
        </p>
       </div>
          
           <div class="form-group col-lg-4">
         <label class="text-heading">Appointment Date</label>
         <input type="text" name="Appointment Date" class="form-control">
         </div> 
          
          <div class="form-group col-lg-12">
          <label class="text-heading">Comments</label>
          <textarea name="Comments" class="form-control" rows="6"></textarea>
          </div>
          <div class="form-group col-lg-12">
          <button type="submit" class="btn btn-secondary">Submit</button>
          </div>
           </div>
           </form>
';
    
}

?>
<?php 

get_footer();

function clean_post($key)
{
    
  if(isset($_POST[$key])){
      $value = strip_tags(trim($_POST[$key]));
  }else{
      $value="";
  }
    return $value;  
}





function process_post()
{//loop through POST vars and return a single string
    $myReturn = ''; //set to initial empty value

    foreach($_POST as $varName=> $value)
    {#loop POST vars to create JS array on the current page - include email
         $strippedVarName = str_replace("_"," ",$varName);#remove underscores
        if(is_array($_POST[$varName]))
         {#checkboxes are arrays, and we need to collapse the array to comma separated string!
             $myReturn .= $strippedVarName . ": " . implode(", ",$_POST[$varName]) . PHP_EOL . PHP_EOL;
         }else{//not an array, create line
             $myReturn .= $strippedVarName . ": " . $value . PHP_EOL. PHP_EOL;
         }
    }
    return $myReturn;
}