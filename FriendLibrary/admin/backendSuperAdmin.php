<?php
 session_start();
 include_once $_SERVER['DOCUMENT_ROOT']."/admin/Controller/BooksController.php";
  include_once $_SERVER['DOCUMENT_ROOT']."/admin/Model/BooksModel.php";
 
?>
<!DOCTYPE html>
<head>
<meta charset="UTF-8">
<title>NLibary Science Work Repositorium</title>
 <script type="text/javascript" src="js/deleteConfirmation.js"></script>
  <script type="text/javascript" src="js/updateConfirmation.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
   <script type="text/javascript" src="js/showmore.js"></script>
   
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
  
<?php


tableform(6);
?>

 
  
  
</div>
<div id="rasporka"></div> 
<div id="footer" align="center">Designed for NLibrary @2017</div>
</div>  <!-- Maketo -->

<?php
  
   } //end of else if ($_SESSION["login"]!='admin')
   
  } // end of else if (!isset($_SESSION["login"]))
  
  ?>
  
</body>
</html>




<?php

function tableform($user_id)
{ 


 echo "<table class='simple' >";
 echo "<th width='5%'>Book ID</th>";
 echo "<th width='15%'><a href='#'>Name of Book</a> </th>"; 
 echo "<th width='15%'><a href='#'>Category</a></th>";
 echo "<th width='15%'><a href='#'>View</a></th>";

 echo "<th width='35%'><a href='#'>Description</a></th>";
 echo "<th width='10%'><a href='#'>Year</a></th>";
 echo "<th width='10%'><a href='#'>login</a></th>";
 echo "<th colspan='3'><a href='#'>Action</a></th>";

$bookcontroller = new BooksController(); 
$books=array();
$books = $bookcontroller->getFullBookListfromModel() ;

 


 for ($i=0; $i<count($books); $i++)
 { 
   if (isset($books[$i]["b_img1"])&&($books[$i]["b_img1"]!=""))
   {
	   $book_image = $books[$i]["b_url"]."images/".$books[$i]["b_img1"];
   }
   else 
    {
		$book_image ="/images/defaultbook.gif";
	}


     echo "<tr>" ;
     echo "<td width='5%' class='bgadmin'>".$books[$i]["b_id"]."</td>";
     echo "<td width='15%' class='bgadmin'>"."<a href='..".$books[$i]["b_url"].$books[$i]["b_filename"]."' download  >".$books[$i]["b_name"]."</a></td>";	
	 echo "<td width='15%' class='bgadmin'>".$books[$i]["cb_name"]."</td>";
     echo "<td width='15%' class='bgadmin'><center><img src='../".$book_image."' width='20px' height='20px'></center></td>";
     echo "<td width='35%' class='bgadmin'>".addShowMoreForDescription($books[$i]["b_description"])."</td>";
	  echo "<td width='35%' class='bgadmin'>".$books[$i]["b_year"]."</td>";
	  echo "<td width='10%' class='bgadmin'>".$books[$i]["u_login"]."</td>";
     echo "<td class='bg'><a href='#' onclick='getUpdateConfirmationUserBookSA(".$books[$i]["b_id"].");' ><center> 
	       <img src='images/update.gif' alt='обновить' width='20px' height='20px'></center></a></td>";
	 
	 echo "<td class='bg'><a href='#' onclick='getdeleteBookConfirmationSA(".$books[$i]["b_id"].");'><center> 
	       <img src='images/delete.gif' alt='удалить' width='20px' height='20px'></center></a> </td>";
	 
	echo "</tr>" ; 
 } // for

/*

    (
            [b_id] => 1
            [u_id] => 8
            [b_url] => 
            [b_description] => The most interesting Books!!!
            [b_year] => 2017
            [b_name] => Wondered Book
            [b_filename] => superBook.docx
            [b_img1] => 
            [b_img2] => 
            [b_img3] => 
            [cb_id] => 2
        )
*/
	echo "</table>";
	
}

/*This function add DIV tag and style to TEXT over 100 symbols */
function addShowMoreForDescription($str)
{
	if (strlen($str)>=100 )
	{  $str = "<div class='more'>".$str."</div>"  ;

          return $str;
     }
   else 
	   return $str;	
	
}

?>

