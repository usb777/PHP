<?php
 session_start();
 include_once $_SERVER['DOCUMENT_ROOT']."/admin/Controller/CategoryController.php";
 
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

<a href="backendSAUpdateInsertCategory.php?action=insertCategory"><img src="images/add.gif" Style="float:left;"> Add New Category </a> <br> <br>
  
<?php

 if (isset($_SESSION["reportUpdateCategory"])) // if iset report value
  {
	  echo $_SESSION["reportUpdateCategory"];   // output report value from BooksController (Main section)
	 
  	  unset($_SESSION["reportUpdateCategory"]); // destroy session Variable
	 
  }
tableformAllCategories();



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

function tableformAllCategories()
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
 echo "<table class='smalltable' >";
 echo "<th width='5%'><a href='#'>id</a></th>";
  echo "<th width='30%'><a href='#'>Category name</a></th>";
  
 echo "<th colspan='3'><a href='#'>Action</a></th>";

$categoriescontroller = new CategoryController(); 
$categories = array();
$categories = $categoriescontroller->getAllCategoriesfromModel() ;

//print_r($books);

 for ($i=0; $i<count($categories); $i++)
 { echo "<tr>" ;
    echo "<td width='5%' class='bg'>".$categories[$i]["cb_id"]."</td>";
    echo "<td width='30%' class='bg'>".$categories[$i]["cb_name"]."</td>";
     
     echo "<td class='bg'><a href='#' onClick='getUpdateCategoriesConfirmation(".$categories[$i]["cb_id"]." );' ><center> 
	       <img src='images/update.gif' alt='обновить' width='20px' height='20px'></center></a></td>";
	 
	 echo "<td class='bg'><a href='#' onClick='getDeleteCategoriesConfirmation(".$categories[$i]["cb_id"].");'><center> 
	       <img src='images/delete.gif' alt='удалить' width='20px' height='20px'></center></a> </td>";
	 
	echo "</tr>" ; 
 } // for


	echo "</table>";
	
}



?>

