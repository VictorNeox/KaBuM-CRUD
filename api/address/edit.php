<?php
    include('../../database/connection.php');
    include('../../token/auth.php');

    if(isset($_POST['clientId']) && isset($_POST['addressId']))
    {
        $clientId = mysqli_real_escape_string($conn, $_POST['clientId']);
        $addressId = mysqli_real_escape_string($conn, $_POST['addressId']);
        $street = mysqli_real_escape_string($conn, $_POST['street']);
        $number = mysqli_real_escape_string($conn, $_POST['number']);
        $neighbourhood = mysqli_real_escape_string($conn, $_POST['neighbourhood']);
        $zipcode = mysqli_real_escape_string($conn, $_POST['cep']);
        $city = mysqli_real_escape_string($conn, $_POST['city']);
        $uf = mysqli_real_escape_string($conn, $_POST['uf']);
        $complement = mysqli_real_escape_string($conn, $_POST['complement']);

        $sql = "UPDATE addresses SET street = '$street', number = '$number', neighbourhood = '$neighbourhood', zipcode = '$zipcode', city = '$city', uf = '$uf', complement = '$complement' WHERE id = '$addressId' AND client_id = '$clientId'";

        mysqli_query($conn, $sql);

        echo json_encode($sql);
        die();

    } 
    if(isset($_GET['clientId']) && isset($_GET['addressId']))
    {
        $clientId = mysqli_real_escape_string($conn, $_GET['clientId']);
        $addressId = mysqli_real_escape_string($conn, $_GET['addressId']);
        $sql = "SELECT * FROM addresses WHERE id = '$addressId' AND client_id = '$clientId'";
        
        $result = mysqli_query($conn, $sql);
        
        $address = mysqli_fetch_array($result, MYSQLI_ASSOC);
        
        echo json_encode($address);
        die();
    }

    $conn->close();
    
?>