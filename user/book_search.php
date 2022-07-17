<?php 

include('cookie_checker.php');

if (isset($_GET['book_name'])) {
    include('../db.php');

    $book_name = $_GET['book_name'];

    $sql = "SELECT *
        FROM `books` 
        WHERE `book_name` LIKE '%$book_name%' ";
    $result = mysqli_query($conn, $sql); 
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
    <div class="container">
        <div class="row">
            <div class="col-12">
                <form method="GET">
                    <h2 class="mt-3">Search Result</h2>
                    <div class="form-group mt-3">
                        <div class="input-group mb-3">
                            <input type="text" placeholder="Book Title" class="form-control" name="book_name" value="<?php echo $_GET['book_name']; ?>">
                            <button class="btn btn-info" type="submit" id="button-addon2">Search</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <?php if(isset($_GET['book_name'])) { ?>
            <div class="row">
                <div class="col-12">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">Book ID</th>
                            <th scope="col">Image</th>
                            <th scope="col">Book Name</th>
                            <th scope="col">Author</th>
                            <th scope="col">Issued</th>
                            <th scope="col">Stock</th>
                            <th scope="col">Total</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php
                            
                                while ($row = mysqli_fetch_array($result)) {

                                    echo '<tr class="table-light">';
                                    echo '<td>' . $row['book_id'] . '</th>';
                                    echo '<td> <img src="../images/' . $row['image'] . '" width=50></th>';
                                    echo '<td>' . $row['book_name'] . '</td>';
                                    echo '<td>' . $row['author'] . '</td>';
                                    echo '<td>' . $row['issued'] . '</td>';
                                    echo '<td>' . $row['quantity'] - $row['issued'] . '</td>';
                                    echo '<td>' . $row['quantity'] . '</td>';
                                    echo '</tr>';
                                }
                            
                            ?>
                            
                        </tbody>
                    </table>
                </div>
            </div>
            <?php  } ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
</html>