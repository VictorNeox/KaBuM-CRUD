<?php
    
    if(isset($_POST['id'])) {
        include('../database/connection.php');
        $clientId = $_POST['id'];

        $sql = "UPDATE clients SET isActive = NOT isActive WHERE id = '$clientId'";

        mysqli_query($conn, $sql) or die(error());
        $conn->close();
    }

?>