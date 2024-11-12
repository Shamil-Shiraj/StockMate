<?php 
   // Includes the connect file to establish database connection
   require_once('connect.php'); 

   if(isset($_GET['user_id']))
   {
      // SQL query to delete user
      $sql = "DELETE FROM users WHERE user_id = ".$_GET['user_id'];

      // Execute the SQL query
      $result = mysqli_query($connection,$sql);
      
      if($result)
      {
         //echo "Sucessful";
      }
      else
      {
         echo "Failed";
      }
      // Redirect to the user management page after deleting the user
      header("Location:user_manage.php");
   }
?>
