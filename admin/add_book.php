<?php 
include('cookie_checker.php');

$success = false;
$error = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include('../db.php');

    $book_id = $_POST['book_id']; 
    $book_name = $_POST['book_name'];
    $author = $_POST['author'];
    $quantity = $_POST['quantity'];
    $image = $book_id . '_' . $_FILES['image']['name'];
    $target = "../images/".basename($image);


    $sql = "INSERT INTO `books` (`book_id`, `book_name`, `author`, `quantity`, `issued`, `image`)
    VALUES ('$book_id', '$book_name', '$author', $quantity, 0, '$image')";

    if(mysqli_query($conn, $sql)) {
        $success = true;
    } else {
        $error = true;
    }

    mysqli_close($conn);

    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        $success = true;
    } else{
        $error = true;
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
                                        <p class='mb-0'>Book Added!</p>
                                      </div>";
                            } 
                            
                            if($error) {
                                echo "<div class='alert alert-dismissible alert-primary'>
                                        <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                                        <p class='mb-0'>Unable to add book!</p>
                                      </div>";
                            } 
                            
                            ?>
                            
                            <h2 class="text-center mb-3">Add Book</h2>
                            <form method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label class="form-label">Image</label>
                                    <input type="file" name="image" class="form-control mb-2" placeholder="User Image" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Book ID</label>
                                    <input type="text" name="book_id" class="form-control mb-2" placeholder="Book ID" >
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Book Name</label>
                                    <input type="text" name="book_name" class="form-control mb-2" placeholder="Book Name" >
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Author</label>
                                    <input type="text" name="author" class="form-control mb-2" placeholder="Author" >
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Quantity</label>
                                    <input type="number" name="quantity" class="form-control mb-2" placeholder="Quantity" >
                                </div>
                                <div class="text-center mt-4">
                                    <button class="btn btn-primary">Add Book</button>
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