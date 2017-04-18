<?php

include_once "db_config.php" ;
 
class UsersModel 
{      
  
 private $servername="";
 private $username=""; 
 private $password=""; 
 private $dbname="";

      function UsersModel()
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
this function return ***all-users-data*** 
from table 'users' 
    and
save all data to array
*/
    public function getAllUsers($orderBY="u_login")  
    {  
	
       $conn = new mysqli($this->getServername(), $this->getUsername(), $this->getPassword(), $this->getDbname());
	   
	   if ($conn->connect_error) 
     {
       die("Connection failed: " . $conn->connect_error);
      }

           $sql = "SELECT u.*, r.`role_name`, s.`status_name` FROM users u
                   JOIN  role r
                   ON
                   u.`role_id` =r.`role_id`
                   JOIN STATUS s
                   ON 
                   u.`status_id`=s.`status_id` ORDER BY ".$orderBY;
           $result = $conn->query($sql);
		   
         $users = array();
		 $i=0;
              if ($result->num_rows > 0) 
           {
              // output data of each row
	           $flag = FALSE;
	
          while($row = $result->fetch_assoc()) 
	       {
		  			           
          $users[$i]["u_id"]=$row["u_id"];
		  $users[$i]["u_login"]=$row["u_login"];
		  $users[$i]["u_passw"]=$row["u_passw"];
		  $users[$i]["u_firstname"]=$row["u_firstname"];
		  $users[$i]["u_lastname"]=$row["u_lastname"];
		  $users[$i]["u_mail"]=$row["u_mail"];
		  $users[$i]["u_facebookid"]=$row["u_facebookid"];
		  $users[$i]["role_name"]=$row["role_name"];
		  $users[$i]["status_name"]=$row["status_name"];
		   $i++;
           }  //while	   
	   
          } //if
		return   $users;
	} // end of function	
  
  /*
  Get One user by ID from database table 'users'
  */  
  public function getUserById($u_id)  
    {  
	
       $conn = new mysqli($this->getServername(), $this->getUsername(), $this->getPassword(), $this->getDbname());
	   
	   if ($conn->connect_error) 
     {
       die("Connection failed: " . $conn->connect_error);
      }

           $sql = "SELECT u.*, s.`status_name`, r.`role_name` FROM users u, STATUS s, role r 

                   WHERE (u.u_id='".$u_id."') AND (u.`role_id` = r.`role_id`) AND (u.`status_id`=s.`status_id`) " ;
		   
		 
           $result = $conn->query($sql);
		   
         $user = array();
		 
              if ($result->num_rows > 0) 
           {
              // output data of each row
	           $flag = FALSE;
			   
	      $row = $result->fetch_assoc();                  
          $user[0]["u_id"]=$row["u_id"];
		  $user[0]["u_login"]=$row["u_login"];
		  $user[0]["u_passw"]=$row["u_passw"];
		  $user[0]["u_firstname"]=$row["u_firstname"];
		  $user[0]["u_lastname"]=$row["u_lastname"];
		  $user[0]["u_mail"]=$row["u_mail"];
		  $user[0]["u_facebookid"]=$row["u_facebookid"];
		  $user[0]["role_id"]=$row["role_id"];
		  $user[0]["status_id"]=$row["status_id"];
          $user[0]["role_name"]=$row["role_name"];
		  $user[0]["status_name"]=$row["status_name"];		  
	   
          } //if
		return   $user;
	} // end of function	

/* this function Update user Data on page backendUpdateUser.php */    
   public function updateUserData($u_login, $u_passw,$u_firstname,$u_lastname,$u_mail,$u_id)  
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
		 $sql = " UPDATE users SET u_login='".$u_login."', u_passw='".$u_passw."', u_firstname='".$u_firstname."', 
		                           u_lastname='".$u_lastname."', u_mail='".$u_mail."' WHERE u_id='".$u_id."' ; ";
			   
         $result = $conn->query($sql);
		 
		 $conn->close();
		 } catch (Exception $e) 
		    { 
			echo "error in database is = ".$e;
			}
		
	   
   }
   
   /* this function Update user Data on page backendUpdateUser.php */    
   public function updateUserDataByAdmin($u_login, $u_passw,$u_firstname,$u_lastname,$u_mail,$u_id,$role_id, $status_id)  
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
		 $sql = " UPDATE users SET u_login='".$u_login."', u_passw='".$u_passw."', u_firstname='".$u_firstname."', 
		          u_lastname='".$u_lastname."', u_mail='".$u_mail."', role_id='".$role_id."', status_id='".$status_id."'  WHERE u_id='".$u_id."' ; ";
			   
         $result = $conn->query($sql);
		 
		 $conn->close();
		 } catch (Exception $e) 
		    { 
			echo "error in database is = ".$e;
			}
		
	   
   }
   
   
   /*
   this function delete user by ID from Admin Panel user
   */
   
   public function deleteUserDataByAdmin($u_id)  
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
		 $sql = "DELETE FROM users WHERE u_id = '".$u_id."'  ";
			   
         $result = $conn->query($sql);
		 
		 $conn->close();
		 } catch (Exception $e) 
		    { 
			echo "error in database is = ".$e;
			}
		
	   
   }
   
    /*
   this function insert user from Admin Panel user
   */
   
   public function insertUserDataByAdmin($u_login, $u_passw,$u_firstname,$u_lastname,$u_mail,$role_id, $status_id)  
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
		 $sql = "INSERT INTO users 
                ( u_login, u_passw, u_firstname, u_lastname, u_mail, role_id, status_id  )
                 VALUES
                ( '".$u_login."', '".$u_passw."', '".$u_firstname."', '".$u_lastname."', '".$u_mail."', '".$role_id."', '".$status_id."' )";
			   
         $result = $conn->query($sql);
		 
		 $conn->close();
		 } catch (Exception $e) 
		    { 
			echo "error in database is = ".$e;
			}
		
	   
   }
   
   
   public function test()
   {
	   echo "test from Users Model";
	   
   }
   
      
      
} // class UsersModel  

?>