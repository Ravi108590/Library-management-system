<?php 
    include('cookie_checker.php');
    include('../db.php');
    include('../utils.php');

    $sql = "SELECT *
        FROM `issue` 
        INNER JOIN users 
            ON issue.borrower_id=users.id 
        INNER JOIN books
            ON issue.book_id=books.book_id 
        WHERE `date_returned` IS NULL ";
    $result = mysqli_query($conn, $sql);  

?>

<div class="container">
    <div class="row">
        <div class="col-12">
            <h2 class="mt-2">Books in circulation</h2>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col">Book ID</th>
                    <th scope="col">Book Name</th>
                    <th scope="col">Author</th>
                    <th scope="col">ID</th>
                    <th scope="col">Section</th>
                    <th scope="col">Course</th>
                    <th scope="col">Department</th>
                    <th scope="col">Semester</th>
                    <th scope="col">Issue Date</th>
                    <th scope="col">Return Date</th>
                    <th scope="col">Over days</th>
                    <th scope="col">Fine</th>
                </tr>
                </thead>
                <tbody>
                    <?php
                        while ($row = mysqli_fetch_array($result)) {
                            echo "<tr class='table-light'>";
                            echo '<td>' . $row['book_id'] . '</th>';
                            echo '<td>' . $row['book_name'] . '</td>';
                            echo '<td>' . $row['author'] . '</td>';
                            echo '<td>' . $row['id'] . '</td>';
                            echo '<td>' . $row['section'] . '</td>';
                            echo '<td>' . $row['course'] . '</td>';
                            echo '<td>' . $row['department'] . '</td>';
                            echo '<td>' . $row['semester'] . '</td>';
                            echo '<td>' . $row['issue_date'] . '</td>';
                            echo '<td>' . $row['return_date'] . '</td>';                            
                            echo '<td>' . overDaysFinder($row['returned'], $row['days_remaining']) . '</td>';
                            echo '<td>Tk. ' . fine($row['returned'], $row['days_remaining'], $row['user_type']) . '</td>';
                            echo "</tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>