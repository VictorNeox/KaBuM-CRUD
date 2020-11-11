<?php
    
    include('../../database/connection.php');
    include('../user/authenticate.php');

    if(isset($_POST['id'])) 
    {
        $clientId = $_POST['id'];
        $userId = mysqli_real_escape_string($conn, $userData['id']);
        $userAccess = mysqli_real_escape_string($conn, $userData['access']);

        if($userAccess > 1)
        {
            $sql = "UPDATE clients SET isActive = NOT isActive WHERE id = '$clientId'";
            mysqli_query($conn, $sql) or die(error());
        }
        else
        {
            http_response_code(401);
            echo json_encode("Você não possui permissão para isso.");
            exit();
        }
        echo json_encode("Status modificado com sucesso");
        
        $conn->close();
    }

?>