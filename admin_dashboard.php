<?php 
   // Includes the connect file to establish database connection
   require_once('connect.php');

   session_start();

   // Retreiving username for welcome greeting
   $username = $_SESSION['username'];
   
   // Execute the code if user clicks the add user button
   if(isset($_POST['add_user']))
   {
      // Retrieve the role from POST method
      $role = $_POST['role'];

      // If role is user, execute this code
      if ($role === 'user') 
      {  
         // SQL query to insert data into users table
         $sql = "INSERT INTO users (username, password) VALUES ('".$_POST['username']."','".$_POST['password']."')";
      }
 
      // If role is admin, execute this code
      elseif ($role === 'admin') 
      {
         // SQL query to insert data into admins table
         $sql = "INSERT INTO admins (username, password) VALUES ('".$_POST['username']."','".$_POST['password']."')";
      }
      
      // Execute the SQL query
      $result = mysqli_query($connection,$sql);
      
      if($result)
         echo"<script> alert('Registered Sucessfully') </script>";
      else
         echo"failed";
   }
?>

<!DOCTYPE html>
<html>
   <head>
      <link rel="stylesheet" type="text/css" href="css/styles.css"/> 
      <title>Admin Dashboard</title>
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
         <h1>Admin Dashboard</h1>
         <h2>Welcome, <?php echo ($username); ?>!</h2>
         <!-- User Management Section -->
         <div>
            <h3>Add New User</h3>
            <form action='' method="POST">
               <div class="form-group">
                  <label for="userName">User Name:</label>
                  <input type="text" name="username" required>
               </div>
               <div class="form-group">
                  <label for="password">Password:</label>
                  <input type="password" name="password" required>
               </div>
               <div class="form-group">
                  <label for="role">Role:</label>
                  <select name="role" required>
                     <option value="admin">Admin</option>
                     <option value="user">User</option>
                  </select>
               </div>
               <div class="add-btn">
                  <input type="submit" name='add_user' value="Add User">
               </div>
            </form>
         </div>
      </div>
      <!--Admin details table-->
      <div class="container">
         <?php
            // SQL query to retrieve data from the admins table from the database
            $sql = "SELECT * FROM admins";
            
            // Execute the SQL query
            $result = mysqli_query($connection,$sql);
         ?>
         <h2>Existing Admins</h2>
         <table>
            <tr>
               <th>Admin ID</th>
               <th>User Name</th>
               <th>Password</th>
            </tr>
            <?php
               while($row=mysqli_fetch_assoc($result)){
            ?>		
            <tr>
               <td><?php echo $row['admin_id'] ?></td>
               <td><?php echo $row['username'] ?></td>
               <td><?php echo $row['password'] ?></td>
            </tr>
            <?php } ?>
         </table>
      </div>
   </body>
</html>
