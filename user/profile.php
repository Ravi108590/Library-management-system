<?php

$id = $_COOKIE['id'];

    // Get user image
    include('../db.php');

    $sql = "SELECT * 
    FROM `users`
    WHERE `id` = '$id'
        ";
    $data  = mysqli_fetch_array(mysqli_query($conn, $sql));

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
    
    <div class="container mb-3">
        <div class="row">
            <div class="col-12">
            <h2 class="mt-2">Profile</h2>
                <form action="" method="post">
                    
                    <div class="form-group">
                        <img src="../images/<?php echo $data['image'] ?>" width=150 alt="">
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">ID</label>
                        <input value="<?php echo $data['id'] ?>" type="number" name="id" class="form-control mb-2" placeholder="User ID" disabled>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Name</label>
                        <input value="<?php echo $data['name'] ?>" type="text" name="name" class="form-control mb-2" placeholder="Name" disabled>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Father Name</label>
                        <input value="<?php echo $data['fathers_name'] ?>" type="text" name="fathers_name" class="form-control mb-2" placeholder="Father Name" disabled>
                    </div>
                    <?php
                        if($data['user_type'] == 'student') {
                            echo '<div class="form-group">
                                    <label class="form-label">Course</label>
                                    <input value="'.$data['course'].'" type="text" name="course" class="form-control mb-2" placeholder="Course" disabled>
                                </div>';
                            echo '<div class="form-group">
                                    <label class="form-label">Section</label>
                                    <input value="'.$data['section'].'" type="text" name="course" class="form-control mb-2" placeholder="Course" disabled>
                                </div>';
                            echo '<div class="form-group">
                                    <label class="form-label">Semester</label>
                                    <input value="'.$data['semester'].'" type="text" name="course" class="form-control mb-2" placeholder="Course" disabled>
                                </div>';
                        }
                    ?>
                    <div class="form-group">
                        <label class="form-label">Department</label>
                        <input value="<?php echo $data['department'] ?>" type="text" name="department" class="form-control mb-2" placeholder="Department" disabled>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
</html>