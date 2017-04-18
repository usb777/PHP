<?php

include_once "db_config.php" ;

class CategoryModel 
{      
  
 private $servername="";
 private $username=""; 
 private $password=""; 
 private $dbname="";

      function CategoryModel()
	  {	
		
		 $this->servername = DB_HOST;
		 $this->dbname =     DB_NAME;
		 $this->username =   DB_USER;
		 $this->password =   DB_PASSWORD;
  	    
		 
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
	 
	 /* Finished write Setters and getters methods take all server connect data */  
	 
	 
	  
	  
	
/*
this function return all categories in array
*/

    public function getAllCategory()  
    {  
	
       $conn = new mysqli($this->getServername(), $this->getUsername(), $this->getPassword(), $this->getDbname());
	   
	   if ($conn->connect_error) 
     {
       die("Connection failed: " . $conn->connect_error);
      }

           $sql = "SELECT * FROM category_book ORDER BY cb_name";
           $result = $conn->query($sql);
		   
         $categories = array();
		 $i=0;
              if ($result->num_rows > 0) 
           {
              // output data of each row
	           $flag = FALSE;
	
          while($row = $result->fetch_assoc()) 
	       {
		   //  echo $row["b_id"]." Book Name: ".$row["b_name"]." year:".$row["b_year"]."<br>"   ;
			 
			              
          $categories[$i]["cb_id"]=$row["cb_id"];
		  $categories[$i]["cb_name"]=$row["cb_name"];
		 
		 
		 
		   $i++;
           }  //while	   
	   
          } //if
		return   $categories;
	} // end of function	
      
	  
	  
	  
	  
	  
      public function getCategoryById($category_id)  
    {  
	
       $conn = new mysqli($this->getServername(), $this->getUsername(), $this->getPassword(), $this->getDbname());
	   
	   if ($conn->connect_error) 
     {
       die("Connection failed: " . $conn->connect_error);
      }

           $sql = "SELECT * FROM category_book where cb_id='".$category_id."'"   ;
           $result = $conn->query($sql);
		   
         $categories = array();
		 $i=0;
              if ($result->num_rows > 0) 
           {
              // output data of each row
	           $flag = FALSE;
	
         // while
		  $row = $result->fetch_assoc(); 
	       {
		    $categories[$i]["cb_id"]=$row["cb_id"];
		    $categories[$i]["cb_name"]=$row["cb_name"];
		    $i++;
           }  //while	   
	   
          } //if
		return   $categories;
	} // end of function	  


   
    /*
   this function insert user from Admin Panel user
   */
   
   public function insertCategoryByAdmin($cb_name)  
   {
	   $conn = new mysqli($this->getServername(), $this->getUsername(), $this->getPassword(), $this->getDbname());
         if ($conn->connect_error) 
           {
                die("Connection failed: " . $conn->connect_error);
           }
    
         try {
		 $sql = "INSERT INTO category_book 
                ( cb_name )
                 VALUES
                ( '".$cb_name."')";
			   
         $result = $conn->query($sql);
		 
		 $conn->close();
		 } catch (Exception $e) 
		    { 
			echo "error in database is = ".$e;
			}
		
	   
   }
   
      /* this function Update user Data on page backendUpdateUser.php */    
   public function updateCategoryByAdmin($cb_id, $cb_name)  
   {
	   $conn = new mysqli($this->getServername(), $this->getUsername(), $this->getPassword(), $this->getDbname());
         if ($conn->connect_error) 
           {
                die("Connection failed: " . $conn->connect_error);
           }
   
   
         try 
		 {
		  $sql = " UPDATE category_book SET cb_name='".$cb_name."' WHERE cb_id='".$cb_id."'  ";			   
          $result = $conn->query($sql);		 
		  $conn->close();
		  
		 } catch (Exception $e) 
		    { 
			echo "error in database is = ".$e;
			}		
	   
   }  //updateCategoryByAdmin

   /*
   this function delete Category by ID from Admin Panel user
   */
   
   public function deleteCategoryByAdmin($cb_id)  
   {
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
		 $sql = "DELETE FROM category_book WHERE cb_id = '".$cb_id."'  ";
			   
         $result = $conn->query($sql);
		 
		 $conn->close();
		 } catch (Exception $e) 
		    { 
			echo "error in database is = ".$e;
			}
		
	   
   }
	
      
      
} // class CategoryModel  

?>