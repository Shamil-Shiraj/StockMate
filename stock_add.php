<?php 
   // Includes the connect file to establish database connection
   require_once('connect.php');
?>

<!DOCTYPE html>
<html>
   <head>
      <title>Add Stock</title>
      <link rel="stylesheet" type="text/css" href="css/styles.css"/>
   </head>
   <body>
      <!--Main content of the page-->
      <div class="container">
         <h1>Add Stock</h1>
         <form method="POST" action="">
            <label>Stock Type:</label>
            <!-- Product Categories -->
            <select name="stock_type" required>
               <option value="Fruits">Fruits</option>
               <option value="Vegetables">Vegetables</option>
               <option value="Stationery">Stationery</option>
               <option value="Diary">Diary</option>
               <option value="Bakery">Bakery</option>
               <option value="Meat & Seafood">Meat & Seafood</option>
               <option value="Beverages">Beverages</option>
            </select>
            
            <label>Category:</label>
            <select name="category" required>
               <!-- Sub Categories -->
               <option value="Apple">Apple</option>
               <option value="Mango">Mango</option>
               <option value="Carrot">Carrot</option>
               <option value="Radish">Radish</option>
               <option value="Pen">Pen</option>
               <option value="Eraser">Eraser</option>
               <option value="Ice Cream">Ice Cream</option>
               <option value="Fresh Milk">Fresh Milk</option>
               <option value="Cake">Cake</option>
               <option value="Bread">Bread</option>
               <option value="Lamb">Lamb</option>
               <option value="Prawns">Prawns</option>
               <option value="Iced Tea">Iced Tea</option>
               <option value="Cold Coffee">Cold Coffee</option>
               <!-- Add other categories -->
            </select>

            <label>Quantity (in kg or units):</label>
            <input type="number" name="quantity" required>

            <input type="submit" name="add_stock" value="Add Stock">
         </form>
      </div>
   </body>
</html>

<?php
   if(isset($_POST['add_stock']))
   {
      // Retrieve the stock information from the POST request
      $stock_type = $_POST['stock_type'];
      $category = $_POST['category'];
      $quantity = $_POST['quantity'];

      // SQL query to insert new stock information into the database
      $sql = "INSERT INTO stocks (stock_type, category, quantity) VALUES ('$stock_type', '$category', '$quantity')";
      
      // Execute the SQL query
      $result = mysqli_query($connection, $sql);
      
      // Informing the status of the SQL query
      if($result)
      {
         echo "<script>alert('Stock Added Successfully');</script>";
         echo "<script>window.location.href='stock_manage.php';</script>";
      } 
      else 
      {
         echo "<script>alert('Failed to Add Stock');</script>";
      }
   }
?>
