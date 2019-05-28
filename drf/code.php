<?
/*********************************************
| MyGuest Application
| Version 1.0
| Stephen Fitzmeyer, M.D.
*********************************************/

/*********************************************
| CONTENTS:
| Database Credentials
| Update form
| Registration form
| Function to ADD a Employee
| Function to UPDATE a Employee
| Function to DELETE an Employee
| Function to LIST Employees
*********************************************/




/*********************************************
| Database Credentials
*********************************************/
$servername = "localhost";
$username = "jaxcode83";
$password = "Ducks0up";
$dbname = "jaxcode83";
// end



/*********************************************
| Update form
*********************************************/
$updateform = '<h2>Update Employee</h2>
<form action="admin.php" method="POST">
  <div class="form-group">
    <label for="employee">Employee:</label>
    <input type="text"name="user" class="form-control" id="user" value="'.$_POST['user'].'" required>
  </div>
hidden" name="userid" value="'.$_POST['userid'].'">
  <button type="submit" name="updateemployee" class="btn btn-info">Update Employee</button>
</form>';
// end







/*********************************************
| Registration form
*********************************************/
$registrationform = '<h2>Add Employee</h2>
<form action="admin.php" method="POST">
  <div class="form-group">
    <label for="user">Employee:</label>
    <input type="text" name="Employee" class="form-control" id="user" required>
  </div>
    
  <button type="submit" name="addemployee" class="btn btn-info">Add Employee</button>
</form>';
// end









/*********************************************
| Function to ADD an employee
*********************************************/

function addemployee($user) {
  // Create connection
  $conn = mysqli_connect(SERVERNAME,USERNAME, PASSWORD,DBNAME) ;
  // Check connection
  if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
  }
  // Sanitize incoming $_POST variables
  //$user = filter_var($_POST['user'], FILTER_SANITIZE_STRING);

  
  $sql = "INSERT INTO io_employees (user)
  VALUES ('$user')";
  echo 'Employee: '.$_POST['Employee'];
  echo '<br>';
  echo $sql;
  if (mysqli_query($conn, $sql)) {
  echo '<div class="alert alert-success" role="alert">Employee Added!</div>';
  
  } else {
  echo '<div class="alert alert-danger" role="alert">Error: ' . $sql . '</div>' . mysqli_error($conn);
  }
  
  mysqli_close($conn);
  }
  // end
  





/*********************************************
| Function to UPDATE a guest
*********************************************/

function updateemployee($user){

// Create connection
$conn = mysqli_connect(SERVERNAME,USERNAME, PASSWORD,DBNAME);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$user = filter_var($_POST['user'], FILTER_SANITIZE_STRING);
$io = filter_var($_POST['lastname'], FILTER_SANITIZE_STRING);
$message = filter_var($_POST['email'], FILTER_SANITIZE_STRING);

$sql = "UPDATE  SET user='{$user}', io='{$io}', message='{$message}' WHERE userid={$_POST['userid']}";

if (mysqli_query($conn, $sql)) {
echo '<div class="alert alert-success" role="alert">Employee Updated!</div>';
} else {
echo '<div class="alert alert-danger" role="alert">Error: ' . $sql . '</div>' . mysqli_error($conn);
}

mysqli_close($conn);

}
// end




/*********************************************
| Function to DELETE a guest
*********************************************/

function deleteemployee() {

// Create connection
$conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD,DBNAME);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// sql to delete a record
$sql = "DELETE FROM io_employees WHERE userid='{$_POST['userid']}'";

if (mysqli_query($conn, $sql)) {
echo '<div class="alert alert-danger" role="alert">Employee Deleted!</div>';
} else {
echo '<div class="alert alert-danger" role="alert">Error: ' . $sql . '</div>' . mysqli_error($conn);
}

mysqli_close($conn);

}
// end



/*********************************************
| Function to LIST Guests
*********************************************/

function listemployees() {


// Create connection
$conn = mysqli_connect(SERVERNAME,USERNAME, PASSWORD,DBNAME);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// READING the Data
$sql = "SELECT * FROM io_employees";
$result = mysqli_query($conn, $sql);
?>
<br><br>

<!-- Employee List -->

<table class="table table-striped table-hover table-bordered">
<tr>
<th>ID</th>
<th>Employee</th>
<th>Status</th>
<th>Message</th>
<th>Update</th>
<th>Delete</th>
</tr>

<?
if (mysqli_num_rows($result) > 0) {
    // output data of each row
    
    while($row = mysqli_fetch_assoc($result)) {
?>
<tr>
<td><?=$row["userid"]?></td>
<td><?=$row["user"]?></td>
<td><?=$row["io"]?></td>
<td> <?=$row["message"]?></td>
<td>
  <a href="admin.php?usertoupdate=<?=$row["userid"]?>" style="color:green;"><i class="fas fa-edit"></i></a>

</td>
<td>
<form action="admin.php" method="POST">
<input type="hidden" name="id" value="<?=$row['id']?>">
<input type="submit" name="deletethis" value="Delete" class="btn btn-danger btn-xs">
</form>
</td>
</tr> 
<?
    }
} else {
echo '<div class="alert alert-warning" role="alert">0 results</div>' . mysqli_error($conn);
}
echo '</table><!-- /Guest List -->';
mysqli_close($conn);

}
// end




?>









