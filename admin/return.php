<?php 

include('cookie_checker.php');
$success = false;
$error = false;
$error_msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include('../db.php');

    $id = $_POST['id'];
    $book_id = $_POST['book_id'];
    $fine = $_POST['fine'];

    $sql = "SELECT * FROM `issue` WHERE `borrower_id` = '$id' AND `book_id` = '$book_id' AND `date_returned` IS NULL;";  
    $result = mysqli_query($conn, $sql); 

    if(mysqli_num_rows($result)) {

        $return_book = "UPDATE `issue` 
        SET `date_returned` = current_timestamp(), `fine` = '$fine' 
        WHERE `borrower_id` = '$id' AND `book_id` = '$book_id' AND `date_returned` IS NULL;";

        $decrement = "UPDATE `books` 
        SET `issued` = issued - '1' 
        WHERE `book_id` = '$book_id';";

        if(mysqli_query($conn, $return_book) && mysqli_query($conn, $decrement)) {
            $success = true;
        } else {
            $error = true;
            $error_msg = "Unable to make return entry";
        }

    } else {
        $error = true;
        $error_msg = "Invalid Data!";
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
                                            <p class='mb-0'>Return Successful!</p>
                                        </div>";
                                    } elseif($error) {
                                        echo "<div class='alert alert-dismissible alert-danger'>
                                            <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                                            <p class='mb-0'>" . $error_msg . "</p>
                                        </div>";
                                    }
                                ?>
                            <h2 class="text-center mb-3">Return Book</h2>
                            <form method="POST" action="">
                                <div class="form-group">
                                    <label class="form-label">User ID</label>
                                    <input type="number" name="id" class="form-control mb-2" placeholder="User ID" >
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Book ID</label>
                                    <input type="text" name="book_id" class="form-control mb-2" placeholder="Book ID" >
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Fine</label>
                                    <input type="number" name="fine" class="form-control mb-2" value="0" placeholder="Fine" >
                                </div>
                                <div class="text-center mt-4">
                                    <button class="btn btn-primary">Return</button>
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