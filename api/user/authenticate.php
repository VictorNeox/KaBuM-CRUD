<?php

    include('../../token/auth.php');
    
    if(isset($_POST['login']) && isset($_POST['password'])) 
    {
        include('../../database/connection.php');
        $login = mysqli_real_escape_string($conn, $_POST['login']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        $password = sha1($password);

        $sql = "SELECT id, access, name FROM users WHERE login = '$login' AND password = '$password'";
        $result = mysqli_query($conn, $sql);

        
        if(mysqli_num_rows($result) < 1)
        {
            http_response_code(401);
            echo json_encode('Usuário ou senha incorretos.');
        } 
        else 
        {
            $user = mysqli_fetch_array($result);
            $token = generateToken($user);

            setcookie('token', $token, time() + (10 * 365 * 24 * 60 * 60), '/');

            echo json_encode($token);
        }
        $conn->close();
    }
    else if (isset($_COOKIE['token'])) 
    {
        $token = $_COOKIE['token'];
        $userData = validateToken($token);

    } else {
        header("location: /login.php");
        die();
    }