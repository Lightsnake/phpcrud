<?php

session_start();
    //Connecting to database
    $mysqli= new mysqli('localhost','root','root','crud') or die(mysqli_error($mysqli));
    $id = 0;
    $update=false;
    $name='';
    $location=''; 

    //Save button handler
    if(isset($_POST['save'])){ 
        $name=$_POST['name'];
        $location=$_POST['location'];

        $_SESSION['message'] = "Record has been saved";
        $_SESSION['msg_type'] = "success";

        $mysqli->query("INSERT INTO data(name,location) VALUES('$name', '$location')") or
            die($mysqli->error);

        //Returns to homepage
        header("location: index.php");
    }

    //Delete Button handler
    if (isset($_GET['delete'])){
        $id = $_GET['delete'];
        $mysqli->query("DELETE FROM data WHERE id='$id'") or die ($mysqli->error());

        $_SESSION['message'] = "Record has been deleted!";
        $_SESSION['msg_type'] = "danger";

        //Returns to homepage
        header("location: index.php");
    }
    //Edit Button Handler
    if (isset($_GET['edit'])){
        $id = $_GET['edit'];
        $update=true;
        $result = $mysqli->query("SELECT * FROM data WHERE id=$id") or die($mysqli->error());
        if ($result){
            $row=$result->fetch_array();
            $name = $row['name'];
            $location =$row['location'];
        }
    }

    if (isset($_POST['update'])){
        $id = $_POST['id'];
        $name =$_POST['name'];
        $location =$_POST['location'];

        $mysqli->query("UPDATE data SET name='$name', location='$location' WHERE id=$id") or die($mysqli_error);

        $_SESSION['message']='Record has been updated';
        $_SESSION['msg_type']="warning";
        header('location: index.php');
    }
?>

