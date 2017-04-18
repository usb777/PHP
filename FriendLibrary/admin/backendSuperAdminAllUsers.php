<?php
 session_start();
 include_once $_SERVER['DOCUMENT_ROOT']."/admin/Controller/UsersController.php";
 
?>
<!DOCTYPE html>
<head>
<meta charset="UTF-8">
<title>NLibary Science Work Repositorium</title>
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
	 
  //-->
     if ($_SESSION["login"]!='admin')
	  {
		echo "User cannot stay on this page, please quit from this page!<br>";
        echo "<a href='../index.php'>Login </a>" ;  
	  }
	 
  //-->
    else {
  
  ?>
  



<div id="maketo">
<?php
include_once('admin_menu.php');
?>
<div id="content1">

  <div align="center"> Hello, Super<?php  echo  "<b>".$_SESSION["login"]."</b>" ;?> </div>
  <br>
 

<a href="backendSAInsertUser.php"><img src="images/add.gif" Style="float:left;"> Add New User </a> <br> <br>
 
<?php

tableformAllUsers();



?>

 
  
  
</div>
<div id="rasporka"></div> 
<div id="footer" align="center">Designed for GRSU @2016</div>
</div>  <!-- Maketo -->

<?php
  
   } //end of else if ($_SESSION["login"]!='admin')
   
  } // end of else if (!isset($_SESSION["login"]))
  
  ?>
  
</body>
</html>




<?php

function tableformAllUsers()
{ 


/*
            [u_id] => 8
            [u_login] => user2
            [u_passw] => user2
            [u_firstname] => USER2
            [u_lastname] => USER2
            [u_mail] => user2@gmail.com
            [u_facebookid] => 
            [role_name] => author/uploader
            [status_name] => enabled
*/
 echo "<table class='simple' >";
 echo "<th width='3%'><a href='#'>id</a></th>";
  echo "<th width='10%'><a href='#'>login</a></th>";
 echo "<th width='10%'><a href='#'>password</a></th>";
 echo "<th width='10%'><a href='#'>First name</a></th>";
 echo "<th width='10%'><a href='#'>Last name</a> </th>";
 echo "<th width='15%'><a href='#'>E-mail</a></th>";
 echo "<th width='10%'><a href='#'>Facebok id</a></th>";
 echo "<th width='13%'><a href='#'>Role</a></th>";
 echo "<th width='7%'><a href='#'>Status</a></th>";
  
 echo "<th colspan='3'><a href='#'>Action</a></th>";

$userscontroller = new UsersController(); 
$users=array();
$users = $userscontroller->getAllUsersDataFromModel() ;

//print_r($books);

 for ($i=0; $i<count($users); $i++)
 { echo "<tr>" ;
    echo "<td width='3%' class='bg'>".$users[$i]["u_id"]."</td>";
    echo "<td width='10%' class='bg'>".$users[$i]["u_login"]."</td>";
    echo "<td width='10%' class='bg'>".$users[$i]["u_passw"]."</td>";
    echo "<td width='10%' class='bg'>".$users[$i]["u_firstname"]."</td>";
    echo "<td width='10%' class='bg'>".$users[$i]["u_lastname"]."</td>";
    echo "<td width='10%' class='bg'>".$users[$i]["u_mail"]."</td>";
    echo "<td width='10%' class='bg'>".$users[$i]["u_facebookid"]."</td>";
    echo "<td width='13%' class='bg'><b>".$users[$i]["role_name"]."</b></td>";
	echo "<td width='7%' class='bg'><b>".$users[$i]["status_name"]."</b></td>";  
     echo "<td class='bg'><a href='#' onclick='getUpdateUsersConfirmationSA(".$users[$i]["u_id"].")' ><center> 
	       <img src='images/update.gif' alt='обновить' width='20px' height='20px' ></center></a></td>";
	 
	 echo "<td class='bg'><a href='#' onclick='getdeleteUsersConfirmationSA(".$users[$i]["u_id"].")'><center> 
	       <img src='images/delete.gif' alt='удалить' width='20px' height='20px'></center></a> </td>";
	 
	echo "</tr>" ; 
 } // for


	echo "</table>";
	
}



?>

