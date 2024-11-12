<?php 
   // Includes the connect file to establish database connection
   require_once('connect.php');
   
   session_start();

   // Retreiving username for welcome greeting
   $username = $_SESSION['username'];

   // SQL query to retrieve data from the stock table from the database
   $sql = "SELECT * FROM stocks";
   $result = mysqli_query($connection, $sql);
   
   // Calculating the sum of stocks
   $sql_total = "SELECT SUM(quantity) AS total_stock FROM stocks"; 
   $result_total = mysqli_query($connection, $sql_total);
   $row_total = mysqli_fetch_assoc($result_total);
   $total_stock = $row_total['total_stock'];

   // Calculating the number of low stocks
   $sql_low = "SELECT COUNT(*) AS low_stock_count FROM stocks WHERE quantity < 10";
   $result_low = mysqli_query($connection, $sql_low);
   $row_low = mysqli_fetch_assoc($result_low);
   $low_stock_count = $row_low['low_stock_count'];
?>

<!DOCTYPE html>
<html>
   <head>
      <title>User Dashboard</title>
      <link rel="stylesheet" type="text/css" href="css/styles.css"/>
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
         <h1>Welcome, <?php echo $username; ?>!</h1>
         <div class="dash">
            <p><strong>Total Items in Stock:</strong> <?php echo $total_stock; ?></p>
            <p><strong>Items Running Low:</strong> <?php echo $low_stock_count; ?></p>
         </div>
         <div class="btns">
            <h2>Stock Management</h2>
            <a href="stock_add.php">Add Stock</a>
            <a href="stock_search.php">Search Stock</a>
         </div>
         <h2>Stock Overview</h2>
         <!--Stock Overview table-->
         <table border="1">
            <tr>
               <th>ID</th>
               <th>Stock Type</th>
               <th>Category</th>
               <th>Quantity (kg)</th>
            </tr>
            <?php while($row = mysqli_fetch_assoc($result)){ ?>
            <tr>
               <td><?php echo $row['item_id']; ?></td>
               <td><?php echo $row['stock_type']; ?></td>
               <td><?php echo $row['category']; ?></td>
               <td><?php echo $row['quantity']; ?></td>
            </tr>
            <?php } ?>
         </table>
      </div>
   </body>
</html>