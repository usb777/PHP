<?php
 session_start();

  include_once $_SERVER['DOCUMENT_ROOT']."/admin/Controller/BooksController.php";
  include_once $_SERVER['DOCUMENT_ROOT']."/admin/Controller/CategoryController.php";
  
?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>NLibarary Science Work Repositorium</title>
 <script type="text/javascript" src="js/deleteConfirmation.js"></script>
  <script type="text/javascript" src="js/updateConfirmation.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  </head>
<LINK href="css/styleBackend.css" type=text/css rel=stylesheet />


<script>
$(document).ready(function() {
        $("#imageUpload").on('change', function() {
          //Get count of selected files
          var countFiles = $(this)[0].files.length;
          var imgPath = $(this)[0].value;
          var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
          var image_holder = $("#image-holder");
          image_holder.empty();
          if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
            if (typeof(FileReader) != "undefined") {
              //loop for each file selected for uploaded.
              for (var i = 0; i < countFiles; i++) 
              {
                var reader = new FileReader();
                reader.onload = function(e) {
                  $("<img />", {
                    "src": e.target.result,
                    "class": "thumb-image"
                  }).appendTo(image_holder);
                }
                image_holder.show();
                reader.readAsDataURL($(this)[0].files[i]);
				
              }
            } else {
              alert("This browser does not support FileReader.");
            }
          } else {
            alert("Pls select only images");
          }
        });
      });
</script>  


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


 if (isset($_SESSION["reportBookUpdateByUser"])) // if iset report value
  {
	  echo $_SESSION["reportBookUpdateByUser"];   // output report value from BooksController (Main section)
	 
  	  unset($_SESSION["reportBookUpdateByUser"]); // destroy session Variable
	 
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
 
$t.="<label for='b_name'>Book Name</label> <br>\n";
$t.="<input type='text' name='b_name' size='25' value='".$booksdata[0]["b_name"]."' ><br><br>\n";

$t.="<label for='b_year'>Book year</label> <br>\n";

$t.="<label>Choose Image </label><br>";
$t.="<div id='wrapper' style='margin-top: 20px;'><input id='imageUpload' multiple='multiple' type='file' name='img1File'  /> ";
$t.="<div id='image-holder'>";

 if (isset($booksdata[0]["b_img1"])&&($booksdata[0]["b_img1"]!=""))
   {
	   $book_image = "<br><img src='".$booksdata[0]["b_url"]."/images/".$booksdata[0]["b_img1"]."' width='100px' height='100px' >";
   }
   else 
    {
		$book_image ="";
	}

$t.=$book_image;

$t.="</div></div><br><br>";

$t.="<input type='text' name='b_year' size='15' value='".$booksdata[0]["b_year"]."' ><br><br>\n";
$t.="<label for='b_description'>Book description</label> <br>\n";
$t.="<textarea rows='15' cols='70' name='b_description'>".$booksdata[0]["b_description"]."</textarea><br><br>";

$t.="<label for='b_url'>Book url</label> <br>\n";
$t.="<input type='text' name='b_url' size='55' value='".$booksdata[0]["b_url"]."' ><br><br>\n";

$t.="<label for='b_filename'>Book filename</label> <br>\n";
$t.="<input type='text' name='b_filename' size='25' value='".$booksdata[0]["b_filename"]."' disabled ><br><br>\n";

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


$t.="<INPUT TYPE='SUBMIT' name='submBookUpdateByUser' value='Submit' >";  //Press this button to submit form 
$t.="</form><br><br> ";



$t.="</center>";

 echo $t; 	
}



?>


