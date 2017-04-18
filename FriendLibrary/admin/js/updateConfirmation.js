/* this function ask about update BOOK info, from User*/    
        function getUpdateConfirmationUserBook(b_id)
		{      
		       var path = window.location.protocol+"//"+window.location.host+"/admin/";
			   
               var retVal = confirm("Do you want UPDATE this book info ? book id="+b_id);
               if( retVal == true )
			   {
                  window.location=path+"backendUpdateBook.php?b_id="+b_id+"&action=updateBookByUser";
            	  
                  return true;
               }
               else
			   {
                 
                  return false;
               }
            }   // end of function




/* this function ask about update BOOK info, from SUPER admin*/    
        function getUpdateConfirmationUserBookSA(b_id)
		{      
		       var path = window.location.protocol+"//"+window.location.host+"/admin/";
			   
               var retVal = confirm("Mr.Admin, Do you want UPDATE this book info ? book id="+b_id);
               if( retVal == true )
			   {
                  window.location=path+"backendSAUpdateBook.php?b_id="+b_id+"&action=updateBookByAdmin";
            	  
                  return true;
               }
               else{
                 
                  return false;
               }
            }   // end of function
       
       
       
    /* this function ask about update User info, from admin*/
            function getUpdateUsersConfirmationSA(user_id)
            { 
			    var path = window.location.protocol+"//"+window.location.host+"/admin/";
				
                var retVal = confirm("Do yoU want to UPDATE data of this user ? user_id="+user_id);
                
				if( retVal == true ){
                  
             	   window.location=path+"backendSAUpdateUser.php?u_id="+user_id+"&action=updateUser";
                   return true;
                }
                else{
                
                   return false;
                }
             } // end of function
            
            
            
            /* this function ask about update Category info, from admin*/
            function getUpdateCategoriesConfirmation(category_id)
            {
				
				var path = window.location.protocol+"//"+window.location.host+"/admin/";
				
                var retVal = confirm("Do you want to UPDATE category data ? category_id="+category_id);
                if( retVal == true ){
                  
             	   window.location=path+"backendSAUpdateInsertCategory.php?category_id="+category_id+"&action=updateCategory";
                   return true;
                }
                else{
                  
                   return false;
                }
             } // end of function
            