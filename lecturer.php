<?php
include('security.php');

include('includes/header.php'); 
include('includes/navbar.php'); 
?>


<div class="modal fade" id="addadminprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Lecturer Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="lecturer_code.php" method="POST">

        <div class="modal-body">

            <div class="form-group">
                <label> Username </label>
                <input type="text" name="username" class="form-control" placeholder="Enter Username">
            </div>
            <div class="form-group">
                <label>First Name</label>
                <input type="text" name="fname" class="form-control" placeholder="Enter First Name">
            </div>
            <div class="form-group">
                <label>Last Name</label>
                <input type="text" name="lname" class="form-control" placeholder="Enter Last Name">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" placeholder="Enter Password">
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="confirmpassword" class="form-control" placeholder="Confirm Password">
            </div>
            <label for='faculty_lab'>Faculty</label><br>
            <select name="faculty">
                <option value="FIA">Faculty of ART</option>
                <option value="FIEc">Faculty of Economics</option>
                <option value="FIEn">Faculty of Engineering</option>
            </select>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="registerlec" class="btn btn-primary">Save</button>
        </div>
      </form>

    </div>
  </div>
</div>


<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Lecturer Profile 
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addadminprofile">
              Add Lecturer Profile 
            </button>
    </h6>
  </div>

  <div class="card-body">
  
  <?php
  if(isset($_SESSION['success'])&& $_SESSION['success']!=''){
    echo '<h2 class="bg-primary text-white"> '.$_SESSION['success'].' </h2>';
    unset($_SESSION['success']);
  }
  
  if(isset($_SESSION['status'])&& $_SESSION['status']!=''){
    echo '<h2 class="bg-danger text-white"> '.$_SESSION['status'].' </h2>';
    unset($_SESSION['status']);
  }
  ?>
    <div class="table-responsive">

    <?php
      $connection = mysqli_connect("localhost","root", "", "academic_progress");
      $query = "SELECT * FROM lecturer";
      $query_run = mysqli_query($connection, $query);
      
    ?>

      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Name</th>
            <th>Password</th>
            <th>Faculty</th>
            <th>EDIT</th>
            <th>DELETE</th>
          </tr>
        </thead>
        <tbody>
        <?php
          if(mysqli_num_rows($query_run)>0){
            while($row = mysqli_fetch_assoc($query_run)){
              $name= $row['fname']." ".$row['lname'];
                if($row['faculty']=="FIA"){
                  $fac="Faculty of ART";
                }
                else if($row['faculty']=="FIEc"){
                  $fac="Faculty of Economics";
                }
                else{
                  $fac="Faculty of Engineering";
                }

              ?>
              
               <!--print the data in database to register table -->
          <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['username']; ?></td>
            <td><?php echo $name; ?></td>
            <td><?php echo $row['password']; ?></td>
            <td><?php echo $fac; ?></td>
            <td>
              <form action="lecturer_edit.php" method="post">
              <input type="hidden" name="edit_id" value="<?php echo $row['id'];?>">
              <button type="submit" name="edit_btn" class="btn btn-success">EDIT</button>
              </form>
            </td>
            <td>
              <form action="lecturer_code.php" method="post">
              <input type="hidden" name="delete_id" value="<?php echo $row['id'];?>">
              <button type="submit" name="delete_btn" class="btn btn-danger">DELETE</button>
              </form>
            </td>
          </tr>
          <?php    
            
          }
        }
          else{
            echo "No Record Found";
          }
      
          ?>  
       
        
        </tbody>
      </table>

    </div>
  </div>
</div>

</div>
<!-- /.container-fluid -->

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>