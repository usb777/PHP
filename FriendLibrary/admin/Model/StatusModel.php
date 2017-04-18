<?php
//echo "<font color='red'>path = ".$_SERVER['DOCUMENT_ROOT']."</font><br>";
 include_once "db_config.php" ;
 
class StatusModel 
{      
  
 private $servername="";
 private $username=""; 
 private $password=""; 
 private $dbname="";

      function StatusModel()
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
	 
	  
  public function getAllStatusList($orderby="status_id")  
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
		   $sql = "SELECT status_id, status_name from status  ORDER BY ".$orderby;
		  } catch (Exception $e)
		    {
				echo "Error in sql query ".$e."<br>";
                echo " Maybe wrong parameter --orderby--  <br>";
   				
			}
		  
		   $result = $conn->query($sql);
		   
         $status = array();
		 $i=0;
              if ($result->num_rows > 0) 
           {
              // output data of each row
	           $flag = FALSE;
	
          while($row = $result->fetch_assoc()) 
	       {
		   //  echo $row["b_id"]." Book Name: ".$row["b_name"]." year:".$row["b_year"]."<br>"   ;
			 
			
         $status[$i]["status_id"]=$row["status_id"];    
         $status[$i]["status_name"]=$row["status_name"];
		
		 
		   $i++;
           }  //while	   
	   
          } //if
		return  $status;
	} // end of function	


/*
  Get One status by ID from database table 'status'
  */  
  public function getStatusById($status_id)  
    {  
	
       $conn = new mysqli($this->getServername(), $this->getUsername(), $this->getPassword(), $this->getDbname());
	   
	   if ($conn->connect_error) 
     {
       die("Connection failed: " . $conn->connect_error);
      }

           $sql = "SELECT status_id, status_name FROM status WHERE status_id = '".$status_id."' " ;
		   
		 
           $result = $conn->query($sql);
		   
         $status = array();
		 
              if ($result->num_rows > 0) 
           {
              // output data of each row
	           $flag = FALSE;
			   
	      $row = $result->fetch_assoc();                  
          $status[0]["status_id"]=$row["status_id"];
		  $status[0]["status_name"]=$row["status_name"];
		  	  
	   
          } //if
		return   $status;
	} // end of function	
   
      
      
} // class StatusModel  




?>