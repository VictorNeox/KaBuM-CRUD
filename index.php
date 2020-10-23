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
        PRIMARY KEY (id)
    );*/
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
                            <?php foreach($clients as $client){ ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($client['id']); ?></td>
                                    <td><?php echo htmlspecialchars($client['name']); ?></td>
                                    <td><?php echo htmlspecialchars($client['cpf']); ?></td>
                                    <td><?php echo htmlspecialchars($client['rg']); ?></td>
                                    <td><?php echo htmlspecialchars($client['telephone1']); ?></td>
                                    <td><?php echo htmlspecialchars($client['telephone2']); ?></td>
                                    <td><?php echo htmlspecialchars($client['birth']); ?></td>
                                    <td><?php echo htmlspecialchars($client['email']); ?></td>
                                    <td>
                                        <i class="fas fa-pencil-alt pencil-icon"></i>
                                        <i class="fas fa-trash-alt trash-icon"></i>
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