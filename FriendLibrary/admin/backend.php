<?php
 session_start();
 include_once $_SERVER['DOCUMENT_ROOT']."/admin/Controller/BooksController.php";
	
?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>NLibarary Science Work Repositorium</title>
  <script type="text/javascript" src="js/deleteConfirmation.js"></script>
  <script type="text/javascript" src="js/updateConfirmation.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <script type="text/javascript" src="js/showmore.js"></script>
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
    else  //  If Useer Logined
	{ //TODO problem with logined ; Fisrt time cookies doenst work
     //  setcookie("cookie_username", $_SESSION["login"],time()+ 50) ; // We install cookie if logined
  
  ?>
  
<div id="maketo">
<?php
include_once('user_menu.php');
?>
<div id="content">
  <div align="center">Hello, member <b> user</b> aka <?php  echo  "<b>".$_SESSION["login"]."</b> id=".$_SESSION["u_id"] ;?>  </div>
  

  <?php
 // print_r($_COOKIE);
    if (isset($_COOKIE["cookie_username"])) 
	  {
		  echo "<div align='center'><font color='magenta'>Cookies enabled for user <strong>".$_COOKIE["cookie_username"]."</strong></font> </div><br>" ;
		  
	  }  
  
  ?>
  
  
 <?php

/* 
$bookmodel = new BooksModel(); 
$books=array();
$bookmodel->test2() ;
 */
 
tableform($_SESSION["u_id"]);
?> 
  
</div>
<div id="rasporka"></div> 
<div id="footer" align="center">Designed for NataliaLibrary @2017</div>
</div>  <!-- Maketo -->
<?php
	
	} //end of Else IF ($_SESSION["login"]=='admin')
   
  } // end of else if (!isset($_SESSION["login"]))
  
  ?>
</body>
</html>


<?php

function tableform($user_id)
{ 
 echo "<table class='simple' >";
 
 echo "<th width='15%'>Category</th>";
 echo "<th width='15%'>View</th>";
echo "<th width='15%'>Name of Book </th>";
echo "<th width='35%'>Description</th>";
echo "<th width='10%'>Year</th>";
echo "<th colspan='3'>Action</th>";

$bookcontroller = new BooksController(); 
$books=array();
$books = $bookcontroller->getBookListByUserIdfromModel($user_id);
//print_r($books);

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
	 echo "<td width='15%' class='bg'>".$books[$i]["cb_name"]."</td>";
     echo "<td width='15%' class='bg'><img src='../".$book_image."' width='50px' height='50px'></td>";
     echo "<td width='15%' class='bg'>"."<a href='..".$books[$i]["b_url"].$books[$i]["b_filename"]."' download  >".$books[$i]["b_name"]."</a></td>";
     echo "<td width='30%' class='bg'>".addShowMoreForDescription($books[$i]["b_description"])."</td>";
	  echo "<td width='5%' class='bg'>".$books[$i]["b_year"]."</td>";
     echo "<td class='bg'><a href='#' onclick='getUpdateConfirmationUserBook(".$books[$i]["b_id"].",4 );' ><center> <img src='images/update.gif' alt='обновить'></center></a></td>";
	 echo "<td class='bg'><a href='#' onclick='getDeleteConfirmationUserBook(".$books[$i]["b_id"].");'><center> <img src='images/delete.gif' alt='удалить'></center></a> </td>";
	 
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


