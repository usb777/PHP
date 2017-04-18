<?php

include_once $_SERVER['DOCUMENT_ROOT']."/admin/Model/db_config.php" ;
 
class BooksModel 
{      
  
 private $servername="";
 private $username=""; 
 private $password=""; 
 private $dbname="";
 private $globalRoot="";

      function BooksModel()
	  {/*
		 include_once "../../db_config.php" ;
		
		 $this->servername =$servername;
		 $this->username=$username;
		 $this->password=$password;
  	     $this->dbname=$dbname;
		 
		 */		
		
		 $this->servername =DB_HOST;
		 $this->username=DB_USER;
		 $this->password=DB_PASSWORD;
  	     $this->dbname=DB_NAME;
		 
		 $this->globalRoot=GLOBAL_ROOT;
	  }
	  
	  
	/* Bellow will write Setters and getters methods take all server connect data */  
	  public function setServername($servername)
	 {
		 $this->servername=$servername;
	 }	 
      
	 public function getServername()
	 {
		 return $this->servername;
	 }
	 
	  public function setUsername($username)
	 {
		 $this->username=$username;
	 }	 
      
	 public function getUsername()
	 {
		 return $this->username;
	 }
	 
	  public function setPassword($password)
	 {
		 $this->password=$password;
	 }	 
      
	 public function getPassword()
	 {
		 return $this->password;
	 }
	 
	   public function setDbname($dbname)
	 {
		 $this->dbname=$dbname;
	 }	 
      
	 public function getDbname()
	 {
		 return $this->dbname;
	 }
	 
	 public function setglobalRoot($globalRoot)
	 {
		 $this->globalRoot=$globalRoot;
	 }	 
      
	 public function getglobalRoot()
	 {
		 return $this->globalRoot;
	 }
	 
	 /* Finished write Setters and getters methods take all server connect data */  
	 
	  
	  
	  
	
/*Get all books by USER id*/
    public function getBookListByUserId($u_id)  
    {  
	 //include_once "../../db_config.php" ;
	 
        // here goes some hardcoded values to simulate the database  
       $conn = new mysqli($this->getServername(), $this->getUsername(), $this->getPassword(), $this->getDbname());
	   
	   if ($conn->connect_error) 
     {
       die("Connection failed: " . $conn->connect_error);
      }

           $sql = "SELECT b.*, cb.cb_name FROM books b, category_book cb where  (u_id='".$u_id."') AND (cb.cb_id =b.cb_id )  ";
           $result = $conn->query($sql);
		   
         $books = array();
		 $i=0;
              if ($result->num_rows > 0) 
           {
              // output data of each row
	           $flag = FALSE;
	
          while($row = $result->fetch_assoc()) 
	       {
		   //  echo $row["b_id"]." Book Name: ".$row["b_name"]." year:".$row["b_year"]."<br>"   ;
			 
			
              
         $books[$i]["b_id"]=$row["b_id"];
		 $books[$i]["u_id"]=$row["u_id"];
		 $books[$i]["b_url"]=$row["b_url"];
		 $books[$i]["b_description"]=$row["b_description"];
		 $books[$i]["b_year"]=$row["b_year"];
		 $books[$i]["b_name"]=$row["b_name"];
		 $books[$i]["b_filename"]=$row["b_filename"];
		 $books[$i]["b_img1"]=$row["b_img1"];
		 $books[$i]["b_img2"]=$row["b_img2"];
		 $books[$i]["b_img3"]=$row["b_img3"];
		 $books[$i]["cb_id"]=$row["cb_id"];
		 $books[$i]["cb_name"]=$row["cb_name"];
		 
		   $i++;
           }  //while	   
	   
          } //if
		return  $books;
	} // end of function

	
  public function getFullBookList($orderby='u_login')  
    {  
	 //include_once "../../db_config.php" ;
	 
        // here goes some hardcoded values to simulate the database  
       $conn = new mysqli($this->getServername(), $this->getUsername(), $this->getPassword(), $this->getDbname());
	   
	   if ($conn->connect_error) 
     {
       die("Connection failed: " . $conn->connect_error);
      }

          // $sql = "SELECT * FROM books ORDER BY ".$orderby;
		  try{
		  $sql = "SELECT cb.cb_name, b.*, u.`u_login` FROM books b, users u , category_book cb 
                   WHERE b.u_id = u.u_id AND b.cb_id=cb.cb_id  ORDER BY ".$orderby;
		  } catch (Exception $e)
		    {
				echo "Error in sql query ".$e."<br>";
                echo " Maybe wrong parameter --orderby--  <br>";
   				
			}
		  
		   $result = $conn->query($sql);
		   
         $books = array();
		 $i=0;
              if ($result->num_rows > 0) 
           {
              // output data of each row
	           $flag = FALSE;
	
          while($row = $result->fetch_assoc()) 
	       {
		   //  echo $row["b_id"]." Book Name: ".$row["b_name"]." year:".$row["b_year"]."<br>"   ;
			 
			
         $books[$i]["u_login"]=$row["u_login"];    
         $books[$i]["b_id"]=$row["b_id"];
		 $books[$i]["u_id"]=$row["u_id"];
		 $books[$i]["b_url"]=$row["b_url"];
		 $books[$i]["b_description"]=$row["b_description"];
		 $books[$i]["b_year"]=$row["b_year"];
		 $books[$i]["b_name"]=$row["b_name"];
		 $books[$i]["b_filename"]=$row["b_filename"];
		 $books[$i]["b_img1"]=$row["b_img1"];
		 $books[$i]["b_img2"]=$row["b_img2"];
		 $books[$i]["b_img3"]=$row["b_img3"];
		 $books[$i]["cb_id"]=$row["cb_id"];
		 $books[$i]["cb_name"]=$row["cb_name"];
		 
		   $i++;
           }  //while	   
	   
          } //if
		return  $books;
	} // end of function



//Get Search result  

