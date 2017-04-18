<?php
 session_start();
 
  include_once $_SERVER['DOCUMENT_ROOT']."/admin/Controller/CategoryController.php";
 
?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>NLibarary Science Work Repositorium</title>
<style type="text/css"></style>
</head>
<LINK href="css/styleBackend.css" type=text/css rel=stylesheet />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

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
  <div align="center">Hello, member <b> user</b> aka <?php  echo  "<b>".$_SESSION["login"]."</b>" ;?>  </div>
  <br>
  <center>
 <?php
  if (isset($_SESSION["reportUpload"])) // if iset report value
  {
	  echo $_SESSION["reportUpload"];   // output report value from BooksController (Main section)
	  
	  unset($_SESSION["reportUpload"]); // destroy session Variable
  }
 
 
uploadform();    // output Upload form method

?> 
  </center>
  
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

/*
Bellow function Draw Upload form
*/
function uploadform()
{ 
//UploadController.php
?>
<form action="Controller/BooksController.php" method="post" enctype="multipart/form-data" onsubmit="" acceptcharset="UTF-8">
<label>Name of the book </label><br>
<input type="text" name="b_name"><br>
<label>Year of publication </label><br>
<input type="text" name="b_year"><br><br>
<label>Choose Image </label><br>
<div id="wrapper" style="margin-top: 20px;"><input id="imageUpload" multiple="multiple" type="file" name="img1File" /> 
<div id="image-holder"></div>
</div><br><br>

<label>Choose category </label><br>

<?php
$categoriesFromControllers = new CategoryController(); 
$categories=array();
$categories = $categoriesFromControllers->getAllCategoriesfromModel();
?>



<select name="category" width="50">
<?php
   for ($i=0;$i<count($categories);$i++)
   echo "<option value='".$categories[$i]['cb_id']."'>".$categories[$i]['cb_name']."</option>" ;

?>  
</select> <br><br>

<label>Description: </label><br>
<textarea rows="15" cols="70" name="b_description">Description:</textarea><br><br>

<font color="red"><b>Choose file for Upload:</b></font> <br />
<input type="file" name="bookfile" size="50"  accept="application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/pdf,text/plain" />
<br /><br/>
<input type="submit" value="Upload book" name="submUploader" value="submited" />
</form>
</center>



<?php	
}
/*
End function Draw Upload form
*/


?>


