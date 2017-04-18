                 // delete file from User
            function getDeleteConfirmationUserBook(b_id)
			{
               var path = window.location.protocol+"//"+window.location.host+"/admin/";
				
                var retVal = confirm("Do you want to DELETE this book? book_id="+b_id);
                
				if( retVal == true )
				{
                   window.location=path+"Controller/BooksController.php?b_id="+b_id+"&action=deleteBookByUser";
                   return true;
                }
                else
				    {                   
                      return false;
                    }
             }
            
		   
		   
		 /* this function ask about delete Book, from admin*/
            function getdeleteBookConfirmationSA(b_id)
            {
				 var path = window.location.protocol+"//"+window.location.host+"/admin/";
				
                var retVal = confirm("Do you want to DELETE this book? book_id="+b_id);
                if( retVal == true ){
                   window.location=path+"Controller/BooksController.php?b_id="+b_id+"&action=deleteBookByAdmin";
                   return true;
                }
                else
				    {
                   
                      return false;
                    }
             } // end of function
       
    
      
            
            
            /* this function ask about delete User info, from admin*/
            function getdeleteUsersConfirmationSA(user_id)
            {
				 var path = window.location.protocol+"//"+window.location.host+"/admin/";
				
                var retVal = confirm("Do you want to DELETE data of this user ? user_id="+user_id);
                if( retVal == true ){
                   window.location=path+"Controller/UsersController.php?u_id="+user_id+"&action=deleteUser";
                   return true;
                }
                else{
                   // document.write ("User does not want to continue!");
                   return false;
                }
             } // end of function
			 
			 
			 
			   /* this function ask about delete Category info, from admin*/
            function getDeleteCategoriesConfirmation(category_id)
            {
				var path = window.location.protocol+"//"+window.location.host+"/admin/";
				
                var retVal = confirm("Do you want to DELETE category data ? category_id="+category_id);
                if( retVal == true )
				{
                  
             	    window.location=path+"Controller/CategoryController.php?category_id="+category_id+"&action=deleteCategory";
                   return true;
                }
                else{
                   // document.write ("User does not want to continue!");
                   return false;
                }
             } // end of function
			 
			 
        