 public function getSearchResult($search_field, $orderby='b_name')  
    {  
	 //include_once "../../db_config.php" ;
	 
        // here goes some hardcoded values to simulate the database  
       $conn = new mysqli($this->getServername(), $this->getUsername(), $this->getPassword(), $this->getDbname());
	   
	   if ($conn->connect_error) 
     {
       die("Connection failed: " . $conn->connect_error);
      }

          // $sql = "SELECT * FROM books ORDER BY ".$orderby;
		  try{
		  $sql = "SELECT cb.cb_name, b.*, u.`u_login` FROM books b, users u , category_book cb 
                   WHERE (b.u_id = u.u_id AND b.cb_id=cb.cb_id) AND 
                     
     ((b_name LIKE '%".$search_field."%' OR b_filename LIKE '%".$search_field."%' OR b_description LIKE '%".$search_field."%' OR b_year LIKE '%".$search_field."%' ))             
                   
                   
                   
                   
                   ORDER BY ".$orderby;
		  } catch (Exception $e)
		    {
				echo "Error in sql query ".$e."<br>";
                echo " Maybe wrong parameter --orderby--  <br>";
   				
			}
		  
		   $result = $conn->query($sql);
		   
         $books = array();
		 $i=0;
              if ($result->num_rows > 0) 
           {
              // output data of each row
	           $flag = FALSE;
	
          while($row = $result->fetch_assoc()) 
	       {
		   //  echo $row["b_id"]." Book Name: ".$row["b_name"]." year:".$row["b_year"]."<br>"   ;
			 
			
         $books[$i]["u_login"]=$row["u_login"];    
         $books[$i]["b_id"]=$row["b_id"];
		 $books[$i]["u_id"]=$row["u_id"];
		 $books[$i]["b_url"]=$row["b_url"];
		 $books[$i]["b_description"]=$row["b_description"];
		 $books[$i]["b_year"]=$row["b_year"];
		 $books[$i]["b_name"]=$row["b_name"];
		 $books[$i]["b_filename"]=$row["b_filename"];
		 $books[$i]["b_img1"]=$row["b_img1"];
		 $books[$i]["b_img2"]=$row["b_img2"];
		 $books[$i]["b_img3"]=$row["b_img3"];
		 $books[$i]["cb_id"]=$row["cb_id"];
		 $books[$i]["cb_name"]=$row["cb_name"];
		 
		   $i++;
           }  //while	   
	   
          } //if
		return  $books;
	} // end of function


	
 /*
  Get All Books  from database table 'books' by select category
  */  	
	
