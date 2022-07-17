<?php 

    include('cookie_checker.php'); 
    include('../utils.php');

    $id = $_COOKIE['id'];

    // Currently issued books
    include('../db.php');

    $sql = "SELECT * 
    FROM `issue`
    INNER JOIN `users`
        ON `issue`.borrower_id=`users`.`id`
    INNER JOIN books
        ON `issue`.book_id=`books`.book_id 
    WHERE `borrower_id` = '$id' AND `date_returned` IS NULL 
        ";
    $current = mysqli_query($conn, $sql); 
    $notification = $current;
    // Issue History
    $sql = "SELECT * 
        FROM `issue`
        INNER JOIN books
            ON issue.book_id=books.book_id 
        WHERE `borrower_id` = '$id' AND `date_returned` IS NOT NULL ";
    $history = mysqli_query($conn, $sql); 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="../assets/styles/user.css" rel="stylesheet" />
    <link href="https://bootswatch.com/5/quartz/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="body">

    <?php require_once('nav.php') ?>

    <div class="container mt-3">
        <div class="row">
            <div class="col-12">

            <?php 

                foreach($current as $row) {
                        if($row['days_remaining']<=3 && $row['days_remaining'] > 0) {
                            echo '<div class="alert alert-warning">
                            <p class="mb-0">' . $row['book_name'] . ' by E. Balagurusamy due in ' . $row['days_remaining'] . ' days.</p>
                        </div>';
                        } elseif($row['days_remaining'] < 0) {
                            echo '<div class="alert alert-dismissible alert-primary">
                            <p class="mb-0">' . $row['book_name'] . ' by ' . $row['author'] . ' was due ' . abs($row['days_remaining']) . ' day ago. </p>
                        </div>';
                        }
                }
            ?>
            </div>
        </div>
    </div>

    <?php require_once('search.php') ?>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="mt-2">Books currently issued to me</h2>
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col">Book ID</th>
                        <th scope="col">Book Name</th>
                        <th scope="col">Author</th>
                        <th scope="col">Issue Date</th>
                        <th scope="col">Return Date</th>
                        <th scope="col">Remaining Time</th>
                        <th scope="col">Fine</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php

                        foreach($current as $row) {
                            echo '<tr class="table-light">';
                            echo '<td>' . $row['book_id'] . '</th>';
                            echo '<td>' . $row['book_name']; isLate($row['days_remaining']) . '</td>';
                            echo '<td>' . $row['author'] . '</td>';
                            echo '<td>' . $row['issue_date'] . '</td>';
                            echo '<td>' . $row['return_date'] . '</td>';
                            echo '<td>' . $row['days_remaining'] . '</td>';
                            echo '<td>' . fine($row['returned'], $row['days_remaining'], $row['user_type']) . '</td>';
                            echo '</tr>';
                        }
                                                
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="container mb-2">
        <div class="row">
            <div class="col-12">
            <h2 class="mt-2">My issue history</h2>
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col">Book ID</th>
                        <th scope="col">Book Name</th>
                        <th scope="col">Author</th>
                        <th scope="col">Issue Date</th>
                        <th scope="col">Return Date</th>
                        <th scope="col">Date Returned</th>
                        <th scope="col">Fine</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        while ($row = mysqli_fetch_array($history)) {

                            echo '<tr class="table-light">';
                            echo '<td>' . $row['book_id'] . '</th>';
                            echo '<td>' . $row['book_name'] . '</td>';
                            echo '<td>' . $row['author'] . '</td>';
                            echo '<td>' . $row['issue_date'] . '</td>';
                            echo '<td>' . $row['return_date'] . '</td>';
                            echo '<td>' . $row['date_returned'] . '</td>';
                            echo '<td>' . $row['fine'] . '</td>';
                            echo '</tr>';
                        }
                    ?>
                    </tbody>
                </table>
            <a class="btn btn-sm btn-primary" href="export_history.php">Export History</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
</html>