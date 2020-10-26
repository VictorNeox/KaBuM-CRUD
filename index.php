<?php
/*INSERT INTO clients (name, cpf, rg, telephone1, telephone2, birth, email, active) values ('Larissa Alves', '12345678911', '123456789', '000000000', '000000000', '2000-04-18', 'larissa-alves24@gmail.com', 0);

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
    
    include('./database/connection.php');


    $sql = "SELECT * from clients ORDER BY isActive DESC";
    $result = mysqli_query($conn, $sql);
    $clients = mysqli_fetch_all($result, MYSQLI_ASSOC);
    
    $conn->close();

?>

<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="/assets/styles/ballon.css">
    <link rel="stylesheet" href="/assets/styles/global.css">
    <link rel="stylesheet" href="/assets/styles/homeStyles.css">

    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
    <script defer src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/gh/StephanWagner/jBox@v1.2.0/dist/jBox.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/gh/StephanWagner/jBox@v1.2.0/dist/jBox.all.min.css" rel="stylesheet">
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <script defer src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script defer type="text/javascript" src="./utils/jquery.mask.min.js"></script>
    <script defer type="text/javascript" src="./utils/masks.js"></script>
    <script defer type="text/javascript" src="./utils/req.js"></script>
    <title>C.R.U.D - Home</title>
</head>
<body>
    <nav>
        <div class="nav-wrapper">
            <img src="./assets/imgs/kabumLogo.png" class="brand-logo right logo-kabum" alt="Logo do KaBuM!" >
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
                                <td class="cpf"><?php echo htmlspecialchars($client['cpf']); ?></td>
                                <td class="rg"><?php echo htmlspecialchars($client['cpf']); ?></td>
                                <td class="cel"><?php echo htmlspecialchars($client['telephone1']); ?></td>
                                <td class="cel"><?php echo htmlspecialchars($client['telephone2']); ?></td>
                                <td class="birth"><?php echo htmlspecialchars($client['birth']); ?></td>
                                <td><?php echo htmlspecialchars($client['email']); ?></td>
                                <td>
                                    <i class="fas fa-pencil-alt pencil-icon"></i>
                                    <i data-id="<?php echo $client['id']; ?>" class="tooltip fas fa-circle delete-button confirm <?php echo $client['isActive'] ? 'active' : 'inactive'?>"></i>
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