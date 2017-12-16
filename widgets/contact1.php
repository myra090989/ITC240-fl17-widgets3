<?php include 'includes/header.php'?>
 
<?php
if(isset($_POST["FirstName"])){//show data
    
        /*
        $FirstName = $_POST["FirstName"];
        $LastName = $_POST["LastName"];
        $Email = $_POST["Email"];
        $Comments = $_POST["Comments"];
        */
    
 /*
    if(isset($_POST['FirstName'])){$FirstName = strip_tags(trim($_POST['FirstName']));}else{$FirstName="";}
    */
    
   //clean and process the post data 
    $FirstName = clean_post('FirstName'); 
    $LastName = clean_post('LastName');
    $Email = clean_post('Email');
    $Comments = clean_post('Comments');
    
 $to      = 'myra.sarmiento@seattlecentral.edu';
    
$subject = 'ITC240 Contact Form';
$myText = "The user has entered the following information:" . PHP_EOL . PHP_EOL; //double newlines 
$myText .= $FirstName . " " . $LastName . PHP_EOL;
$myText .= $Comments . PHP_EOL;
    
$headers = 'From: noreply@maisarmiento.xyz' . PHP_EOL .
    'Reply-To: ' .$Email . PHP_EOL .
    'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $myText, $headers);
    
    #EDIT THE FOLLOWING:
$toAddress = "myra.sarmiento@seattlecentral.edu";  //place your/your client's email address here
$toName = "Myra"; //place your client's name here
$website = "WEB 120 Contact Form";  //place NAME of your client's website here
#--------------END CONFIG AREA ------------------------#
$sendEmail = TRUE; //if true, will send an email, otherwise just show user data.
$dateFeedback = true; //if true will show date/time with reCAPTCHA error - style a div with class of dateFeedback
include_once 'config.php'; #site keys go inside your config.php file
include 'contact-lib/contact_include.php'; #complex unsightly code moved here
$response = null;
$reCaptcha = new ReCaptcha($secretKey);
if (isset($_POST["g-recaptcha-response"]))
{// if submitted check response
    $response = $reCaptcha->verifyResponse(
        $_SERVER["REMOTE_ADDR"],
        $_POST["g-recaptcha-response"]
    );
}
if ($response != null && $response->success)
    {#reCAPTCHA agrees data is valid (PROCESS FORM & SEND EMAIL)
        handle_POST($skipFields,$sendEmail,$toName,$fromAddress,$toAddress,$website,$fromDomain);             #Here we can enter the data sent into a database in a later version of this file
    
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
    echo'
        <hr class="divider">
        <h2 class="text-center text-lg text-uppercase my-0">Contact
        <strong>Form</strong>
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
          
          </div>
         <div class="form-group col-lg-4">
         <label class="text-heading">How did you hear about us?</label>
         <input type="radio" name="Internet" value="Internet"/> Internet <br/>
         <input type="radio" name="Internet" value="TV"/> TV <br/>
         <input type="radio" name="Internet" value="Magazine"/> Magazine<br/>
          </div>
          
          <div class="form-group col-lg-4">
         <label class="text-heading">Special Request?</label>
         <input type="checkbox" name="Special_Request[]" value="Dynamic Background"/> Dynamic<br/>
         <input type="checkbox" name="Special_Request[]" value="SEO"/> SEO <br/>
         <input type="checkbox" name="Special_Request[]" value="SMO"/> SMO<br/>
          </div>    
        

          <div class="clearfix"></div>
          <div class="form-group col-lg-12">
          <label class="text-heading">Comments</label>
          <textarea name="Comments" class="form-control" rows="6"></textarea>
          </div>
          <div class="form-group col-lg-12">
          <button type="submit" class="btn btn-secondary">Submit</button>
          </div>
    <div class="g-recaptcha" data-sitekey="<?=$siteKey;?>"></div> 
	<div>
<input type="submit" value="send now" />
	</div>
           </div>
           </form>
';
    
}

?>
<?php 

include 'includes/footer.php';

function clean_post($key)
{
    
  if(isset($_POST[$key])){
      $value = strip_tags(trim($_POST[$key]));
  }else{
      $value="";
  }
    return $value;  
}

?> 