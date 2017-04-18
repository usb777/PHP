<?php
 session_start();

  include_once $_SERVER['DOCUMENT_ROOT']."/admin/Controller/CategoryController.php";
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

  
if  ($_REQUEST["action"]=="updateCategory")
{	
updateCategoryForm($_REQUEST["category_id"]);  // Draw updateUser Form
}
else if ($_REQUEST["action"]=="insertCategory")
{
	insertCategoryForm();
}


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

function updateCategoryForm($category_id)
{ 

$categorycontroller = new CategoryController();
$categoriesdata=array();
$categoriesdata=$categorycontroller->getCategoryByIdFromModel($category_id)   ;

$t="";
$t.="<center>
<form action='Controller/CategoryController.php' method='POST'>";
 $t.="<input type='hidden' name='category_id' value='".$categoriesdata[0]["cb_id"]."' >\n";
 $t.="<input type='hidden' name='action' value='".$_REQUEST['action']."' >\n";
 $t.="<label for='category_name'>Category Name</label> <br>\n";
$t.=" <input type='text' name='category_name' size='25' value='".$categoriesdata[0]["cb_name"]."' ><br><br>\n";

$t.="<INPUT TYPE='SUBMIT' name='submCategoryUpdate' value='Submit' >";  //Press this button to submit form 
$t.="</form><br><br> ";



$t.="</center>";

 echo $t; 
	
}

function insertCategoryForm()
{ 


$t="";
$t.="<center>
<form action='Controller/CategoryController.php' method='POST'>";
 $t.="<input type='hidden' name='action' value=".$_REQUEST['action'].">\n";
 $t.="<label for='category_name'>Category Name</label> <br>\n";
 $t.=" <input type='text' name='category_name' size='25' ><br><br>\n";

$t.="<INPUT TYPE='SUBMIT' name='submCategoryInsert' value='Submit' >";  //Press this button to submit form 
$t.="</form><br><br> ";



$t.="</center>";

 echo $t; 
	
}



?>


