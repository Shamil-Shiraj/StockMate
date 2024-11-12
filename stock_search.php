<?php 
   // Includes the connect file to establish database connection
   require_once('connect.php'); 
?>

<!DOCTYPE html>
<html>
   <head>
      <link rel="stylesheet" type="text/css" href="css/styles.css"/>
      <title>Search Stock</title>
   </head>
   <body>
      <!--Main content of the page-->
      <div class="container">
         <h1>Search Stock</h1>
         <form action="" method="POST">
         <div class="form-group">
            <label for="search">Enter Item Name:</label>
            <input type="text" name="search" required>
         </div>
         <input type="submit" name="search_stock" value="Search">
      </form>

      <?php
         if (isset($_POST['search_stock'])) 
         {
            // Retrieve the user search stock from the POST request
            $search = $_POST['search'];

            // Sanitize user input to prevent SQL injection
            $search = mysqli_real_escape_string($connection, $search);

            // SQL query to fetch the user search stock
            $sql = "SELECT * FROM stocks WHERE category LIKE '%$search%'";

            // Execute the SQL query
            $result = mysqli_query($connection, $sql);

            // If search stock data exists, execute the following code 
            if (mysqli_num_rows($result) > 0) 
            {
               // Create table rows with HTML
               echo "<table>
                        <thead>
                           <tr>
                              <th>Item ID</th>
                              <th>Stock type</th>
                              <th>Category</th>
                              <th>Quantity</th>
                           </tr>
                        </thead>
                     <tbody>";
            
               // Retrieve search stock data from the database
               while ($row = mysqli_fetch_assoc($result)) 
               {
                  echo "<tr>";
                  echo "<td>" . $row['item_id'] . "</td>";
                  echo "<td>" . $row['stock_type'] . "</td>";
                  echo "<td>" . $row['category'] . "</td>";
                  echo "<td>" . $row['quantity'] . "</td>";
                  echo "</tr>";
               }
               echo "</tbody>
                     </table>";
           }
            // Display this message if the search stock data does not exist
            else 
            {
               echo "<p>No items found matching your search.</p>";
            }
         }
      ?>
      </div>
   </body>
</html>
