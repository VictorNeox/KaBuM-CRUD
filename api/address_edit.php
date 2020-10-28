<?php 
    if(isset($_GET['clientId']))
    {   
        include('../database/connection.php');
        $clientId = mysqli_real_escape_string($conn, $_GET['clientId']);
        $addressId = mysqli_real_escape_string($conn, $_GET['addressId']);

        $sql = "SELECT zipcode, street, number, neighbourhood, city, uf, complement 
                    FROM addresses 
                    WHERE id = '$addressId' AND client_id = '$clientId'";


        $result = mysqli_query($conn, $sql);
        
        $address = mysqli_fetch_array($result, MYSQLI_ASSOC);

        echo json_encode($address);
        
        $conn->close();
        exit();
    }