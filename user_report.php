<?php require_once('connect.php'); ?>

<!DOCTYPE html>
<html>
<head>
    <title>User Activity Log</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>
<div class="container">
    <h1><center>User Activity Log</center></h1>
    <table border="1" padding="0px">
        <tr>
            <th>ID</th>
            <th>User Name</th>
            <th>Password</th>
            <th>Log in Date</th>
            <th>Log in Time</th>
        </tr>
        <?php
        $sql = "SELECT * FROM users";
        $result = mysqli_query($connection, $sql);

        if($result){
            while($row = mysqli_fetch_assoc($result)){
                ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['user_id']); ?></td>
                    <td><?php echo htmlspecialchars($row['username']); ?></td>
                    <td><?php echo htmlspecialchars($row['password']); ?></td>
                    <td><?php echo htmlspecialchars($row['login_date']); ?></td>
                    <td><?php echo htmlspecialchars($row['login_time']); ?></td>
                </tr>
                <?php
            }
        } else {
            echo "Failed to retrieve data";
        }
        ?>
    </table>
</body>
</html>
