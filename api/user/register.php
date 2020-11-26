<?php
    if(isset($_POST['login'])) 
    {
        include('../../database/connection.php');
        $login = mysqli_real_escape_string($conn, $_POST['login']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);

        $password = sha1($password);

        $sql = "SELECT 1 FROM users WHERE login = '$login'";
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) >= 1)
        {
            http_response_code(409);
            echo json_encode('Login ja existe.');
        } 
        else 
        {
            $sql = "SELECT 1 FROM users WHERE email = '$email'";
            $result = mysqli_query($conn, $sql);
            if(mysqli_num_rows($result) >= 1)
            {
                http_response_code(409);
                echo json_encode('E-mail ja existe.');
            } else {
                $sql = "INSERT INTO users (login, password, name, email) 
                VALUES('$login', '$password', '$name', '$email')";
    
                $result = mysqli_query($conn, $sql);
                echo json_encode("Usuário registrado.");
            }
        }
        $conn->close();
    }