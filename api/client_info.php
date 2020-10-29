<?php
    include('../database/connection.php');
    if(isset($_GET['clientId']))
    {
        $clientId = mysqli_real_escape_string($conn, $_GET['clientId']);

        /*$sql = "SELECT name, cpf, rg, birth, email, telephone1, telephone2 WHERE id = '$clientId'";
        
        $result = mysqli_query($conn, $sql);

        $sql = "SELECT name, cpf, rg, birth, email, telephone1, telephone2 WHERE id = '$clientId'";*/

        $sql = "SELECT
                clt.name,
                clt.cpf,
                clt.rg,
                clt.birth,
                clt.email,
                clt.telephone1,
                clt.telephone2,

                adr.street, 
                adr.number, 
                adr.neighbourhood, 
                adr.city, 
                adr.uf, 
                adr.zipcode, 
                adr.complement
            FROM clients clt
            LEFT JOIN addresses adr
                ON clt.id = adr.client_id AND adr.main_address = 1
            WHERE clt.id = '$clientId'
        ";
        
        $result = mysqli_query($conn, $sql);
  
        $clientInfo = mysqli_fetch_array($result, MYSQLI_ASSOC);
        
        echo json_encode($clientInfo);
    }
    $conn->close();