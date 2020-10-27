<?php
    if(isset($_POST['clientId']))
    {
        include('../database/connection.php');
        $clientId = mysqli_real_escape_string($conn, $_POST['clientId']);
        $street = mysqli_real_escape_string($conn, $_POST['street']);
        $number = mysqli_real_escape_string($conn, $_POST['number']);
        $neighbourhood = mysqli_real_escape_string($conn, $_POST['neighbourhood']);
        $zipcode = mysqli_real_escape_string($conn, $_POST['cep']);
        $city = mysqli_real_escape_string($conn, $_POST['city']);
        $uf = mysqli_real_escape_string($conn, $_POST['uf']);
        $complement = mysqli_real_escape_string($conn, $_POST['complement']);

        $sql = "INSERT INTO addresses (street, number, neighbourhood, zipcode, city, uf, complement, client_id) VALUES ('$street', '$number', '$neighbourhood', '$zipcode', '$city', '$uf', '$complement', '$clientId')";

        mysqli_query($conn, $sql);

        $conn->close();
    }
    
?>