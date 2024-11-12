<?php 
   require_once('connect.php'); 
?>

<!DOCTYPE html>
<html>
   <head>
      <link rel="stylesheet" type="text/css" href="css/styles.css">
      <title>User Log In Page</title>
   </head>
   <body>
  <div class="nav">
      <div class="logo">
            <img class="logoimg" src="images/logo.png" alt="Logo">
            <h1>StockMate</h1>
         </div>
         <div>
            <ul>
               <li><a href="index.php">Home</a></li>
           
            </ul>
         </div>
</div>
      <div class="wrapper">
         <h3>User Log In</h3>
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
   if (isset($_POST['login'])) {
    // Retrieve the username and password from the POST request
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Sanitize user input to prevent SQL injection
    $username = mysqli_real_escape_string($connection, $username);
    $password = mysqli_real_escape_string($connection, $password);

    // Create a SQL query to fetch the user with the given username
    $sql = "SELECT * FROM users WHERE username = '$username'";

    // Execute the query
    $result = mysqli_query($connection, $sql);

    // Check if the user exists
    if ($result && mysqli_num_rows($result) > 0) {
        // Fetch the user record
        $user = mysqli_fetch_assoc($result);

        // Verify the password
        if ($password === $user['password']) {
            // Password is correct
            // Start the session
            session_start();
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $username;

            // Update login date and time
            $user_id = $_SESSION['user_id'];
            $login_date = date('Y-m-d');
            $login_time = date('H:i:s');

            $update_sql = "UPDATE users SET login_date = '$login_date', login_time = '$login_time' WHERE user_id = '$user_id'";
            if (mysqli_query($connection, $update_sql)) {
                echo "<script> window.location.href='user_dashboard.php';</script>";
            } else {
                echo "Error updating login time: " . mysqli_error($connection);
            }
        } else {
            // Incorrect password
            echo "<script>alert('Invalid Password');</script>";
        }
    } else {
        // User not found
        echo "<script>alert('User does not exist');</script>";
    }
}
?>
