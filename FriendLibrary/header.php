<?php
 session_start();
  //include 'db_config.php';
?> 
 <header>
      <div id="logo">
        <div id="logo_text">
          <!-- class="logo_colour", allows you to change the colour of the text -->
          <h1><a href="index.php">Natali<span class="logo_colour"> library</span></a></h1>
          <h2>Usefull. Veritas. Proude.</h2>
        </div>
      </div>
      <nav>
        <div id="menu_container">
          <ul class="sf-menu" id="nav">
           <li><a href="index.php">Home</a></li>
          <!--//  <li><a href="examples.php">Examples</a></li>
            <li><a href="page.php">A Page</a></li> //-->
           
            <li><a href="#">Category</a>
              <ul>
  <?php
	 		  
			  
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) 
{
    die("Connection failed: " . $conn->connect_error);
} 


$sql = "SELECT * FROM `category_book` order by cb_name";
$result = $conn->query($sql);

if ($result->num_rows > 0) 
{
	$category = array();
    // output data of each row
	$i=0;
    while($row = $result->fetch_assoc()) 
	{ 
      $category[$i] = $row["cb_name"];    
      $i++;
	}
} else { }
$conn->close();
			  
			  
			for ($i=0;$i<count($category);$i++)
			{
				echo " <li><a href='books.php?cb_name=".$category[$i]."  '>".$category[$i]."</a></li>" ;
			}
               
				
			  ?>	
				
				
				 <li><a href="#">Medicine</a>
                  <ul>
                    <li><a href="#">One</a></li>
                    <li><a href="#">Two</a></li>
                    <li><a href="#">Three</a></li>
                    <li><a href="#">Sub Drop Down Four</a></li>
                    <li><a href="#">Sub Drop Down Five</a></li>
                  </ul>
                </li>
				
				
               
              </ul>
            </li>
            <li><a href="contact.php">Contact Us</a></li>
			
			<li>
			<div align="right" style="padding-top:13px;padding-left:10px;"> 
			<?php
			
			  if ((isset($_SESSION["login"]) ) && ($_SESSION["login"]!='') )
			  {
			     echo  "Welcome <b>".$_SESSION["login"]."</b>";
			  }
			?>
			
			</div>
			</li>
			
		
			
          </ul>
		  
		  <div align="right" style="padding-top:10px;">
		  <form method="get" action="search.php">   <!--// action="admin/Controller/BooksController.php"  //-->
			<input type="text" name="search_field" class="search" autocomplete="off" spellcheck="false" placeholder="Search book.." id="search">
		  </form>
			</div>
        </div>	
		  
		
      </nav>
	
    </header>