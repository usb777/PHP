<?php

include_once "db_config.php" ;
 
class RoleModel 
{      
  
 private $servername="";
 private $username=""; 
 private $password=""; 
 private $dbname="";

      function RoleModel()
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
	 
	  
  public function getAllRoleList($orderby="role_id")  
    {  
	 //include_once "../../db_config.php" ;
	 
        // here goes some hardcoded values to simulate the database  
       $conn = new mysqli($this->getServername(), $this->getUsername(), $this->getPassword(), $this->getDbname());
	   
	   if ($conn->connect_error) 
     {
       die("Connection failed: " . $conn->connect_error);
      }

          // $sql = "SELECT * FROM books ORDER BY ".$orderby;
		  try
		  {
		   $sql = "SELECT role_id, role_name from role  ORDER BY ".$orderby;
		  } catch (Exception $e)
		    {
				echo "Error in sql query ".$e."<br>";
                echo " Maybe wrong parameter --orderby--  <br>";
   				
			}
		  
		   $result = $conn->query($sql);
		   
         $roles = array();
		 $i=0;
              if ($result->num_rows > 0) 
           {
              // output data of each row
	           $flag = FALSE;
	
          while($row = $result->fetch_assoc()) 
	       {
		   //  echo $row["b_id"]." Book Name: ".$row["b_name"]." year:".$row["b_year"]."<br>"   ;
			 
			
         $roles[$i]["role_id"]=$row["role_id"];    
         $roles[$i]["role_name"]=$row["role_name"];
		
		 
		   $i++;
           }  //while	   
	   
          } //if
		return  $roles;
	} // end of function	

	
 /*
  Get One role by ID from database table 'role'
  */  
  public function getRoleById($role_id)  
    {  
	
       $conn = new mysqli($this->getServername(), $this->getUsername(), $this->getPassword(), $this->getDbname());
	   
	   if ($conn->connect_error) 
     {
       die("Connection failed: " . $conn->connect_error);
      }

           $sql = "SELECT role_id, role_name FROM role WHERE role_id = '".$role_id."' " ;
		   
		 
           $result = $conn->query($sql);
		   
         $role = array();
		 
              if ($result->num_rows > 0) 
           {
              // output data of each row
	           $flag = FALSE;
			   
	      $row = $result->fetch_assoc();                  
          $role[0]["role_id"]=$row["role_id"];
		  $role[0]["role_name"]=$row["role_name"];
		  	  
	   
          } //if
		return   $role;
	} // end of function		
   
      
      
} // class RoleModel  




?>