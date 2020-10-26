<?php
    
    if(isset($_POST['id'])) {
        include('../database/connection.php');
        $clientId = $_POST['id'];

        $result = mysqli_query($conn, $sql);
        $result = mysqli_fetch_array($result, MYSQLI_ASSOC);

        $sql = "UPDATE clients SET isActive = NOT isActive WHERE id = '$clientId'";

        mysqli_query($conn, $sql) or die(error());
        $conn->close();
        $response = array("success" => true);

        echo json_encode($response);
    }

?>