<?php 
   // Includes the connect file to establish database connection
   require_once('connect.php'); 

   if (isset($_GET['item_id'])) 
   {
      // Get the select item id from GET method
      $item_id = $_GET['item_id'];

      // SQL query to select the desired item from the stocks table
      $sql = "SELECT * FROM stocks WHERE item_id = $item_id";
      
      // Execute the SQL query
      $result = mysqli_query($connection, $sql);

      // Fetch the single row of the desired item
      $item = mysqli_fetch_assoc($result);
      
      
      if (isset($_POST['update_stock'])) 
      {
         // Get the category and quantity values from the POST method
         $category = $_POST['category'];
         $quantity = $_POST['quantity'];
         
         // SQL query to update the selected item
         $sql_update = "UPDATE stocks SET category='$category', quantity='$quantity' WHERE item_id=$item_id";

         // Execute the SQL query
         mysqli_query($connection, $sql_update);

         // Redirect to the stock management page after updating the stock
         header("Location: stock_manage.php");
      }
   }
?>
<!DOCTYPE html>
<html>
   <head>
      <link rel="stylesheet" type="text/css" href="css/styles.css"/>
      <title>Edit Stock</title>
   </head>
   <body>
      <!--Main content of the page-->
      <div class="container">
         <h1>Edit Stock</h1>
         <form action="" method="POST">
            <div class="form-group">
               <label>Item Name:</label>
               <input type="text" name="category" value="<?php echo $item['category']; ?>" required>
            </div>
            <div class="form-group">
               <label>Quantity:</label>
               <input type="number" name="quantity" value="<?php echo $item['quantity']; ?>" required>
            </div>
            <input type="submit" name="update_stock" value="Update Stock">
         </form>
      </div>
   </body>
</html>