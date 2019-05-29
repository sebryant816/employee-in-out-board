<!DOCTYPE html>

<html>

<head>

  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

  <!-- Popper JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

  <!-- Latest compiled JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">

<style>

  .nav {
      
      background-color:#99cc00;
      border-bottom:2px solid black;
      border-top: 2px solid black;
      font-size: 20px;

  }   


</style>

  <Link rel="stylesheet" type="text/css" href="css/inout.css">

  <title>In Out</title>

</head>

<body>

  <!-- Navigation Bar -->
  <nav class="navbar navbar-expand-sm nav navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="#">In Out</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="admin.php">Admin</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Refresh</a>
      </li>
      <li class="nav-item">
    </ul>
  </nav>

  <!-- Header -->

  <br><br>

  <div class="container text-center">
      <div class="row">
          <div class="col-md-12">

          <h1 style="padding-top:30px; font-size:60px;color:#739900; text-shadow:1px 1px black;">Employee In/Out Board</h1>
        
          <h3 style="padding-top:30px;color:black;">Move Buttons to Reflect Status</h3>

        </div> 
    </div>
  </div>

  <div class="container">
      <div class="row">
          <div class="col-md-12">
            <br><br>

  <!---creditials--->

  <?php

  // Code to Change Message

            if(isset($_POST['message']))  {

            //function to scrub "message"

            $_POST['message'] = filter_var($_POST['message'], FILTER_SANITIZE_STRING);
                        
            // Create connection
            $conn = mysqli_connect($servername, $username, $password, $dbname);
            // Check connection
            if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
            }        

            // Check record being updated has matching ID to the record being changed

            $sql = "UPDATE io_employees SET message ='{$_POST['message']}' WHERE userid = '{$_POST['userid']}'";
                if (mysqli_query($conn, $sql)) {

                } else {
                    echo "Error updating record:" . mysqli_error ($conn);
                }
            }
       
   // Change In Out Status by moving buttons
          
            if (isset($_GET['io'])){
                        
   // Create connection
  
           $conn = mysqli_connect($servername, $username, $password, $dbname);
          
   // Check connection
  
            if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
            }        
            $sql="UPDATE io_employees SET io ='{$_GET['io']}' WHERE userid = '{$_GET['userid']}'";

            if (mysqli_query($conn, $sql)) {
            } else { 
                echo "Error updating record:" .mysqli_error ($conn);
            }

            }  
    
          //close PHP for HTML table config
    
            ?>

    <!---create table--->

          <table class="table table-striped table-hover"> 

          <?php


    // Create connection
    
          $conn = mysqli_connect($servername, $username, $password, $dbname);
    
    // Check connection

        if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
        }

        $sql = "SELECT * FROM io_employees";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {

      //table data

        while ($row = mysqli_fetch_assoc($result)) {
                
        ?>

  
      
              <tr>
              <td class="align-middle lead"><?=$row['user']?></td>
              <? if($row['io'] == '0') { ?>
              <td class="text-center"><a href="index.php?userid=<?=$row['userid']?>&io=1"><img src="images/circle_green.png" class="hidden"></a></td>
              <td class="text-center"><img src="images/circle_red.png"></td>
              <? } else { ?>
              <td class="text-center"><img src="images/circle_green.png"></td>
              <td class="text-center"><a href="index.php?userid=<?=$row['userid']?>&io=0"><img src="images/circle_red.png" class="hidden"></a></td>
              <? } ?>
              <td>
                    
              <? if($row['message'] != '') { ?>
              <a data-toggle="collapse" href="#collapse<?=$row['userid']?>" aria-expanded="false" aria-controls="collapse<?=$row['userid']?>" style="color:#000000;">
              <?=$row['message']?>
              </a>
              <? } else {?>
              <a data-toggle="collapse" href="#collapse<?=$row['userid']?>" aria-expanded="false" aria-controls="collapse<?=$row['userid']?>" class="text-muted float-right" style="text-decoration-style: dashed;font-style: italic;font-size:12px;text-decoration: underline;"><i class="far fa-edit"></i></a>
              <? } ?>


        </p>

    <div class="collapse" id="collapse<?=$row['userid']?>">
        <div>
            <form action="index.php" method="POST">
            <input type="text" name="message" value="<?=$row['message']?>">
            <input type="hidden" name="userid" value="<?=$row['userid']?>">
            <input class="btn btn-secondary btn-md" style="padding:0 4px;" type="submit" value="Submit">
            
            </form>

        </div>
    </div>
        
            </td>
            </tr>
            <?
            }
            } else {

            echo "0 results";
            }

            mysqli_close($conn);

            ?>

            </div>
        </div>
    </div>

</body>

</html>