 public function getFullBookListByCategory($cb_name)  
    {  
	 //include_once "../../db_config.php" ;
	 
        // here goes some hardcoded values to simulate the database  
       $conn = new mysqli($this->getServername(), $this->getUsername(), $this->getPassword(), $this->getDbname());
	   
	   if ($conn->connect_error) 
     {
       die("Connection failed: " . $conn->connect_error);
      }

          // $sql = "SELECT * FROM books ORDER BY ".$orderby;
		  try{
		  $sql = "SELECT cb.cb_name, b.*, u.`u_login` FROM books b, users u , category_book cb 
                   WHERE (b.u_id = u.u_id) AND (b.cb_id=cb.cb_id) AND (cb.cb_name='".$cb_name."')  ORDER BY cb.cb_name ";
		  } catch (Exception $e)
		    {
				echo "Error in sql query ".$e."<br>";
                echo " Maybe wrong parameter --orderby--  <br>";
   				
			}
		  
		   $result = $conn->query($sql);
		   
         $books = array();
		 $i=0;
              if ($result->num_rows > 0) 
           {
              // output data of each row
	           $flag = FALSE;
	
          while($row = $result->fetch_assoc()) 
	       {
		   //  echo $row["b_id"]." Book Name: ".$row["b_name"]." year:".$row["b_year"]."<br>"   ;
			 
			
         $books[$i]["u_login"]=$row["u_login"];    
         $books[$i]["b_id"]=$row["b_id"];
		 $books[$i]["u_id"]=$row["u_id"];
		 $books[$i]["b_url"]=$row["b_url"];
		 $books[$i]["b_description"]=$row["b_description"];
		 $books[$i]["b_year"]=$row["b_year"];
		 $books[$i]["b_name"]=$row["b_name"];
		 $books[$i]["b_filename"]=$row["b_filename"];
		 $books[$i]["b_img1"]=$row["b_img1"];
		 $books[$i]["b_img2"]=$row["b_img2"];
		 $books[$i]["b_img3"]=$row["b_img3"];
		 $books[$i]["cb_id"]=$row["cb_id"];
		 $books[$i]["cb_name"]=$row["cb_name"];
		 
		   $i++;
           }  //while	   
	   
          } //if
		return  $books;
	} // end of function		
	
	
	
	
      
    /*
  Get One Book by ID from database table 'books'
  */  
  public function getBookById($b_id)  
    {  
	
       $conn = new mysqli($this->getServername(), $this->getUsername(), $this->getPassword(), $this->getDbname());
	   
	   if ($conn->connect_error) 
     {
       die("Connection failed: " . $conn->connect_error);
      }
      //SELECT u.`u_login`, cb.`cb_name`,  b.* FROM books b, users u, category_book cb WHERE (u.`u_id` = b.`u_id`) AND (b.`cb_id` = cb.`cb_id`)
           $sql = "SELECT * FROM books WHERE b_id = '".$b_id."'" ;
		   
		 
           $result = $conn->query($sql);
		   
         $book = array();
		 $i=0;
              if ($result->num_rows > 0) 
           {
              // output data of each row
	         
			   
	      $row = $result->fetch_assoc();                  
           
         $book[$i]["b_id"]=$row["b_id"];
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
		 		  
	   
          } //if
		return   $book;
	} // end of function	

 public function insertBookData($u_id, $b_url, $b_description, $b_year, $b_name, $b_filename,$cb_id, $b_img1)  
   {
	   $conn = new mysqli($this->getServername(), $this->getUsername(), $this->getPassword(), $this->getDbname());
         if ($conn->connect_error) 
           {
                die("Connection failed: " . $conn->connect_error);
           }
		   
		  // $url_book = $GLOBAL_HOST.$b_url;
		   
		   $sql = "INSERT INTO books 
                 (u_id, b_url, b_description, b_year, b_name, b_filename,cb_id, b_img1)
                VALUES 
   ('".$u_id."','".$b_url."','".$b_description."','".$b_year."',
   '".$b_name."','".$b_filename."' ,'".$cb_id."' , '".$b_img1."'  )";
			   
         $result = $conn->query($sql);
		 $conn->close();
    
	   
	 
	   
   } // end of insert book

   
   
