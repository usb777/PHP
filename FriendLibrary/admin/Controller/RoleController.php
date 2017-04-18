<?php

 include_once($_SERVER['DOCUMENT_ROOT']."/admin/Model/RoleModel.php");
 
class RoleController 
{  

 private $controllerRole=NULL;
 
 public function __construct()    
     {   
	      $this->controllerRole = new RoleModel();
	 } 
	 
	 
	   public function setControllerRole($controllerRole)
	 {
		 $this->controllerRole=$controllerRole;
	 }	 
      
	 public function getControllerRole()
	 {
		 return $this->controllerRole;
	 }
	 
	/*
	this function take all roles from Model->role
	
	*/ 
	 
    public function getAllRolesFromModel()  
    {  
	  $roles=array();
	  $roles = $this->controllerRole->getAllRoleList();
	  return $roles;
	}

	/*
	this function call to RoleModel and Invoke similiar function, put data to array 
	*/ 
    public function getRoleByIdFromModel($role_id)  
    {  
	  $role=array();
	  $role = $this->controllerRole->getRoleById($role_id);
	  return $role;
	}	
      
   
      
} // class BookModel



?>