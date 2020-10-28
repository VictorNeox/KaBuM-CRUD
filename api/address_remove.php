<?php 

    if(isset($_POST['clientId']))
    {   
        include('../database/connection.php');
        $clientId = mysqli_real_escape_string($conn, $_POST['clientId']);
        $addressId = mysqli_real_escape_string($conn, $_POST['addressId']);

        $sql = "DELETE FROM addresses WHERE id = '$addressId' AND client_id = '$clientId'";


        $result = mysqli_query($conn, $sql);
        
        $conn->close();
    }
