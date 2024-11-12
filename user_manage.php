<?php 
   // Includes the connect file to establish database connection
   require_once('connect.php');
   
   // SQL query to retrieve data from the stock table from the database
   $sql = "SELECT * FROM users";
   
   // Execute the SQL query
   $result = mysqli_query($connection,$sql);

   // Check if the SQL query is successful
   if($result)
   {
      //echo "Sucessful";
   }
   else
   {
      echo"failed";	
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
               <li><a href="admin_dashboard.php">Dashboard</a></li>
               <li><a href="user_manage.php">User Management</a></li>
               <li><a href="admin_reports.php">Reports</a></li>
               <li><a href="admin_logout.php">Log Out</a></li>
            </ul>
         </div>
      </div>
      <!--Main content of the page-->
      <div class="container">
         <h1>Manage Existing Users</h1>
         <table>
            <tr>
               <th>User ID</th>
               <th>User Name</th>
               <th>Password</th>
               <th>Role</th>
               <th>Actions</th>
            </tr>
            <?php
               while($row=mysqli_fetch_assoc($result)){
            ?>		
            <tr>
               <td><?php echo $row['user_id'] ?></td>
               <td><?php echo $row['username'] ?></td>
               <td><?php echo $row['password'] ?></td>
               <td>User</td>
               <td>
                  <div class="btn">
                     <?php echo "<a href =user_edit.php?user_id='".$row['user_id']."' >Edit User</a>
                        <a href =user_delete.php?user_id='".$row['user_id']."' >Delete User</a>"?>
                  </div>
               </td>  
            </tr>
            <?php } ?>
         </table>
      </div>
   </body>
</html>