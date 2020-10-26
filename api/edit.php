<?php 

    include('../database/connection.php');

    if(isset($_POST['id'])) {

        $id = mysqli_real_escape_string($conn, strip_tags($_POST['id']));
        $name = mysqli_real_escape_string($conn, strip_tags($_POST['name']));
        $cpf = mysqli_real_escape_string($conn, strip_tags($_POST['cpf']));
        $rg = mysqli_real_escape_string($conn, strip_tags($_POST['rg']));
        $telephone1 = mysqli_real_escape_string($conn, strip_tags($_POST['telephone1']));
        $telephone2 = mysqli_real_escape_string($conn, strip_tags($_POST['telephone2']));
        $email = mysqli_real_escape_string($conn, strip_tags($_POST['email']));
        $birth = mysqli_real_escape_string($conn, strip_tags($_POST['birth']));


        $sql = "UPDATE clients SET 
        name = '$name',
        cpf = '$cpf',
        rg = '$rg',
        telephone1 = '$telephone1',
        telephone2 = '$telephone2',
        email = '$email',
        birth = '$birth'
        WHERE id = '$id'";
        

        $result = mysqli_query($conn, $sql);
        echo json_encode($cpf);
    }

    $conn->close();


?>