<?php
include('security.php');

include('includes/header.php'); 
include('includes/navbar.php'); 
?>

<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Edit Student Profile</h6>
  </div>

  <div class="card-body">
<?php
$connection = mysqli_connect("localhost","root","","academic_progress");

  if(isset($_POST['edit_btn'])){
    $id = $_POST['edit_id'];
    
    $query = "SELECT * FROM student WHERE id='$id'";
    $query_run = mysqli_query($connection, $query);


    foreach($query_run as $row){ ?>

        <form action="student_code.php" method="POST">
            <input type="hidden" name="edit_id" value="<?php echo $row['id']?>">
            <div class="form-group">
                <label> Username </label>
                <input type="text" name="edit_username" value="<?php echo $row['username']?>" class="form-control" placeholder="Enter Username">
            </div>
            <div class="form-group">
                <label>First Name</label>
                <input type="text" name="edit_fname" value="<?php echo $row['fname']?>" class="form-control" placeholder="Enter Email">
            </div>
            <div class="form-group">
                <label>Last Name</label>
                <input type="text" name="edit_lname" value="<?php echo $row['lname']?>" class="form-control" placeholder="Enter Email">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="edit_password" value="<?php echo $row['password']?>" class="form-control" placeholder="Enter Password">
            </div>
            <div>
            <label for='faculty_lab'>Faculty</label><br>
            <select name="edit_faculty">
                <option value="FIA">Faculty of ART</option>
                <option value="FIEc">Faculty of Economics</option>
                <option value="FIEn">Faculty of Engineering</option>
            </select>
            </div><br>
                <a href ="student.php" class="btn btn-danger">CANCEL</a>
                <button type="submit" name="updatebtn" class="btn btn-primary">Update</button>

        </form>
            <?php
    }
}
?>
  </div>
  </div>
  </div>
  </div>
  <!-- /.container feild-->

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>