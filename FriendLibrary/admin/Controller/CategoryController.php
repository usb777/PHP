<?php

 include_once($_SERVER['DOCUMENT_ROOT']."/admin/Model/CategoryModel.php");
 
class CategoryController 
{  

 private $controllercategories=NULL;
 
 public function __construct()    
     {   
	      $this->controllercategories = new CategoryModel();
	 } 
	 
	 
	   public function setControllerCategories($controllercategories)
	 {
		 $this->controllercategories=$controllercategories;
	 }	 
      
	 public function getControllerCategories()
	 {
		 return $this->controllercategories;
	 }
	 
/*
This function return all categories from CategoryModel
*/	 
    public function getAllCategoriesfromModel()  
    {  
	  $categories=array();
	  $categories = $this->controllercategories->getAllCategory();
	  return $categories;
	}	
 
/*
This function return one category from CategoryModel by ID
*/	  
   public function getCategoryByIdFromModel($category_id)  
    {  
	  $category=array();
	  $category = $this->controllercategories->getCategoryById($category_id);
	  return $category;
	}



/*
Insert user data by ADMINISTRATOR
*/
    public function insertCategoryByAdmin($cb_name)
	{
		 $this->controllercategories->insertCategoryByAdmin($cb_name);
		 
		// $this->usersmodel->test();
	}
/*
Update category data by ADMINISTRATOR
*/
    public function updateCategoryByAdmin($cb_id, $cb_name)
	{
		 $this->controllercategories->updateCategoryByAdmin($cb_id, $cb_name);		 
		
	}

	/*
Delete category data by ADMINISTRATOR
*/
    public function deleteCategoryByAdmin($cb_id)
	{
		 $this->controllercategories->deleteCategoryByAdmin($cb_id) ;	
	}


 /*redirect method - send on another page */     
    public function redirect($location)
   {
	
     header('Location: '.$location);	
   }
      
} // class CategoryController	
	
   
      



if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    //something posted

    if (isset($_POST['submCategoryUpdate'])) // update category
	{
        
		
		session_start();
	    $_SESSION["reportUpdateCategory"] ="<font color='red'>Update of category's data was suseccefull</font><br><br>";
	
		$categorycontroller  = new CategoryController();
		$categorycontroller->updateCategoryByAdmin($_REQUEST['category_id'], $_REQUEST['category_name']);
				
		//$_SESSION["login"] = $_REQUEST['login']; // Just in cause change value of the --Session[LOGIN] -variable
		
		$categorycontroller->redirect("../backendSuperAdminAllCategories.php");
		
    } 
	else 
	  {
        //assume btnSubmit
      }
	  
	  
	  
	  if (isset($_POST['submCategoryInsert'])) // update category
	{
        
		
		session_start();
	    $_SESSION["reportInsertCategory"] ="<font color='red'>Insert of category's data was suseccefull</font><br><br>";
	
		$categorycontroller  = new CategoryController();
		
		$categorycontroller->insertCategoryByAdmin( $_REQUEST['category_name'] );
				
		//$_SESSION["login"] = $_REQUEST['login']; // Just in cause change value of the --Session[LOGIN] -variable
		
		$categorycontroller->redirect("../backendSuperAdminAllCategories.php");
		
    } 
	else 
	  {
        //assume btnSubmit
      } 
	  
	  
	  

}


if ($_SERVER['REQUEST_METHOD'] === 'GET') 
{  

     if (isset($_REQUEST['category_id'])&&($_REQUEST['action']=='deleteCategory') ) //Update User from Admin
	{
        // Array ( [category_id] => 1 [action] => deleteCategory ) 
		
		session_start();
		
		$categorycontroller  = new CategoryController();
		$categorycontroller->deleteCategoryByAdmin($_REQUEST['category_id']);
				
		
		
		$categorycontroller->redirect("../backendSuperAdminAllCategories.php");
		
    } 
	else 
	  {
        //assume btnSubmit
      } 

}

?>