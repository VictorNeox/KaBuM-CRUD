<?php

    include_once('./connection.php');

    $sql = 'SELECT * from clients';

    $result = mysqli_query($conn, $sql);

    $clients = mysqli_fetch_all($result, MYSQLI_ASSOC);


    $conn->close();

    /*INSERT INTO clients (name, cpf, rg, telephone1, telephone2, birth, email) values ('Larissa Alves', '12345678911', '123456789', '000000000', '000000000', '2000-04-18', 'larissa-alves24@gmail.com');
    
    CREATE TABLE clients(
        id int NOT NULL AUTO_INCREMENT,
        name varchar(255),
        cpf varchar(11),
        rg varchar(9),
        telephone1 varchar(9),
        telephone2 varchar(9),
        birth date,
        email varchar(255),
        active boolean DEFAULT TRUE,
        PRIMARY KEY (id)
    );*/

    function dataFormat($data, $typeofdata) {
        if ($typeofdata == 'cpf') 
        {
            $string1 = substr($data, 0, 3);
            $string2 = substr($data, 3, 3);
            $string3 = substr($data, 6, 3);
            $string4 = substr($data, -2);
    
            $data = "$string1"."."."$string2"."."."$string3"."-"."$string4";
            return $data;
        }
        else if ($typeofdata == 'rg') {
            $string1 = substr($data, 0, 2);
            $string2 = substr($data, 2, 3);
            $string3 = substr($data, 5, 3);
            $string4 = substr($data, -1);
            
            $data = "$string1"."."."$string2"."."."$string3"."-"."$string4";    
            return $data;
        }
        else if ($typeofdata == 'tel') 
        {
            $string1 = substr($data, 0, 4);
            $string2 = substr($data, 4, 8);
            
            $data = "$string1"."-"."$string2";
            return $data;
        }
        else if ($typeofdata == 'birth')
        {
            $data = date('d/m/Y', strtotime($data));
            return $data;
        }
    }
?>

<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <link rel="stylesheet" href="/assets/ballon.css">
    <link rel="stylesheet" href="/assets/global.css">
    <link rel="stylesheet" href="/assets/homeStyles.css">
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <title>C.R.U.D - Home</title>
</head>
<body>
    <nav>
        <div class="nav-wrapper">
            <img src="./assets/kabumLogo.png" class="brand-logo right logo-kabum" alt="Logo do KaBuM!" >
        </div>
    </nav>

    <div class="content">
        <h1 class="table-title">Clientes</h1>
        <a href="/pages/insert/insert.php" class="waves-effect waves-light btn add-btn">Adicionar cliente</a>
        <?php if(empty($clients)) { ?>
            <h1 class="non-client">Nenhum cliente inserido!</h1>
            <?php } else { ?>
                <div class="table-content">
                    <table class="striped responsive-table centered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>CPF</th>
                                <th>RG</th>
                                <th>Telefone 1</th>
                                <th>Telefone 2</th>
                                <th>Data de nascimento</th>
                                <th>E-mail</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
            
                        <tbody>
                            <?php foreach($clients as $client){ 
                                $name = mysqli_real_escape_string($conn, $_POST['name']);
                                $cpf = dataFormat($client["cpf"], 'cpf');
                                $rg = dataFormat($client["rg"], 'rg');
                                $telephone1 = dataFormat($client["telephone1"], 'tel');
                                $telephone2 = dataFormat($client["telephone1"], 'tel');
                                $birth = dataFormat($client["birth"], 'birth');
                                $email = mysqli_real_escape_string($conn, $_POST['email']);
                            ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($client['id']); ?></td>
                                    <td><?php echo htmlspecialchars($client['name']); ?></td>
                                    <td><?php echo htmlspecialchars($cpf); ?></td>
                                    <td><?php echo htmlspecialchars($rg); ?></td>
                                    <td>(19) <?php echo htmlspecialchars($telephone1); ?></td>
                                    <td>(19) <?php echo htmlspecialchars($telephone2); ?></td>
                                    <td><?php echo htmlspecialchars($birth); ?></td>
                                    <td><?php echo htmlspecialchars($client['email']); ?></td>
                                    <td>
                                        <i class="fas fa-pencil-alt pencil-icon"></i>
                                        <i class="fas fa-circle trash-icon"></i>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            <?php } ?>
    </div>
</body>
</html>