<?php
    include('database/connect.php');

    if(isset($_GET['id'])){
        $deleteid = $_GET['id'];
        mysqli_query($conn, "DELETE FROM pizza_sabor WHERE pizza_id = '$deleteid'");
        mysqli_query($conn, "DELETE FROM pizzas WHERE id = '$deleteid'");
        header('location: ../dashboard.php');
    }
?>