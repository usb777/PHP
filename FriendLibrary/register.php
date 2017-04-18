<?php
include 'db_config.php';
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
	  
	  
	  
	  
	  
	  
	  
	  <?php
  if ( (isset($_REQUEST['login'])&& ($_REQUEST['login']!=''))&&
       (isset($_REQUEST['passw1'])&& ($_REQUEST['passw1']!=''))&&
	   (isset($_REQUEST['passw2'])&& ($_REQUEST['passw2']!=''))  )
  
  { 
   
   
	
	if ($_REQUEST['passw1'] ==$_REQUEST['passw2'])
	{ 
            $logins=array();
	        $logins = array_of_logins();  //Look this function in bottom of page
	       
			$same_login=FALSE;
			
			for ($i=0;$i<count($logins);$i++)
			{
				if($_REQUEST['login']==$logins[$i]) 
				 {$same_login=TRUE; break;}
			     else 
			     {$same_login=FALSE;}
				
			}
			
       
		if ($same_login==TRUE) // We check dublicate login
		{
			echo "<font color='red'>Wrong input: We have user with same login</font> <br>";
	        DrawRegistrationForm(); // We show registration form
		}
		else 
		{ // if we dont have user with this login
		
		
		
			  
         // Create connection
         $conn = new mysqli($servername, $username, $password, $dbname);
         // Check connection
         if ($conn->connect_error) 
           {
                die("Connection failed: " . $conn->connect_error);
           }

             //echo "Hello".$_REQUEST['passw']."<br>" ;

        $sql = "INSERT INTO users 
                 (u_login,u_passw,u_firstname,u_lastname,u_mail, role_id, status_id)
                VALUES 
               ('".$_REQUEST['login']."','".$_REQUEST['passw1']."','".$_REQUEST['first_name']."','".$_REQUEST['last_name']."','".$_REQUEST['mail']."', '2', '1')";
         $result = $conn->query($sql);
		
		$conn->close();
		
		 echo "<h3 align='center'>Congratulation!</h3>";
		 echo "<p align='center'>User <b>".$_REQUEST['login']."</b>  succefully registered! Please Sign In with form in the left <-- Sidebar</p>";
		}
		
	}
   else  // if passw1 is not same password2
    {  
	    
		echo "<font color='red'>Wrong input: <font color='yellow'>password1</font>".
		"is not same <font color='yellow'>password2</font>  .</font> <br>";
	  DrawRegistrationForm(); // We show registration form
	}
    
            	
	
  } 
  else 
    {  // if  Submit- but, didnt fill login and passwords fields  - we will show form

       if ( (isset($_REQUEST['first_name'])&& ($_REQUEST['first_name']!=''))||
            (isset($_REQUEST['last_name'])&& ($_REQUEST['last_name']!=''))||
	        (isset($_REQUEST['mail'])&& ($_REQUEST['mail']!=''))  ) 
			{
				
				if (($_REQUEST['login']=='')) {echo "<font color='red'>You didn't input <font color='yellow'>login</font> field.</font><br>"; }
				if (($_REQUEST['passw1']=='')) {echo "<font color='red'>You didn't input <font color='yellow'>password1</font> field.</font> <br>"; }
				if (($_REQUEST['passw2']=='')) {echo "<font color='red'>You didn't input <font color='yellow'>password2</font> field.</font><br>"; }
				
			} //if
  
   if ( (isset($_REQUEST['login'])&& ($_REQUEST['login']!=''))||
       (isset($_REQUEST['passw1'])&& ($_REQUEST['passw1']!=''))||
	   (isset($_REQUEST['passw2'])&& ($_REQUEST['passw2']!=''))  )
    {echo "<font color='red'>You must fill all important fields.</font><br>"; }
  
   // if not Submit- we will show form
   
   
   
   

     DrawRegistrationForm(); // We show registration form
    } // else
?>

		   

	   </div> <!--//content //-->
    </div>  <!--// site_content //-->
<?php 
 /***************  This code include footer *****************************/
       include 'footer.php';        
?>


<?php

// functions for this page

function DrawRegistrationForm()
{
	?>
	    <h2 align="center"> Registration form  </h2>
		
	       <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		    <label for="login">First Name</label> <br>
			  <input type="text" name="first_name" size="15" ><br><br>
			   <label for="login">Last Name</label><br>
			  <input type="text" name="last_name" size="15"><br><br>
			  <label for="mail">E-Mail</label><br>
			  <input type="text" name="mail" size="15"><br><br>
			  
		    <font color="red">*</font> <label for="login">Login</label> <br>
			  <input type="text" name="login" size="15"><br><br>
			   <font color="red">*</font>  <label for="passw1">Password</label> <br>
			   <input type="password" name="passw1" size="15"><br><br>
			    <font color="red">*</font> <label for="passw2">Repeat Password</label> <br>
			   <input type="password" name="passw2" size="15"><br><br>
			 
			 <button id="bar" type="submit"> <img src="images/go1.png" alt="Mountain View" style="width:40px;height:40px;" ></button> 
			<!--// 
			 <input type="Submit" name="submit" size="15"><br><br>//-->
           </form>
	
	<?php
	
	
}


function array_of_logins()
{
 //include_once 'db_config.php';			  
			  
  // Create connection
  
  $servername = $GLOBALS['servername'];
  $username  = $GLOBALS['username'];
  $password = $GLOBALS['password'];
  $dbname = $GLOBALS['dbname'];
  
  
   $conn = new mysqli($servername, $username, $password, $dbname);
   // Check connection
   if ($conn->connect_error) 
   {
    die("Connection failed: " . $conn->connect_error);
    } 


   $sql = "SELECT u_login FROM `users` order by u_login";
   $result = $conn->query($sql);

  if ($result->num_rows > 0) 
  {
	$logins = array();
    // output data of each row
	$i=0;
    while($row = $result->fetch_assoc()) 
	{ 
      $logins[$i] = $row["u_login"];    
      $i++;
	}
  }   else { }
   $conn->close();
   
   return $logins;
} //end of function array_of_logins


?>


