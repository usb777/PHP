  <div id="sidebar_container">
	    <div class="sidebar">
		 
          <?php
		   
			 if (isset($_COOKIE["cookie_username"])) 
	        {
		      $_SESSION["login"] = $_COOKIE["cookie_username"];
			  //$_SESSION["u_id"] = $_COOKIE["cookie_userid"];
	        } 
			
			
			if  (!isset($_SESSION["login"]))    // if user is not logined
			{ 
		  ?>		 
		  
		  <h3>Sign In</h3>		
         <form method="get" action="login.php">
		 <div class="login">
		 <table bgcolor="#DDDDDD">  <!--// 00FF00 //-->
		 <tr>
		   <td> 
		   
		      <label for="login">Login</label><br>
			  <input type="text" name="login"  class="contact"><br><br>
			   <label for="passw">Password</label><br>
			   <input type="password" name="passw"  class="contact">
			   
			</td>
			
		<td> 
		<button id="bar" type="submit"> <img src="images/go1.png" alt="Mountain View" style="width:40px;height:40px;" ></button>
	     <!-- <div align="right" style="padding-top:5px;"> <img src="images/go.png" alt="Mountain View" style="width:40px;height:30px;" >  </div> -->
	   </td>
		 </tr>
		<tr>
		<td colspan="2">
		  <a href="register.php"> Register </a> | <a href="#"> Facebook SignUp</a>
		</td>
		</tr>
		
		
		</table>
</div>		
		 </form>		 
		 	<?php 
			}
			
			else // if user is logined			
			{ 
				echo"<h3>Welcome</h3>";
				echo "user <b>".$_SESSION["login"]."</b> you logined<br><br>";
				if ($_SESSION["login"]=='admin') 
				 {					
				   echo "Do you want go to <a href='admin/backendSuperAdmin.php'>Admin Panel </a>?<br><br>";
				 }
				 else 
				 {
					 echo "Do you want go to <a href='admin/backend.php'>Admin Panel </a>?<br><br>"; 
				 }
				
				echo "Do you want <a href='admin/logout.php'>log out</a> ?";
			}
			
			?>	 
        </div>  <!--// sidebar Sign In //-->
	  
	  
        <div class="sidebar">
          <h3>Latest News</h3>
          <h4>New Website Launched</h4>
          <h5>January 12th, 2017</h5>
          <p>2017 sees the redesign of our website. <a href="#">Read more</a></p>
        </div>
		
				
        <div class="sidebar">
          <h3>Useful Links</h3>
          <ul>
            <li><a href="http://www.hongkiat.com/blog/20-best-websites-to-download-free-e-books/" target="new">20 Best Websites To Download Free EBooks</a></li>
            <li><a href="https://www.readanybook.com/" target="new">Read Any Book</a></li>
            <li><a href="#"  target="new">And Another</a></li>
            <li><a href="#"  target="new">Last One</a></li>
          </ul>
        </div>
        <div class="sidebar">
          <h3>More Useful Links</h3>
          <ul>
            <li><a href="#" target="new">First Link</a></li>
            <li><a href="#" target="new">Another Link</a></li>
            <li><a href="#" target="new">And Another</a></li>
            <li><a href="#" target="new">Last One</a></li>
          </ul>
        </div>
      </div>     <!--// sidebar_container   //-->
	