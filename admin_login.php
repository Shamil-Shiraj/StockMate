<?php 
   // Includes the connect file to establish database connection
   require_once('connect.php'); 
?>

<!DOCTYPE html>
<html>
   <head>
      <title>User Log In Page</title>
      <link rel="stylesheet" type="text/css" href="css/styles.css">
   </head>
   <body>
      <!--Navigation Bar-->
      <div class="nav">
         <div class="logo">
            <img class="logoimg" src="images/logo.png" alt="Logo">
            <h1>StockMate</h1>
         </div>
         <div>
            <!--Link for homepage-->
            <ul>
               <li><a href="index.php">Home</a></li>  
            </ul>
         </div>
      </div>
      <!--Main content of the page-->
      <div class="wrapper">
         <h3>Admin Log In</h3>
         <form action="" method="POST">
            <div class="input-box">
               <label>User Name</label>
               <input type="text" name="username" required></td>
            </div>
            <div class="input-box">
               <label>Password</label>
               <input type="password" name="password" required>        
            </div> 
            <input type="submit" value="Log In" name="login">
         </form>
      </div>
   </body>
</html>

<?php
   if (isset($_POST['login'])) 
   {
      // Retrieve the username and password from the POST request
      $username = $_POST['username'];
      $password = $_POST['password'];
      
      // Sanitize user input to prevent SQL injection
      $username = mysqli_real_escape_string($connection, $username);
      $password = mysqli_real_escape_string($connection, $password);
      
      // SQL query to fetch the user with the given username
      $sql = "SELECT * FROM admins WHERE username = '$username'";
      
      // Execute the query
      $result = mysqli_query($connection, $sql);
      
      // Check if the user exists
      if ($result && mysqli_num_rows($result) > 0) 
      {
         // Fetch the user record
         $user = mysqli_fetch_assoc($result);
         
         // Verify the password
         if ($password === $user['password']) 
         {
            // Start the session
            session_start();           
            // Save session username to display in the dashboard 
            $_SESSION['username'] = $username; 
            // Redirect to user dashboard if login credentials are correct
            echo "<script>window.location.href='admin_dashboard.php';</script>";
         }
         else 
         {
            // Incorrect password
            echo "<script>alert('Invalid Password');</script>";
         }
      }       
      else 
      {
         // User not found
         echo "<script>alert('User does not exist');</script>";
      }
   }
?>