<?php

session_start();

include 'db_config.php';
			  
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) 
{
    die("Connection failed: " . $conn->connect_error);
}

//echo "Hello".$_REQUEST['passw']."<br>" ;

$sql = "SELECT u_id, u_login, u_passw FROM users";
$result = $conn->query($sql);

if ($result->num_rows > 0) 
{
    // output data of each row
	$flag = FALSE;
	
    while($row = $result->fetch_assoc()) 
	{
        //echo "id: " . $row["u_id"]. "  Login: " . $row["u_login"]. " Password: " . $row["u_passw"]. "<br>";
		if     (($_REQUEST['login']==$row["u_login"])&& ($_REQUEST['passw']==$row["u_passw"]) )
		{ 
	      
		  if     ($_REQUEST['login']=='admin' )    // if admin are logging
	      { 
	        
		    $flag = TRUE;
            
            $_SESSION["login"] = $_REQUEST['login'];			
			
		    header( 'Location: '.$GLOBAL_HOST.'/admin/backendSuperAdmin.php' ) ;
		    break;
			
		  }
		   else                                    // if user are logging
		   {  $flag = TRUE; 
	          
               $_SESSION["login"] = $_REQUEST['login'];
			   $_SESSION["u_id"] = $row["u_id"];
			     setcookie("cookie_username", $_SESSION["login"],time()+ 3500) ; // We install cookie if logined
	             setcookie("cookie_userid", $_SESSION["u_id"],time()+ 3500) ; // We install cookie if logined
	           
			   header( 'Location: '.$GLOBAL_HOST.'/admin/backend.php' ) ;
		       break;
		   }
		  
		  
		  
		}
	   else 
	   { 
		   $flag=FALSE; 
		   // We cant write breal here cause this program never login
		}
		
    } //while
} //if 
else 
{
    echo "0 results";
} //else 
$conn->close();   /*close conection with database    */

 if ($flag==TRUE) 
  { }

  else 
   {  header( 'Location: '.$GLOBAL_HOST.'/page404.php?error_code=We dont know this user' ) ; }



?>