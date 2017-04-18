<?php

 include_once($_SERVER['DOCUMENT_ROOT']."/admin/Model/StatusModel.php");
 
class StatusController 
{  

 private $controllerstatus=NULL;
 
 public function __construct()    
     {   
	      $this->controllerstatus = new StatusModel();
	 } 
	 
	 
	   public function setControllerStatus($controllerstatus)
	 {
		 $this->controllerstatus=$controllerstatus;
	 }	 
      
	 public function getControllerStatus()
	 {
		 return $this->controllerstatus;
	 }
	 
	 
    public function getAllStatusfromModel()  
    {  
	  $status=array();
	  $status = $this->controllerstatus->getAllStatusList();
	  return $status;
	}	
  
/*
	this function call to StatusModel and Invoke similiar function, put data to array 
	*/ 
    public function getStatusByIdFromModel($status_id)  
    {  
	  $status=array();
	  $status = $this->controllerstatus->getStatusById($status_id);
	  return $status;
	}	
  
   
      
} // class BookModel



?>