<?php
    /*INSERT INTO clients (name, cpf, rg, telephone1, telephone2, birth, email, isactive) values ('Larissa Alves', '12345678911', '123456789', '000000000', '000000000', '2000-04-18', 'larissa-alves24@gmail.com', 0);
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
        user_id int NOT NULL,
        FOREIGN KEY(user_id) REFERENCES users(id),
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
        main_address boolean DEFAULT FALSE,
        FOREIGN KEY(client_id) REFERENCES clients(id),
        PRIMARY KEY (id)
    );

    CREATE TABLE users(
        id int NOT NULL AUTO_INCREMENT,
        login varchar(30) NOT NULL,
        password varchar(255) NOT NULL,
        name varchar(100) NOT NULL,
        access int DEFAULT 1,
        email varchar(255) NOT NULL,
        PRIMARY KEY (id)
    );

    */
    
    include('./database/connection.php');
    include('./token/auth.php');
    
    if(!isset($_COOKIE['token'])) header('Location: login.php') && exit();

    $token = $_COOKIE['token'];
    
    $userData = validateToken($token);

    $userId = mysqli_real_escape_string($conn, $userData['id']);
    $access = mysqli_real_escape_string($conn, $userData['access']);
    $name = mysqli_real_escape_string($conn, $userData['name']);

    $where = ($access == 1) ? "WHERE clt.user_id = '$userId'" : "";

    $sql =
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
        $where
        ORDER BY clt.isActive DESC
        ";

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
        <?php if($access > 1) { ?>
            <a href="/pages/users.php" class="waves-effect waves-light btn add-btn">Usuários</a>
        <?php } ?>
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
                <button style="margin-top: 25px;" onclick="window.location.href = '/'" class="waves-effect waves-light btn">Limpar filtro</button>
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
                            <th>E-mail</th>
                            <th>Responsável</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
        
                    <tbody>
                        <?php foreach($clients as $client){ 
                            $status = $client['isActive'] ? 'active-icon' : 'inactive-icon'; 
                        ?>
                            <tr>
                                <td><?php echo htmlspecialchars($client['id']); ?></td>
                                <td><?php echo htmlspecialchars($client['name']); ?></td>
                                <td class="cpf"><?php echo htmlspecialchars($client['cpf']); ?></td>
                                <td class="rg"><?php echo htmlspecialchars($client['rg']); ?></td>
                                <td><?php echo htmlspecialchars($client['email']); ?></td>
                                <td><?php echo htmlspecialchars($client['userName']); ?></td>
                                <td>
                                    <i data-id="<?php echo $client['id']; ?>" class="fas fas fa-eye info-client modal-trigger" href="#info-modal"></i>
                                    <i data-id="<?php echo $client['id']; ?>" class="fas fa-pencil-alt pencil-icon edit-client"></i>
                                    <i data-id="<?php echo $client['id']; ?>" class="fas fa-circle delete-button delete-client <?php echo $client['isActive'] ? 'active-icon' : 'inactive-icon'?>"></i>
                                    <i data-id="<?php echo $client['id']; ?>" class="fas fa-map-marker-alt address-icon address-client"></i>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        <?php } ?>
    </div>

    <div id="info-modal" class="modal info-modal flex-container">
        <div id="title-modal">
            <span class="right-align">Informações do cliente</span>
        </div>
        <div id="modal-content">
            <p>Nome: <span id="modal-name" class="name"></span></p>
            <p>CPF: <span class="cpf"></span></p>
            <p>RG: <span class="rg"></span></p>
            <p>Data de nascimento: <span class="birth"></span></p>
            <p>E-mail: <span class="email"></span></p>
            <p>Telefone 1: <span class="cel cel1"></span></p>
            <p>Telefone 2: <span class="cel cel2"></span></p>
            <p>Endereço principal:</p>
            <p><span class="street"></span><span class="number"></span></p>
            <p><span class="neighbourhood"></span><span class="cep"></span></p>
            <p><span class="complement"></span></p>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-green btn-flat">Fechar</a>
        </div>
    </div>

</body>
</html>