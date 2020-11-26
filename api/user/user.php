<?php

    include('../../database/connection.php');
    include('../../token/auth.php');
    if(isset($_POST['access']) && isset($_COOKIE['token'])) 
    {
        $token = $_COOKIE['token'];
        $userData = validateToken($token);

        $userId = mysqli_real_escape_string($conn, $userData['id']);
        $access = mysqli_real_escape_string($conn, $userData['access']);

        $newAccess = mysqli_real_escape_string($conn, $_POST['access']);
        $id = mysqli_real_escape_string($conn, $_POST['id']);

        if($access > 1) 
        {
            $sql = "UPDATE users 
                    SET access = '$newAccess' 
                    WHERE id = '$id'
            ";
        } 
        else
        {
            http_response_code(401);
            echo json_encode("Você não possui permissão para isso.");
            exit();
        }

        $result = mysqli_query($conn, $sql);
        echo json_encode("Nível de acesso alterado");

        $conn->close();

    }