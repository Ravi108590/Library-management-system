<?php

$id = $_COOKIE['id'];

    // Get user image
    include('../db.php');

    $sql = "SELECT image 
    FROM `users`
    WHERE `id` = '$id'
        ";
    $image_url  = mysqli_fetch_array(mysqli_query($conn, $sql))['image'];

?>
    <script type="text/javascript">
 function timedMsg()
  {
    var t=setInterval("change_time();",1000);
  }
 function change_time()
 {
   var d = new Date();
   var curr_hour = d.getHours();
   var curr_min = d.getMinutes();
   var curr_sec = d.getSeconds();
   if(curr_hour > 12)
     curr_hour = curr_hour - 12;
   document.getElementById('Hour').innerHTML =curr_hour+' :';
    document.getElementById('Min').innerHTML=curr_min+' :';
    document.getElementById('Second').innerHTML=curr_sec;
 }
timedMsg();   
</script>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">
      <img src="../assets/img/logo.png" height="50px" />
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor03" aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarColor03">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link active" href="index.php">My Statistics
            <span class="visually-hidden">(current)</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" target="_blank" href="../rules.pdf">Library Rules</a>
        </li>
      </ul>
      <!-- <form class="d-flex"> -->
        <p class="text-black">
          Logged in since: <?php echo $_COOKIE['login_time']; ?> . 
          
          <p class="text-black"> Current time: 
            <span id="Hour"></span>
            <span id="Min"></span>
            <span id="Second"></span>
          </p>

        </p>
        
        <a href="profile.php">
          <img src="../images/<?php echo $image_url ?>" width=50 alt="">
        </a>

        <a href="../login/logout.php">
          <button class="btn btn-warning my-2 my-sm-0" type="submit">Logout</button>
        </a>
      <!-- </form> -->
    </div>
  </div>
</nav>