      /* this function Update Book Data By Admin */    

  public function updateBookByAdmin($b_id, $b_name,  $b_description, $b_year, $b_url,  $b_filename, $cb_id)  
   {
	$book_file_name = $this->makeFileNameFromBookNameInput($b_name);
	   // change file name of image in database and phisically
    $book = $this->getBookById($b_id);   
	
    $book_file =  pathinfo($book[0]["b_filename"]); //real file name
    $image_file = pathinfo($book[0]["b_img1"]); //real image name
			 
	$bookFileName_withExtension = $book_file_name.".".$book_file['extension'] ; // create bookfilename with Extension
	$imageFileName_withExtension =$book_file_name.".".$image_file['extension'] ; // creat	   
	$this->updateBookFile($b_id, $bookFileName_withExtension); // phisically rename image and book file
		  
		 
	   $conn = new mysqli($this->getServername(), $this->getUsername(), $this->getPassword(), $this->getDbname());
         if ($conn->connect_error) 
           {
                die("Connection failed: " . $conn->connect_error);
           }
		   
		
   
   try 
	{
  $sql = " UPDATE books SET 
  b_name='".$b_name."', b_description='".$b_description."', b_year='".$b_year."', b_url='".$b_url."', b_filename='".$b_filename."', cb_id='".$cb_id."',
	        b_img1='".$imageFileName_withExtension."'  WHERE b_id='".$b_id."'  ";			   
          $result = $conn->query($sql);		 
		  $conn->close();
		  
	} catch (Exception $e) 
		    { 
			echo "error in database is = ".$e;
			}		
	   
   }  //updateBookByAdmin
   
   
      /* this function Update Book data by User */    

  public function updateBookByUser($b_id, $b_name,  $b_description, $b_year, $b_url,  $b_filename,  $cb_id)  
   {
	$book_file_name = $this->makeFileNameFromBookNameInput($b_name);
	   // change file name of image in database and phisically
    $book = $this->getBookById($b_id);   
	
    $book_file =  pathinfo($book[0]["b_filename"]); //real file name
    $image_file = pathinfo($book[0]["b_img1"]); //real image name
			 
	$bookFileName_withExtension = $book_file_name.".".$book_file['extension'] ; // create bookfilename with Extension
	$imageFileName_withExtension =$book_file_name.".".$image_file['extension'] ; // creat	   
	$this->updateBookFile($b_id, $bookFileName_withExtension); // phisically rename image and book file
		
	   
	   $conn = new mysqli($this->getServername(), $this->getUsername(), $this->getPassword(), $this->getDbname());
         if ($conn->connect_error) 
           {
                die("Connection failed: " . $conn->connect_error);
           }
   
   
   
   try 
	{
     $sql = " UPDATE books SET 
     b_name='".$b_name."', b_description='".$b_description."', b_year='".$b_year."', b_url='".$b_url."', b_filename='".$bookFileName_withExtension."', cb_id='".$cb_id."',
	      b_img1='".$imageFileName_withExtension."'  WHERE b_id='".$b_id."'  ";	
			
          $result = $conn->query($sql);		 
		  $conn->close();
		  
	} catch (Exception $e) 
		    { 
			echo "error in database is = ".$e;
			}		
	   
   }  //updateBookByUser 
   
   
   

   /*
   this function delete Book by ID from Admin Panel user
   */
   
