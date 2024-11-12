<?php 
   // Includes the connect file to establish database connection
   require_once('connect.php'); 
    
   // SQL query to retrieve data from the stock table from the database
   $sql = "SELECT * FROM stocks";
   
   // Execute the SQL query
   $result = mysqli_query($connection,$sql);
   
   // Check if the SQL query is successful
   if($result)
   {
      //echo "Sucessful";
   }
   else
   {
      echo "failed";	
   }
?>

<!DOCTYPE html>
<html>
   <head>
      <link rel="stylesheet" type="text/css" href="css/styles.css" /> 
      <title>Stock Management</title>
   </head>
   <body>
      <!--Navigation Bar-->
      <div class="nav">
         <div class="logo">
            <img class="logoimg" src="images/logo.png" alt="Logo">
            <h1>StockMate</h1>
         </div>
         <div>
            <!--Links for other pages-->
            <ul>
               <li><a href="user_dashboard.php">Dashboard</a></li>
               <li><a href="stock_manage.php">Stock Management</a></li>
               <li><a href="user_help.php">Help</a></li>
               <li><a href="user_logout.php">Log Out</a></li>
            </ul>
         </div>
      </div>
      <!--Main content of the page-->
      <div class="container">
         <h1>Manage Stocks</h1>
         <table>
            <tr>
               <th>Item ID</th>
               <th>Stock Type</th>
               <th>Category</th>
               <th>Quantity</th>
               <th>Actions</th>
            </tr>
            <?php
               while($row=mysqli_fetch_assoc($result)){
            ?>		
            <tr>
               <td><?php echo $row['item_id'] ?></td>
               <td><?php echo $row['stock_type'] ?></td>
               <td><?php echo $row['category'] ?></td>
               <td><?php echo $row['quantity'] ?></td>
               <td>
                  <div class="btn">
                  <?php echo "<a href =stock_edit.php?item_id='".$row['item_id']."' >Edit item</a>
                  <a href =stock_delete.php?item_id='".$row['item_id']."' >Delete item</a>"?></div >
               </td>
            </tr>
            <?php } ?>
         </table>
         <div class="add-btn">
            <a href="stock_add.php">Add New Stock</a>
         </div>
      </div>
   </body>
</html>