<?php

include('../db.php');
$error = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $password = md5($_POST['password']);

    $sql = "select * from admin where id = '$id' and password = '$password'";  

    $result = mysqli_query($conn, $sql);  
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
    $count = mysqli_num_rows($result);  

    if( $count == 1 ) {
        
        header("Location: ../admin");
        setcookie("type", "admin", time() + (86400 * 30), "/"); // 86400 = 1 day

    } else {
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

    <section class="vh-100  mb-3" >
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card shadow-2-strong" style="border-radius: 1rem;">
                <div class="card-body p-5 text-center">
                    <h2 class="mb-4">Admin Sign in</h2>

                    <form method="POST" action="">
                        
                        <?php if($error) {
                            echo "<div class='alert alert-primary mb-3'>
                                    <p class='mb-0' style='text-align: left;'>Invalid Login Details</p>
                                </div>";
                            } 
                        ?>

                        <div class="form-group">
                        <div class="input-group mb-3">
                            <span class="input-group-text">User ID</span>
                            <input type="text" name="id" class="form-control" aria-label="Amount (to the nearest dollar)">
                        </div>
                        </div>
                        
                        <div class="form-group">
                        <div class="input-group mb-3">
                            <span class="input-group-text">Password</span>
                            <input type="password" name="password" class="form-control" aria-label="Amount (to the nearest dollar)">
                        </div>
                        </div>
            
                        <button class="btn btn-primary btn-block" type="submit">Login</button>
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