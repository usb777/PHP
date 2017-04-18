<?php
 session_start();

  include_once $_SERVER['DOCUMENT_ROOT']."/admin/Controller/BooksController.php";
  include_once $_SERVER['DOCUMENT_ROOT']."/admin/Controller/CategoryController.php";
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


 if (isset($_SESSION["reportBookUpdateByAdmin"])) // if iset report value
  {
	  echo $_SESSION["reportBookUpdateByAdmin"];   // output report value from BooksController (Main section)
	 
  	  unset($_SESSION["reportBookUpdateByAdmin"]); // destroy session Variable
	 
  }
	
updateBookForm($_REQUEST["b_id"]);  // Draw updateUser Form

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

function updateBookForm($b_id)
{ 
/*
          $book[$i]["u_id"]=$row["u_id"];
		 $book[$i]["b_name"]=$row["b_name"];
		 $book[$i]["b_description"]=$row["b_description"];
		 $book[$i]["b_year"]=$row["b_year"];
		 $book[$i]["b_url"]=$row["b_url"];
		 $book[$i]["b_filename"]=$row["b_filename"];
		 $book[$i]["b_img1"]=$row["b_img1"];
		 $book[$i]["b_img2"]=$row["b_img2"];
		 $book[$i]["b_img3"]=$row["b_img3"];
		 $book[$i]["cb_id"]=$row["cb_id"];

*/
$bookcontroller = new BooksController();
$booksdata=array();
$booksdata=$bookcontroller->getBookByIdFromModel($b_id)   ;



$t="";
$t.="<center>
<form action='Controller/BooksController.php' method='POST'>";
 $t.="<input type='hidden' name='b_id' value='".$b_id."'>\n";
 $t.="<input type='hidden' name='action' value='".$_REQUEST['action']."'>\n";

$usersFromControllers = new UsersController(); 
$current_category=array();
$current_category = $usersFromControllers->getUserByIdFromModel($booksdata[0]["u_id"]); 

$t.="<label for='u_login'>User Login</label> <br>\n";
$t.="<input type='text' name='u_login' size='25' value='".$current_category[0]["u_login"]."' disabled ><br><br>\n"; 
 
$t.="<label for='b_name'>Book Name</label> <br>\n";
$t.="<input type='text' name='b_name' size='25' value='".$booksdata[0]["b_name"]."' ><br><br>\n";

$t.="<label for='b_year'>Book year</label> <br>\n";
$t.="<input type='text' name='b_year' size='15' value='".$booksdata[0]["b_year"]."' ><br><br>\n";


 if (isset($booksdata[0]["b_img1"])&&($booksdata[0]["b_img1"]!=""))
   {
	   $book_image = "<br><img src='".$booksdata[0]["b_url"]."/images/".$booksdata[0]["b_img1"]."' width='100px' height='100px' ><br><br>";
   }
   else 
    {
		$book_image ="";
	}

$t.=$book_image;
//$t.="<img src='".$booksdata[0]["b_url"]."/images/".$booksdata[0]["b_img1"]."' width='100px' height='100px' ><br>\n";

$t.="<label for='b_description'>Book description</label> <br>\n";
$t.="<textarea rows='15' cols='70' name='b_description'>".$booksdata[0]["b_description"]."</textarea><br><br>";

$t.="<label for='b_url'>Book url</label> <br>\n";
$t.="<input type='text' name='b_url' size='55' value='".$booksdata[0]["b_url"]."' ><br><br>\n";

$t.="<label for='b_filename'>Book filename</label> <br>\n";
$t.="<input type='text' name='b_filename' size='25' value='".$booksdata[0]["b_filename"]."' ><br><br>\n";

$t.="<label for='cb_id'>Choose category </label><br>";


$categoriesFromControllers = new CategoryController(); 
$categories=array();
$categories = $categoriesFromControllers->getAllCategoriesfromModel();

$current_category = $categoriesFromControllers->getCategoryByIdFromModel($booksdata[0]["cb_id"]);

// Array ( [0] => Array ( [cb_id] => 2 [cb_name] => Medicine ) ) 
$t.="<select name='cb_id' width='50'>";
   $t.="<option value='".$current_category[0]['cb_id']."'>".$current_category[0]['cb_name']."</option>" ;
   
   for ($i=0;$i<count($categories);$i++)
   {
	   $t.="<option value='".$categories[$i]['cb_id']."'>".$categories[$i]['cb_name']."</option>" ;
   }
  
$t.="</select> <br><br> ";


$t.="<INPUT TYPE='SUBMIT' name='submBookUpdateByAdmin' value='Submit' >";  //Press this button to submit form 
$t.="</form><br><br> ";



$t.="</center>";

 echo $t; 	
}



?>


