<?php
 include_once $_SERVER['DOCUMENT_ROOT']."/admin/Controller/BooksController.php";
//include_once $_SERVER['DOCUMENT_ROOT']."/admin/Model/BooksModel.php";
 
 ?>
<!DOCTYPE HTML>
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
	
      
      <div class="content"> <!--// Body of search method //-->
	  
	<?php
	
	   echo "<br>We are looking book with parameter - <b class='search'>".$_REQUEST['search_field']."</b><br><br>";
	   
	   $bookcontroller = new BooksController(); 
       $booksFromSearch=array();
       $booksFromSearch = $bookcontroller->getSearchResultFromModel($_REQUEST['search_field'], 'b_name')  ;
	 //  print_r($booksFromSearch);
	   
	   showSearchResult($booksFromSearch);
	
	?>	
		
	  
	  </div>  <!--// end content  //-->
    </div>  <!--// end site_content  //-->
	
	
<?php 
 /***************  This code include footer *****************************/
       include 'footer.php';        
?>


<?php


function returnBookTypeImage($type="txt")
{  $image="";
	switch ($type) 
	{
    case "doc":
        $image="word.png";
        break;
    case "docx":
        $image="word.png";
        break;
    case "pdf":
        $image="pdf.png";
        break;
	case "txt":
        $image="txt.png";
        break;	
		
    default:
        echo "Your favorite color is neither red, blue, nor green!";
	}	
		
	return $image;	
	
}

/*This function add DIV tag and style to TEXT over 100 symbols */
function addShowMoreForDescription($str)
{
	if (strlen($str)>=50 )
	{  $str = "<div class='more'>".$str."</div>"  ;

          return $str;
     }
   else 
	   return $str;	
	
}


function showSearchResult ($searchResults)
{  $t="";
	
	for ($i=0;$i<count($searchResults);$i++)
	{ 
$t.="<hr class='style-six'><br>";
    $t.= ($i+1).". "."<a href='".$searchResults[$i]["b_url"].$searchResults[$i]["b_filename"]
    ."' download   ><font color='white'>".strtoupper($searchResults[$i]['b_name'])."</font> (".$searchResults[$i]['b_year'].") - "
	.$searchResults[$i]['b_description']."</a><br>"."<br>";
	
	
	}
	echo $t;
}

?>

