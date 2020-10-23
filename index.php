<?php

    include_once('./connection.php');
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
        <a href="/pages/insert/index.php" class="waves-effect waves-light btn add-btn">Adicionar cliente</a>
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
                    <tr>
                        <td>1</td>
                        <td>Víctor Rodrigues</td>
                        <td>000.000.000-00</td>
                        <td>00.000.000-0</td>
                        <td>0000-00000</td>
                        <td>0000-00000</td>
                        <td>xx/xx/xxxx</td>
                        <td>victordeoliveira.contato@gmail.com</td>
                        <td>
                            <i class="fas fa-pencil-alt pencil-icon"></i>
                            <i class="fas fa-trash-alt trash-icon"></i>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Víctor Rodrigues</td>
                        <td>000.000.000-00</td>
                        <td>00.000.000-0</td>
                        <td>0000-00000</td>
                        <td>0000-00000</td>
                        <td>xx/xx/xxxx</td>
                        <td>victordeoliveira.contato@gmail.com</td>
                        <td>
                            <i class="fas fa-pencil-alt pencil-icon"></i>
                            <i class="fas fa-trash-alt trash-icon"></i>
                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Víctor Rodrigues</td>
                        <td>000.000.000-00</td>
                        <td>00.000.000-0</td>
                        <td>0000-00000</td>
                        <td>0000-00000</td>
                        <td>xx/xx/xxxx</td>
                        <td>victordeoliveira.contato@gmail.com</td>
                        <td>
                            <i class="fas fa-pencil-alt pencil-icon"></i>
                            <i class="fas fa-trash-alt trash-icon"></i>
                        </td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Víctor Rodrigues</td>
                        <td>000.000.000-00</td>
                        <td>00.000.000-0</td>
                        <td>0000-00000</td>
                        <td>0000-00000</td>
                        <td>xx/xx/xxxx</td>
                        <td>victordeoliveira.contato@gmail.com</td>
                        <td>
                            <i class="fas fa-pencil-alt pencil-icon"></i>
                            <i class="fas fa-trash-alt trash-icon"></i>
                        </td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>Víctor Rodrigues</td>
                        <td>000.000.000-00</td>
                        <td>00.000.000-0</td>
                        <td>0000-00000</td>
                        <td>0000-00000</td>
                        <td>xx/xx/xxxx</td>
                        <td>victordeoliveira.contato@gmail.com</td>
                        <td>
                            <i class="fas fa-pencil-alt pencil-icon"></i>
                            <i class="fas fa-trash-alt trash-icon"></i>
                        </td>
                    </tr>
                </tbody>
          </table>
        </div>
    </div>
</body>
</html>