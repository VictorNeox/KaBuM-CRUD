<?php
    if(isset($_POST['addressId']) && isset($_POST['clientId'])) {
        include('../database/connection.php');
        $addressId = $_POST['addressId'];
        $clientId = $_POST['clientId'];

        $sql = "UPDATE addresses SET main_address = 0 WHERE client_id = '$clientId' AND main_address = 1";

        mysqli_query($conn, $sql);

        $sql = "UPDATE addresses SET main_address = 1 WHERE id = '$addressId' AND client_id = '$clientId'";

        mysqli_query($conn, $sql) or die(error());

        $conn->close();
    }