<?php
    
    include('../../database/connection.php');
    include('../../token/auth.php');
    if(isset($_POST['id']) && isset($_COOKIE['token'])) 
    {

        $token = $_COOKIE['token'];
        $clientId = $_POST['id'];
        
        $userData = validateToken($token);
        
        $userId = mysqli_real_escape_string($conn, $userData['id']);
        $access = mysqli_real_escape_string($conn, $userData['access']);

        if($access > 1)
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