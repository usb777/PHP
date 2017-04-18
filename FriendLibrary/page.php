<?php
 include_once $_SERVER['DOCUMENT_ROOT']."/admin/Controller/BooksController.php";
 ?>
<!DOCTYPE HTML>
<html>

<head>
  <title>Nataliya Library</title>
  <meta name="description" content="website description" />
  <meta name="keywords" content="website keywords, website keywords" />
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
  <link rel="stylesheet" type="text/css" href="css/style.css" />
      <!-- modernizr enables HTML5 elements and feature detects -->
  <script type="text/javascript" src="js/modernizr-1.5.min.js"></script>
   <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
   <script type="text/javascript" src="js/showmore.js"></script>  
   
   <!--//this code needed for Ajax Search //-->
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    	
    $( "#search" ).autocomplete({
      maxLength: 5,
      source: 'searchAJAX.php'
        });
   
});
  </script>
</head>

<body>
  <div id="main">

   <?php 
 /***************  This code include header *****************************/
       include 'header.php';        
   ?>
  
  
  
    <div id="site_content">
	
	
	 <?php 
 /***************  This code include sidebar *****************************/
       include 'sidebar.php';        
   ?>	
	
	
  
      <div class="content">
	  
	   <br>
	  
     <?php
		$protocol="http";
		  echo $protocol . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']."<br>";
		
		?>
	 Page data

	   </div> <!--//content //-->
    </div>  <!--// site_content //-->
<?php 
 /***************  This code include footer *****************************/
       include 'footer.php';        
?>