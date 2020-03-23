<?php
session_start();

$connection = mysqli_connect("localhost","root","","academic_progress");

if(isset($_POST['registerlec'])){
    $username = $_POST['username'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $password = $_POST['password'];
    $cpassword = $_POST['confirmpassword'];
    $faculty = $_POST['faculty'];
    echo $faculty;

    if($password === $cpassword){

        $query = "INSERT INTO lecturer (username, fname, lname, password, faculty) VALUES ('$username', '$fname', '$lname','$password', '$faculty')";
        $query_run = mysqli_query($connection, $query);

        if($query_run){
            echo "Saved";
            $_SESSION['success'] = "Lecturer Profile Added";
            header('Location: lecturer.php');
        }
        else{
            $_SESSION['status'] = "Lecturer Profile NOT Added";
            header('Location: lecturer.php');
        }
    }
    else{
        $_SESSION['status'] = "Password and Confirm Password Does Not Match";
        header('Location: lecturer.php');
    }
}

if(isset($_POST['updatebtn'])){
    $id = $_POST['edit_id'];
    $username = $_POST['edit_username'];
    $fname = $_POST['edit_fname'];
    $lname = $_POST['edit_lname'];
    $password = $_POST['edit_password'];
    $faculty = $_POST['edit_faculty'];

    $query = "UPDATE lecturer SET username='$username', fname='$fname', lname='$lname', password='$password', faculty='$faculty' WHERE id='$id'";
    $query_run = mysqli_query($connection, $query);

    if($query_run){
        $_SESSION['success'] = "Your Data is Updated";
        header('Location: lecturer.php');
    }
    else{
        $_SESSION['status'] = "Your Data is NOT Updated";
        header('Location: lecturer.php');
    }
        
}


if(isset($_POST['delete_btn'])){
    $id = $_POST['delete_id'];

    $query = "DELETE FROM lecturer WHERE id='$id'";
    $query_run = mysqli_query($connection, $query);

    if($query_run){
        $_SESSION['success'] = "Your Data is DELETED";
        header('Location: lecturer.php');
    }
    else{
        $_SESSION['status'] = "Your Data is NOT DELETED";
        header('Location: lectuter.php');
    }
    
}
