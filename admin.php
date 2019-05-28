<!DOCTYPE html>

<html>

<head>

<meta name="description" content="This is a admin page for employee in/out page ">
<meta name="keywords" content="employee, admin">
<meta name="viewport" content="width=device-width, initial-scale=1.0">


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
      font-size:20px;

  }   


</style>

  <Link rel="stylesheet" type="text/css" href="css/inout.css">

  <title>In Out Admin</title>

</head>

<body>

  <!-- Navigation Bar -->
  <nav class="navbar navbar-expand-sm nav navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="index.php">In Out</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="#">Admin</a>
      </li>
      <li class="nav-item">
       </ul>
  </nav>

  <br><br>

<!-- Header -->

  <div class="container text-center">
      <div class="row">
          <div class="col-md-12">

          <h1 style="padding-top:30px; font-size:60px;color:#739900; text-shadow:1px 1px black;">Admin for In/Out board</h1>

        </div> 
    </div>
  </div>

  <div class="container">
      <div class="row">
          <div class="col-md-12">
            <br>

  <!---include external style sheets--->

  <?php


        // INCLUDE PHP
        include 'php.php';
        include 'code.php';


// UPDATE
if(isset($_POST['confirmupdate'])) {

updateemployee($_POST['userid'],$_POST['user'],$_POST['io'],$_POST['message']);

  }

  
  //DELETE
  if(isset($_POST['deletethis'])) {
  deleteemployee($_POST['userid']);
  }
 
  // INSERT
  if(isset($_POST['addemployee'])) {
  addemployee($_POST['Employee']);
  }
  
  // FORMS 
  if(isset($_POST['editthis'])) { 
  echo $updateform;
  } else { 
  echo $registrationform;
  } 
  
  // LIST Employees
  listemployees($servername,$username,$password,$dbname); 
  
  ?>

</div></div></div>

</body>

</html>