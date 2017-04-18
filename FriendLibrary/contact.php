<?php
 include_once $_SERVER['DOCUMENT_ROOT']."/admin/Controller/BooksController.php";
 ?>
<!DOCTYPE HTML>
<html>

<head>
  <title>Nataliya Library</title>
  <meta name="description" content="website description" />
  <meta name="keywords" content="website keywords, website keywords" />
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
  <link rel="stylesheet" type="text/css" href="css/style.css" />
  <!-- modernizr enables HTML5 elements and feature detects -->
   
  <script type="text/javascript" src="js/modernizr-1.5.min.js"></script>
   <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
   <script type="text/javascript" src="js/showmore.js"></script>  
   
   <!--//this code needed for Ajax Search //-->
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    	
    $( "#search" ).autocomplete({
      maxLength: 5,
      source: 'searchAJAX.php'
        });
   
});
  </script>
</head>

<body>
  <div id="main">
   
   
   
 <?php 
 /***************  This code include header *****************************/
       include 'header.php';        
   ?>
   
   
   
   
   
   
    <div id="site_content">
    
	
	 <?php 
 /***************  This code include sidebar *****************************/
       include 'sidebar.php';        
   ?>	
	
	
	
	
	
	
      <div class="content">
	   <br>
	  
        <h1>Contact Us</h1>
        <p>Say hello, using this contact form.</p>
     	  
        <?php
          // Set-up these 3 parameters
          // 1. Enter the email address you would like the enquiry sent to
          // 2. Enter the subject of the email you will receive, when someone contacts you
          // 3. Enter the text that you would like the user to see once they submit the contact form
          $to = 'enter email address here';
          $subject = 'Enquiry from the website';
          $contact_submitted = 'Your message has been sent.';

          // Do not amend anything below here, unless you know PHP
          function email_is_valid($email) 
		  {
            return preg_match('/^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i',$email);
          }
          if (!email_is_valid($to)) 
		  {
           // echo '<p style="color: red;">You must set-up a valid (to) email address before this contact page will work.</p>';
          }
          if (isset($_POST['contact_submitted'])) 
		  {
            $return = "\r";
            $youremail = trim(htmlspecialchars($_POST['your_email']));
            $yourname = stripslashes(strip_tags($_POST['your_name']));
            $yourmessage = stripslashes(strip_tags($_POST['your_message']));
            $contact_name = "Name: ".$yourname;
            $message_text = "Message: ".$yourmessage;
            $user_answer = trim(htmlspecialchars($_POST['user_answer']));
            $answer = trim(htmlspecialchars($_POST['answer']));
            $message = $contact_name . $return . $message_text;
            $headers = "From: ".$youremail;
            if (email_is_valid($youremail) && $yourname != "" && $yourmessage != "" && substr(md5($user_answer),5,10) === $answer) 
			{
              @mail($to,$subject,$message,$headers);
              $yourname = '';
              $youremail = '';
              $yourmessage = '';
              echo '<p style="color: #4CA2D4;">'.$contact_submitted.'</p>';
            }
          }
         
   else{  
		 $number_1 = rand(1, 9);
          $number_2 = rand(1, 9);
          $answer = substr(md5($number_1+$number_2),5,10);
        ?>
        <form id="contact" action="contact.php" method="post">
          <div class="form_settings">
            <p><span>Name</span><input class="contact" type="text" name="your_name" value="" /></p>
            <p><span>Email Address</span><input class="contact" type="text" name="your_email" value="" /></p>
            <p><span>Message</span><textarea class="contact textarea" rows="5" cols="50" name="your_message"></textarea></p>
            <p style="line-height: 1.7em;">To help prevent spam, please enter the answer to this question:</p>
            <p><span><font color="red" size="+2"><?php echo $number_1; ?> + <?php echo $number_2; ?> = ?</span><input type="text" name="user_answer" /><input type="hidden" name="answer" value="<?php echo $answer; ?>" /></p>
            <p style="padding-top: 15px"><span>&nbsp;</font></span><input class="submit" type="submit" name="contact_submitted" value="send" /></p>
          </div>
        </form>
      </div>
    </div>
	<?php
	
	// end else 
   }
     for ($i=0;$i<30;$i++)
	 {
		 echo "<br/>";
	 }
	
	
	?>
	
	
	
	
<?php
    
 /***************  This code include footer *****************************/
       include 'footer.php';        
?>