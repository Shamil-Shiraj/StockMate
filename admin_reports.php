<?php require_once('connect.php'); ?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin - Stock Management System</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css" />

    <!-- jQuery to generate calender-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        window.jQuery || document.write('<script src="js/jquery-3.6.0.min.js"><\/script>');
    </script>

    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script>
        window.jQuery.ui || document.write('<script src="js/jquery-ui.min.js"><\/script>');
    </script>

    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <noscript><link rel="stylesheet" href="css/jquery-ui.min.css"></noscript>

    <script>
        $(function() {
            $("#filterDate").datepicker({ dateFormat: 'yy-mm-dd' });
        });
    </script>
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
    <h2><center>Reports</center></h2>
    <h3>Generate and View Reports</h3>
    <!-- Get the current date by generate_report.php -->
    <form method="POST" action="generate_report.php">
        <div class="form-group">
            <label for="reportType">User Activity Log</label>
        </div>
        <input type="submit" value="Generate Report">
    </form>
    <!-- Date Filtering Option -->
    <form method="GET" action="admin_reports.php">
        <br/><br/>
        <label for="filterDate">Filter by Date:</label>
        <input type="text" id="filterDate" name="filterDate" value="<?= isset($_GET['filterDate']) ? htmlspecialchars($_GET['filterDate']) : '' ?>">
        <input type="submit" value="Filter">
    </form>
    <!-- Report Table -->
    <h3>Recent Reports</h3>
    <table border="1">
        <tr>
            <th>Date Generated</th>
            <th>Actions</th>
        </tr>

        <?php
            // Get the selected date from the form
            $filterDate = isset($_GET['filterDate']) ? $_GET['filterDate'] : '';

            $sql = "SELECT id, date_generated FROM reports WHERE 1=1";

            if (!empty($filterDate)) {
                $sql .= " AND DATE(date_generated) = '$filterDate'";
            } else {
                // Limit to 10 rows
                $sql .= " ORDER BY date_generated DESC LIMIT 10";
            }

            $result = $connection->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['date_generated']) . "</td>";
                    echo "<td>";
                    echo "<button onclick=\"window.location.href='user_report.php?reportId=" . htmlspecialchars($row['id']) . "'\">View</button>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No reports found.</td></tr>";
            }
        ?>
    </table>
</div>

<script>
    function viewReport(reportType) {
        alert('Viewing report: ' + reportType);
    }
</script>

</body>
</html>
