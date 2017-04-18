<?php
 session_start();
 include_once $_SERVER['DOCUMENT_ROOT']."/admin/Controller/UsersController.php";
 include_once $_SERVER['DOCUMENT_ROOT']."/admin/Controller/StatusController.php";
  include_once $_SERVER['DOCUMENT_ROOT']."/admin/Controller/RoleController.php";
?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>NLibarary Science Work Repositorium</title>
 <script type="text/javascript" src="js/deleteConfirmation.js"></script>
 <script type="text/javascript" src="js/updateConfirmation.js"></script>
  </head>
<LINK href="css/styleBackend.css" type=text/css rel=stylesheet />


<body>

<?php 
  if (!isset($_SESSION["login"]))
  { echo "You didn't login, please quit from this page!<br>";
     echo "<a href='../index.php'>Login </a>" ;
  
  }
  else //logined
  {
	  if ($_SESSION["login"]!='admin')
	  {
		echo "user cannot stay on this page, please quit from this page!<br>";
        echo "<a href='../index.php'>Login </a>" ;  
	  }
	 
  //-->
    else 
	{
  
  ?>
  
<div id="maketo">
<?php
include_once('admin_menu.php');
?>
<div id="content">
  <div align="center">Hello, member Super<b>admin</b>   </div>
  <br>
  
<?php 

 
insertUserForm();  // Draw updateUser Form

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

function insertUserForm()
{ 


$statuscontroller = new StatusController();
$statusdata=array();
$statusdata=$statuscontroller->getAllStatusfromModel()   ;


$rolescontroller = new RoleController();
$rolesdata=array();
$rolesdata=$rolescontroller->getAllRolesFromModel()   ;

$t="";
$t.="<center>
<form action='Controller/UsersController.php' method='POST'>";
  $t.="<input type='hidden' name='action' value=insertUser >";
 $t.="<label for='first_name'>First Name</label> <br>";
$t.=" <input type='text' name='first_name' size='25' ><br><br>";
$t.=" <label for='last_name'>Last Name</label><br>";
$t.="<input type='text' name='last_name' size='25'><br><br>";
$t.=" <label for='mail'>E-Mail</label><br>";
$t.=" <input type='text' name='mail' size='25'><br><br>";
			  
$t.=" <label for='login'>Login</label> <br>";
$t.=" <input type='text' name='login' size='15' ><br><br>";
 $t.="<label for='passw1'>Password</label> <br>";
$t.=" <input type='password' name='passw1' size='25' ><br><br>";

$t.=" <label for='role'>Role</label> <br>";
$t.="<select name='role_id' width='50'>";  
    $t.="<option value='2'>author/uploader</option>";	
   for ($i=0;$i<count($rolesdata);$i++)
   $t.="<option value='".$rolesdata[$i]['role_id']."'>".$rolesdata[$i]['role_name']."</option>\n" ;

   $t.="</select><br><br>";

$t.=" <label for='status' >Status</label> <br>";
$t.="<select name='status_id' width='50'>\n";  
    	
   for ($i=0;$i<count($statusdata);$i++)
   $t.="<option value='".$statusdata[$i]['status_id']."'>".$statusdata[$i]['status_name']."</option>\n" ;

   $t.="</select><br><br>";


$t.="<INPUT TYPE='SUBMIT' name='submUserInsertByAdmin' value='Add New User' >";  //Press this button to submit form 
$t.="</form><br><br> ";



$t.="</center>";

 echo $t; 
	
}



?>


