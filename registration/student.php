<?php

$success = false;
$error = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include('../db.php');

    $id = $_POST['id'];
    $name = $_POST['name'];
    $fathers_name = $_POST['fathers_name'];
    $course = $_POST['course'];
    $section = $_POST['section'];
    $department = $_POST['department'];
    $semester = $_POST['semester'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $image = $id . '_' . $_FILES['image']['name'];
    $target = "../images/".basename($image);


        if($password === $confirm_password) {
            $sql = "INSERT INTO `users` (`id`, `name`, `fathers_name`, `course`, `section`, `department`, `semester`, `user_type`, `password`, `image`) VALUES ('$id', '$name', '$fathers_name', '$course', '$section', '$department', '$semester', 'student', MD5('$password'), '$image');";
    
            if(mysqli_query($conn, $sql)) {
                $success = true;
            } else {
                $error = true;
            }
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

<section class="vh-100">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card shadow-2-strong" style="border-radius: 1rem;">
                    <div class="card-body p-5">
                        <?php 
                            if($success) {
                                echo '<div class="alert alert-dismissible alert-success">
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                <h4 class="alert-heading">Great Initiative!</h4>
                                <p class="mb-0">You have successfully created the account.</p>
                            </div>';
                            } elseif($error) {
                                echo '<div class="alert alert-dismissible alert-primary">
                                <p class="mb-0">Unable to create account!</p>
                            </div>';
                            }
                        ?>
                        <h2 class="text-center mb-3">Create Student Account</h2>
                        <form method="POST" action="" enctype="multipart/form-data">
                            <div class="form-group">
                                <label class="form-label">Image</label>
                                <input type="file" name="image" class="form-control mb-2" placeholder="User Image" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">ID</label>
                                <input type="number" name="id" class="form-control mb-2" placeholder="User ID" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Name</label>
                                <input type="text" name="name" class="form-control mb-2" placeholder="Name" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Father Name</label>
                                <input type="text" name="fathers_name" class="form-control mb-2" placeholder="Father Name" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Course</label>
                                <input type="text" name="course" class="form-control mb-2" placeholder="Course" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Section</label>
                                <input type="text" name="section" class="form-control mb-2" placeholder="Section" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Department</label>
                                <input type="text" name="department" class="form-control mb-2" placeholder="Department" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Semester</label>
                                <input type="text" name="semester" class="form-control mb-2" placeholder="Semester" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" class="form-control mb-2" placeholder="Password" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Confirm Password</label>
                                <input type="password" name="confirm_password" class="form-control mb-2" placeholder="Confirm Password" required>
                            </div>
                            <div class="text-center mt-4">
                                <button trpe="submit" class="btn btn-primary">Submit</button>
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