<?php
    include('database/connect.php');

    $querysabores = mysqli_query($conn, "SELECT * FROM sabores");
    $sabores = mysqli_fetch_all($querysabores, MYSQLI_ASSOC);

    $querybordas = mysqli_query($conn, "SELECT * FROM bordas");
    $bordas = mysqli_fetch_all($querybordas, MYSQLI_ASSOC);

    $querymassas = mysqli_query($conn, "SELECT * FROM massas");
    $massas = mysqli_fetch_all($querymassas, MYSQLI_ASSOC);

    $querypizzas = mysqli_query($conn, "SELECT * FROM pizzas");
    $pizzas = mysqli_fetch_all($querypizzas, MYSQLI_ASSOC);

?>