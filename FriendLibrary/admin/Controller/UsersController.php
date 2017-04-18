<?php

 include_once($_SERVER['DOCUMENT_ROOT']."/admin/Model/UsersModel.php");
 
class UsersController 
{  

 private $usersmodel=NULL;
 
 public function __construct()    
     {   
	      $this->usersmodel = new UsersModel();
	 } 
	 
	 
	   public function setUsersModel($usersmodel)
	 {
		 $this->usersmodel=$usersmodel;
	 }	 
      
	 public function getUsersModel()
	 {
		 return $this->usersmodel;
	 }
	 
/*
Take All users data from Model
*/

public function getAllUsersDataFromModel()
{   
    $users=array();
	$users = $this->usersmodel->getAllUsers("u_id");  // if remove parameter - will order by login
	//print_r($users);
	return $users;
}

/*
this function call to UsersModel and Invoke similiar function, put data to array 
*/ 
public function getUserByIdFromModel($user_id)  
{  
	  $user=array();
	  $user = $this->usersmodel->getUserById($user_id);
	  return $user;
}	 
	 
	 
	 

/*
Update user data
*/
    public function updateUserData($u_login, $u_passw,$u_firstname,$u_lastname,$u_mail,$u_id)
	{
		 $this->usersmodel->updateUserData($u_login, $u_passw,$u_firstname,$u_lastname,$u_mail,$u_id);
		 
		// $this->usersmodel->test();
	}
	
/*
Update user data by ADMINISTRATOR
*/
    public function updateUserDataByAdmin($u_login, $u_passw,$u_firstname,$u_lastname,$u_mail,$u_id, $role_id, $status_id)
	{
		 $this->usersmodel->updateUserDataByAdmin($u_login, $u_passw,$u_firstname,$u_lastname,$u_mail,$u_id,$role_id, $status_id);
		 
		// $this->usersmodel->test();
	}


/*
Insert user data by ADMINISTRATOR
*/
    public function insertUserDataByAdmin ($u_login, $u_passw,$u_firstname,$u_lastname,$u_mail,$role_id, $status_id)
	{
		 $this->usersmodel->insertUserDataByAdmin($u_login, $u_passw,$u_firstname,$u_lastname,$u_mail,$role_id, $status_id);
		 
		// $this->usersmodel->test();
	}
	
	
	
	/*
Delete user data by ADMINISTRATOR
*/
    public function deleteUserDataByAdmin($u_id)
	{
		 $this->usersmodel->deleteUserDataByAdmin($u_id);
		 
		// $this->usersmodel->test();
	}
	
	
	
	
 
 /*redirect method - send on another page */     
    public function redirect($location)
   {
	
     header('Location: '.$location);	
   }
      
} // class UsersController


/**********************OUT of Controller input, but use Controller method*********************************/

if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    //something posted

    if (isset($_POST['submUserInfo'])) 
	{
        
		
		session_start();
	    $_SESSION["reportUpdateUser"] ="<font color='red'>Update of user's data was succefull</font><br><br>";
	
		$userscontroller  = new UsersController();
		$userscontroller->updateUserData($_REQUEST['login'], $_REQUEST['passw1'],$_REQUEST['first_name'],$_REQUEST['last_name'],$_REQUEST['mail'],$_SESSION["u_id"]);
		
		$_SESSION["login"] = $_REQUEST['login']; // Just in cause change value of the --Session[LOGIN] -variable
		
		$userscontroller->redirect($GLOBAL_HOST."/admin/backendUpdateUser.php");
		
    } 
	else 
	  {
        //assume btnSubmit
      }
	  
	  
	  
	 if (isset($_POST['submUserInfoByAdmin'])) //Update User from Admin
	{
        
		
		session_start();
	    $_SESSION["reportUpdateUser"] ="<font color='red'>Update of user's data was succefull</font><br><br>";
	
		$userscontroller  = new UsersController();
		$userscontroller->updateUserDataByAdmin($_REQUEST['login'], $_REQUEST['passw1'],$_REQUEST['first_name'],$_REQUEST['last_name'],$_REQUEST['mail'],$_REQUEST['u_id'],$_REQUEST['role_id'], $_REQUEST['status_id']);
			
		
		$userscontroller->redirect($GLOBAL_HOST."/admin/backendSAUpdateUser.php?u_id=".$_REQUEST['u_id']);
		
    } 
	else 
	  {
        //assume btnSubmit
      }
	  

 if (isset($_POST['submUserInsertByAdmin'])) //Update User from Admin
	{
        
		
		session_start();
	   
	
		$userscontroller  = new UsersController();
		$userscontroller->insertUserDataByAdmin($_REQUEST['login'], $_REQUEST['passw1'],$_REQUEST['first_name'],$_REQUEST['last_name'],$_REQUEST['mail'],$_REQUEST['role_id'], $_REQUEST['status_id']);
				
		
	    $userscontroller->redirect($GLOBAL_HOST."/admin/backendSuperAdminAllUsers.php");
		
    } 
	else 
	  {
        //assume btnSubmit
      }
	  	  

	  
	  
}

// delete user 
  
	   if (isset($_REQUEST['u_id'])&&($_REQUEST['action']=='deleteUser') ) //Update User from Admin
	{
        
		
		session_start();
		
		$userscontroller  = new UsersController();
		$userscontroller->deleteUserDataByAdmin( $_REQUEST['u_id'] );
			
		
		$userscontroller->redirect($GLOBAL_HOST."/admin/backendSuperAdminAllUsers.php");
		
	    echo "Delete User ".$_REQUEST['u_id'];
		
    } 
	else 
	  {
        //assume btnSubmit
      } 

 

?>