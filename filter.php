<?php
    if(isset($_GET['filter']))
    {
        $filter = mysqli_real_escape_string($conn, utf8_encode($_GET['filter']));
        $search = mysqli_real_escape_string($conn, utf8_encode($_GET['search']));

        $sql = ($access == 1) ?
            "SELECT 
                    clt.id, 
                    clt.name, 
                    clt.rg, 
                    clt.cpf, 
                    clt.email, 
                    clt.isActive,
                    usr.name as userName
                FROM clients clt
                JOIN users usr
                ON clt.user_id = usr.id
                WHERE clt.$filter LIKE '%$search%' AND clt.user_id = '$userId'
                ORDER BY clt.isActive DESC
            " :
            "SELECT 
                    clt.id, 
                    clt.name, 
                    clt.rg, 
                    clt.cpf, 
                    clt.email, 
                    clt.isActive,
                    usr.name as userName
                FROM clients clt
                JOIN users usr
                ON clt.user_id = usr.id
                WHERE clt.$filter LIKE '%$search%'
                ORDER BY clt.isActive DESC
            ";
    }