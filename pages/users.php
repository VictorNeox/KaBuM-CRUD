<?php
    
    include('../database/connection.php');
    include('../token/auth.php');
    if(isset($_COOKIE['token'])) 
    {
        $token = $_COOKIE['token'];
        
        $userData = validateToken($token);

        $userId = mysqli_real_escape_string($conn, $userData['id']);
        $access = mysqli_real_escape_string($conn, $userData['access']);
        $name = mysqli_real_escape_string($conn, $userData['name']);

        if($access > 1) 
        {
            $sql = "SELECT id, name, access, email 
                    FROM users
                    ORDER BY access DESC
            ";
        }
        else 
        {
            header('Location: /');
            exit();
        }

        $result = mysqli_query($conn, $sql) or die();
        $users = mysqli_fetch_all($result, MYSQLI_ASSOC);
        
        $conn->close();
        
    } else 
    {
        header('Location: /login.php');
    }
?>

<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../assets/styles/global.css">
    <link rel="stylesheet" href="../assets/styles/homeStyles.css">
    <link rel="stylesheet" href="../assets/styles/usersStyles.css">
    
    <?php include('../headers/cdn.php') ?>
    
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

    <script defer type="text/javascript" src="../utils/jquery.mask.min.js"></script>
    <script defer type="text/javascript" src="../utils/utils.js"></script>
    <script defer type="text/javascript" src="../utils/req.js"></script>

    <title>C.R.U.D - Home</title>
</head>
<body>
    
    <?php include('../headers/nav.php') ?>

    <div class="content">

        <h1 class="table-title">Usuários</h1>

        <div class="row">
            <a style="margin-top: 25px;" href="/" class="waves-effect waves-light btn">Voltar</a>
        </div>

        <?php if(empty($users)) { ?>
            <h1 class="non-user">Nenhum usuário cadastrado!</h1>
        <?php } else { ?>
            <div class="table-content">
                <table class="striped responsive-table centered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Nível de Acesso</th>
                            <th>E-mail</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach($users as $user){ ?>
                            <tr>
                                <td><?php echo htmlspecialchars($user['id']); ?></td>
                                <td><?php echo htmlspecialchars($user['name']); ?></td>
                                <td style="width: 200px;">
                                    <select class="access-select" name="access-select" data-id="<?php echo $user['id'] ?>" >
                                        <option value="1" <?php echo $user['access'] == 1 ? 'selected="true"' : '' ?> >Usuário</option>
                                        <option value="2" <?php echo $user['access'] == 2 ? 'selected="true"' : '' ?> >Administrador</option>
                                    </select>
                                </td>
                                <td><?php echo htmlspecialchars($user['email']); ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        <?php } ?>
    </div>

</body>
</html>