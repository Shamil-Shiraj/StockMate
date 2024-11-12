<?php
   // Includes the connect file to establish database connection 
   require_once('connect.php'); 
   
   if(isset($_GET['item_id']))
   {
      // SQL query to delete the selected stock
      $sql = "DELETE FROM stocks WHERE item_id = ".$_GET['item_id'];
      
      // Execute the SQL query
      $result = mysqli_query($connection,$sql);
      
      if($result)
      {
         //echo "Sucessfull";
      }
      else
      {
         echo "Failed";
      }
      // Redirect to the stock management page
      header("Location: stock_manage.php");
   }
?>