   public function deleteBookByAdmin($b_id)  
   {
	   
	    // delete file
	  $this->deleteBookFile($b_id);
	   
	   
	   $conn = new mysqli($this->getServername(), $this->getUsername(), $this->getPassword(), $this->getDbname());
         if ($conn->connect_error) 
           {
                die("Connection failed: " . $conn->connect_error);
           }
     /*   
	   sql =  UPDATE users SET u_login='user11', u_passw='user11', u_firstname='Polzovatel', 
	          u_lastname='Pervyj', u_mail='user1@user1.com' WHERE u_id='2' ; 
	 */ 
         try {
		 $sql = "DELETE FROM books WHERE b_id = '".$b_id."'  ";
			   
         $result = $conn->query($sql);
		 
		 $conn->close();
		 } catch (Exception $e) 
		    { 
			echo "error in database is = ".$e;
			}
			                
		// Delete book file By Admin
	/* $current_book = $this->getBookById($b_id);	        
     unlink($this->getglobalRoot().$current_book[0]["b_url"].$current_book[0]["b_filename"])	; // doesnt work!!!
	*/
	   
   }   
  
   /*
   this function delete Book by ID from User Panel by user
   */
   
   public function deleteBookByUser($b_id)  
   {
	   
	   // delete file
	  $this->deleteBookFile($b_id);
	   
	   $conn = new mysqli($this->getServername(), $this->getUsername(), $this->getPassword(), $this->getDbname());
         if ($conn->connect_error) 
           {
                die("Connection failed: " . $conn->connect_error);
           }
     /*   
	   sql =  UPDATE users SET u_login='user11', u_passw='user11', u_firstname='Polzovatel', 
	          u_lastname='Pervyj', u_mail='user1@user1.com' WHERE u_id='2' ; 
	 */ 
         try {
		 $sql = "DELETE FROM books WHERE b_id = '".$b_id."'  ";
			   
         $result = $conn->query($sql);
		 
		 $conn->close();
		 } catch (Exception $e) 
		    { 
			echo "error in database is = ".$e;
			}
		
		// Delete book file By Admin
	  
	   
   }

   // phisically delete file
public function deleteBookFile($b_id)
{
	 try {
	         $current_book = $this->getBookById($b_id);	        
              unlink($this->getglobalRoot().$current_book[0]["b_url"].$current_book[0]["b_filename"])	; 
			  unlink($this->getglobalRoot().$current_book[0]["b_url"]."images/".$current_book[0]["b_img1"])	; 
	       } catch (Exception $e) 
		    { 
			echo "error in Delete file is = ".$e;
			}
	
} //deleteBookFile($b_id)

   // phisically update file name
public function updateBookFile($b_id, $new_name)
{
	 try{
	         $current_book = $this->getBookById($b_id);	   
             $PATH =$this->getglobalRoot().$current_book[0]["b_url"]; 
             $PATHForImages =$this->getglobalRoot().$current_book[0]["b_url"]."images/"; 			 
             
			  rename($PATH.$current_book[0]["b_filename"], $PATH.$new_name);
			 
			 $book_file =  pathinfo($new_name); //from here we take filename
             $image_file = pathinfo($current_book[0]["b_img1"]); //from here we take image extension
			 $newImageFileName =$book_file['filename'].".".$image_file['extension'] ; // create bookfilename with Extension
			  
			  rename($PATHForImages.$current_book[0]["b_img1"], $PATHForImages.$newImageFileName);
			   // TODO rename Image
			   
	    }
	  catch (Exception $e) 
		    { 
			  echo "error in Update file is = ".$e;
			}
	
} //updateBookFile($b_id)


// This function Make book Name file from User Input Book name (first input field)  
function makeFileNameFromBookNameInput($str)
{
 
  $data = explode(" ",$str);
				    	
  $new_filename = "";
  for ($i=0;$i<count($data);$i++)
  {
	$new_filename.=$data[$i]."_";
  }	 
    $book_filename = substr($new_filename, 0,strlen($new_filename)-1); // remove last "-"
    $book_filename = str_replace(".","",$book_filename);   // check end remove .
 
 return $book_filename  ; 
}  
   
   
public function test2()
{
	//$current_book = $this->getBookById(3);	
	//echo " from test 2---".$this->getglobalRoot().$current_book[0]["b_url"].$current_book[0]["b_filename"] 	 ;       
   
}	
  public function test1()
{
	echo "<h1>You invoke test1</h1>" ;
}    
      
} // class BookModel  




?>