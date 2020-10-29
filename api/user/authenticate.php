<?php
    if(isset($_POST['login']) && isset($_POST['password'])) 
    {
        include('../../database/connection.php');
        include('../../token/generate.php');
        $login = mysqli_real_escape_string($conn, $_POST['login']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        $password = sha1($password);

        $sql = "SELECT id, access FROM users WHERE login = '$login' AND password = '$password'";
        $result = mysqli_query($conn, $sql);

        
        if(mysqli_num_rows($result) < 1)
        {
            echo json_encode('Usuário ou senha incorretos.');
        } 
        else 
        {
            $user = mysqli_fetch_array($result);
            $token = generateToken($user['id'], $user['access']);

            setcookie('token', $token, '/');

            echo json_encode($token);
        }
        $conn->close();
    }