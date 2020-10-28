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
        isActive boolean DEFAULT TRUE,
        PRIMARY KEY (id)
    );

    CREATE TABLE addresses(
        id int NOT NULL AUTO_INCREMENT,
        neighbourhood varchar(255) NOT NULL,
        street varchar(255) NOT NULL,
        number varchar(10) NOT NULL,
        complement varchar(255) NOT NULL,
        zipcode varchar(8) NOT NULL,
        city varchar(100) NOT NULL,
        uf varchar(2) NOT NULL,
        client_id int NOT NULL,
        FOREIGN KEY(client_id) REFERENCES clients(id),
        PRIMARY KEY (id)
    );
    */
    
    include('./database/connection.php');
    $sql = "SELECT 
        id, name, cpf, rg, telephone1, telephone2, birth, email, isActive 
        from clients 
        ORDER BY isActive DESC";

    include('./filter.php');


    $result = mysqli_query($conn, $sql) or die();
    $clients = mysqli_fetch_all($result, MYSQLI_ASSOC);
    
    $conn->close();

?>

<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="/assets/styles/global.css">
    <link rel="stylesheet" href="/assets/styles/homeStyles.css">
    
    <?php include('./headers/cdn.php') ?>
    
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

    <script defer type="text/javascript" src="./utils/jquery.mask.min.js"></script>
    <script defer type="text/javascript" src="./utils/utils.js"></script>
    <script defer type="text/javascript" src="./utils/req.js"></script>

    <title>C.R.U.D - Home</title>
</head>
<body>
    
    <?php include('./headers/nav.php') ?>

    <div class="content">

        <h1 class="table-title">Clientes</h1>
        <a href="/pages/insert.php" class="waves-effect waves-light btn add-btn">Adicionar cliente</a>

        <div class="row">
            <form action="/index.php" method="get">
                <div class="input-field col s2">
                    <select id="filter" name="filter" required>
                        <option disabled selected>Escolha uma opção</option>
                        <option value="name">Nome</option>
                        <option value="cpf">CPF</option>
                        <option value="rg">RG</option>
                        <option value="email">E-mail</option>
                    </select>
                    <label for="filter">Filtro</label>
                </div>

                <div class="input-field col s3">
                    <input id="search" name="search" type="text" minlength="3" required>
                    <label for="search">Pesquisa</label>
                </div>

                <button style="margin-top: 25px;" type="submit" class="waves-effect waves-light btn">Filtrar</button>
                <button style="margin-top: 25px;" onclick="window.location.href = '/';"class="waves-effect waves-light btn">Limpar filtro</button>
            </form>
        </div>

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
                                <td class="rg"><?php echo htmlspecialchars($client['rg']); ?></td>
                                <td class="cel"><?php echo htmlspecialchars($client['telephone1']); ?></td>
                                <td class="cel"><?php echo htmlspecialchars($client['telephone2']); ?></td>
                                <td class="birth"><?php echo htmlspecialchars($client['birth']); ?></td>
                                <td><?php echo htmlspecialchars($client['email']); ?></td>
                                <td>
                                    <i data-id="<?php echo $client['id']; ?>" class="fas fa-pencil-alt pencil-icon edit-client"></i>
                                    <i data-id="<?php echo $client['id']; ?>" class="fas fa-circle delete-button delete-client <?php echo $client['isActive'] ? 'active' : 'inactive'?>"></i>
                                    <i data-id="<?php echo $client['id']; ?>" class="fas fa-map-marker-alt address-icon address-client"></i>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        <?php } ?>
    </div>
</div>

</body>
</html>