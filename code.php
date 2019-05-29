<?




/*********************************************
| Database Credentials
*********************************************/

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
<input type="hidden" name="userid" value="'.$_POST['userid'].'">
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
 
  if (mysqli_query($conn, $sql)) {
  echo '<div class="alert alert-success" role="alert">Employee Added!</div>';
  
  } else {
  echo '<div class="alert alert-danger" role="alert">Error: ' . $sql . '</div>' . mysqli_error($conn);
  }
  
  mysqli_close($conn);
  }
  // end
  





/*********************************************
| Function to UPDATE a employee
*********************************************/

function updateemployee($userid,$user,$io,$message){

// Create connection
$conn = mysqli_connect(SERVERNAME,USERNAME, PASSWORD,DBNAME);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


$sql = "UPDATE io_employees SET user='{$user}', io='{$io}', message='{$message}' WHERE userid={$userid}";
$_POST['userid'] = false;
if (mysqli_query($conn, $sql)) {
echo '<div class="alert alert-success" role="alert">Employee Updated!</div>';
} else {
echo '<div class="alert alert-danger" role="alert">Error: ' . $sql . '</div>' . mysqli_error($conn);
}

mysqli_close($conn);

}
// end




/*********************************************
| Function to DELETE a employee
*********************************************/

function deleteemployee($userid) {

// Create connection
$conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD,DBNAME);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// sql to delete a record
$sql = "DELETE FROM io_employees WHERE userid='{$userid}'";

if (mysqli_query($conn, $sql)) {
echo '<div class="alert alert-danger" role="alert">Employee Deleted!</div>';
} else {
echo '<div class="alert alert-danger" role="alert">Error: ' . $sql . '</div>' . mysqli_error($conn);
}

mysqli_close($conn);

}
// end



/*********************************************
| Function to LIST Employees
*********************************************/

function listemployees() {


// Create connection
$conn = mysqli_connect(SERVERNAME,USERNAME, PASSWORD,DBNAME);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

//Update data from edit button

// READING the Data
$sql = "SELECT * FROM io_employees ORDER BY userid DESC";
$result = mysqli_query($conn, $sql);
?>
<br><br>

<!-- Employee List -->

<table class="table table-striped table-hover table-bordered">
<tr style="text-align:center;">
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

      if($row["userid"] == $_POST['userid'] ) {
?>
<form action="admin.php" method="POST">
  <tr>
    <td><input type="hidden" name="userid" value="<?=$_POST["userid"]?>"><?=$row['userid']?></td>
    <td><input type="text" name="user" value="<?=$_POST['user']?>"></td>
    <td>
        <div class="form-group">
          <select name="io">
            <option>Select One</option>
              <?
              if($row['io'] == '1') {
              echo '<option value="1" selected>1</option><br>';
              echo '<option value="0" >0</option><br>';
              } else {
              echo '<option value="1">1</option><br>';
              echo '<option value="0" selected>0</option><br>';
            }
              ?>   
            </select>
          </div>
      </td>
    <td><input type="text" name="message" value="<?=$_POST['message']?>"></td>
    <td>
      <input type="submit" class="btn btn-outline-info btn-sm" name="confirmupdate" value="Confirm Update">
      <a class="btn btn-outline-secondary btn-sm" href="admin.php" role="button">Cancel</a>
    </td>
  </tr>
</form> 
 
<?

      } else { ?>
<tr>
<td><?=$row["userid"]?></td>
<td><?=$row["user"]?></td>
<td><?=$row["io"]?></td>
<td> <?=$row["message"]?></td>

<td class="text-center">
<form action="admin.php" method="POST">
    <input type="hidden" name="userid" value="<?=$row["userid"]?>">
    <input type="hidden" name="user" value="<?=$row['user']?>">
    <input type="hidden" name="io" value="<?=$row['io']?>">
    <input type="hidden" name="message" value="<?=$row['message']?>">
    <button type="submit" name="usertoupdate"><i class="fas fa-check" style="color:green;"></i></button> 
</td>
<td class="text-center">
  <!-- <form action="admin.php" method="POST"> -->
  <button type="submit" name="deletethis"><i class="fas fa-times" style="color:red;"></i></button> 
</form>
</td>
</tr> 

      <? } ?>

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
