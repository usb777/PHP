<?php
 session_start();
 include_once $_SERVER['DOCUMENT_ROOT']."/admin/Controller/UsersController.php";
?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>NLibarary Science Work Repositorium</title>
 <script type="text/javascript" src="js/deleteConfirmation.js"></script>
  <script type="text/javascript" src="js/updateConfirmation.js"></script>

  <script>

function info()
{
	alert ("Just Admin can change this.") ;
}

</script>
  </head>
<LINK href="css/styleBackend.css" type=text/css rel=stylesheet />


<body>

<?php 

 if (isset($_COOKIE["cookie_username"])) 
	  {
		    $_SESSION["login"] = $_COOKIE["cookie_username"];
			$_SESSION["u_id"] = $_COOKIE["cookie_userid"];
	  } 


  if (!isset($_SESSION["login"]))
  { echo "You didn't login, please quit from this page!<br>";
     echo "<a href='../index.php'>Login </a>" ;
  
  }
  else //logined
  {
	  if ($_SESSION["login"]=='admin')
	  {
		echo "Admin cannot stay on this page, please quit from this page!<br>";
        echo "<a href='../index.php'>Login </a>" ;  
	  }
	 
  //-->
    else 
	{
  
  ?>
  
<div id="maketo">
<?php
include_once('user_menu.php');
?>
<div id="content">
  <div align="center">Hello, member <b> user</b> aka <?php  echo  "<b>".$_SESSION["login"]."</b> id=".$_SESSION["u_id"] ;?>  </div>
  <br>
  
<?php 

 if (isset($_SESSION["reportUpdateUser"])) // if iset report value
  {
	  echo $_SESSION["reportUpdateUser"];   // output report value from BooksController (Main section)
	 
  	  unset($_SESSION["reportUpdateUser"]); // destroy session Variable
	 
  }

updateUserForm($_SESSION["u_id"]);  // Draw updateUser Form

?>
  
</div>
<div id="rasporka"></div> 
<div id="footer" align="center">Designed for NataliaLibrary @2017</div>
</div>  <!-- Maketo -->
<?php
	
	} //end of else if ($_SESSION["login"]=='admin')
   
  } // end of else if (!isset($_SESSION["login"]))
  
  ?>
</body>
</html>


<?php

function updateUserForm($user_id)
{ 

$userscontroller = new UsersController();

$userdata=array();

$userdata=$userscontroller->getUserByIdFromModel($user_id) ;

$t="";
$t.="<center>
<form action='Controller/UsersController.php' method='POST'>";

 $t.="<label for='first_name'>First Name</label> <br>";
$t.=" <input type='text' name='first_name' size='25' value=".$userdata[0]["u_firstname"]." ><br><br>";
$t.=" <label for='last_name'>Last Name</label><br>";
$t.="<input type='text' name='last_name' size='25' value=".$userdata[0]["u_lastname"]."><br><br>";
$t.=" <label for='mail'>E-Mail</label><br>";
$t.=" <input type='text' name='mail' size='25' value=".$userdata[0]["u_mail"]."><br><br>";
			  
$t.=" <label for='login'>Login</label> <br>";
$t.=" <input type='text' name='login' size='15' value=".$userdata[0]["u_login"]."><br><br>";
 $t.="<label for='passw1'>Password</label> <br>";
$t.=" <input type='password' name='passw1' size='25' value=".$userdata[0]["u_passw"]."><br><br>";

$t.=" <label for='role'>Role <font color='red'>*</font></label> <br>";
$t.=" <input type='text' name='role' size='15' value=".$userdata[0]["role_name"]." disabled ><br><br>";

$t.=" <label for='status' >Status <font color='red'>*</font></label> <br>";
$t.=" <input type='text' name='status' size='15' value=".$userdata[0]["status_name"]."  disabled  ><br><br>";


$t.="<INPUT TYPE='SUBMIT' name='submUserInfo' value='Submit' >";  //Press this button to submit form 
$t.="</form><br><br> ";
$t.="<font color='red'>* Just Admin can change this field</font>";


$t.="</center>";

 echo $t; 
	
}



?>


