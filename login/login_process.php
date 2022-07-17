<?php

    include('../db.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        $type = $_POST['type'];
    }

    $sql = "select * from users where id = '$username' and password = '$password'";  
    $result = mysqli_query($conn, $sql);  
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
    $count = mysqli_num_rows($result);  

    if($count == 1) {
        header("Location: ../admin");
    } elseif(($username === 'user' && $password === '1234')) {
        header("Location: ../user");
    }
    ?>