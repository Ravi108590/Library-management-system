<?php 

include('cookie_checker.php');

// Declare vars
$student_exists = false;
$book_exists = false;
$success = false;
$error = false;
$error_msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include('../db.php');

    // Get data from POST request
    $id = $_POST['id'];
    $book_id = $_POST['book_id'];

    // Check if student exists
    $sql = "SELECT * FROM `users` where `id` = '$id';";  
    $result = mysqli_query($conn, $sql); 
    if(mysqli_num_rows($result)) {
        $student_exists = true;
    } else {
        $error = true;
        $error_msg = "User ID or Book ID mismatch!";
    }

    // Check if book exists
    $sql = "SELECT * FROM `books` where `book_id` = '$book_id';";  
    $result = mysqli_query($conn, $sql); 
    if(mysqli_num_rows($result)) {
        $book_exists = true;
    } else {
        $error = true;
        $error_msg = "Student ID or Book ID mismatch!";
    }
    

    // Check if student has limit
    $sql = "SELECT COUNT(*) FROM `issue` where `borrower_id` = '$id' AND `date_returned` IS NULL;";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_fetch_array($result);
    $book_count = $count[0];

    if($book_count >= 3) {
        $error = true;
        $error_msg = "Borrowing limit reached. ";
    }

    // Issue book
    if ($student_exists && $book_exists && $book_count < 3) {

        $issue_book = "INSERT
        INTO `issue` (`book_id`, `borrower_id`, `issue_date`, `return_date`, `date_returned`, `fine`)
        VALUES ('$book_id', '$id', current_timestamp(), current_timestamp() + INTERVAL 14 DAY, null, 0);";

        $increment = "UPDATE `books` 
        SET `issued` = issued + '1' 
        WHERE `book_id` = '$book_id';";
    
        if(mysqli_query($conn, $issue_book) && mysqli_query($conn, $increment)) {
            $success = true;
        } else {
            $error = true;
            $error_msg = "Unknown Error";
        }
    }

}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://bootswatch.com/5/quartz/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
    
    <?php require_once('nav.php') ?>

    <section class="" style="background-color: #508bfc;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card shadow-2-strong" style="border-radius: 1rem;">
                        <div class="card-body p-5">
                            <?php 
                                if($success) {
                                    echo "<div class='alert alert-dismissible alert-success'>
                                        <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                                        <p class='mb-0'>Book Issued</p>
                                    </div>";
                                } elseif($error) {
                                    echo "<div class='alert alert-dismissible alert-danger'>
                                        <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                                        <p class='mb-0'>" . $error_msg . "</p>
                                    </div>";
                                }
                            ?>
                            <h2 class="text-center mb-3">Issue Book</h2>
                            <form method="POST" action="">
                                <div class="form-group">
                                    <label class="form-label">User ID</label>
                                    <input type="number" name="id" class="form-control mb-2" placeholder="Student ID" >
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Book ID</label>
                                    <input type="text" name="book_id" class="form-control mb-2" placeholder="Book ID" >
                                </div>
                                <div class="text-center mt-4">
                                    <button class="btn btn-primary">Issue</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
</html>