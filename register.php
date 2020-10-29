<?php

?>


<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="/assets/styles/global.css">
    <link rel="stylesheet" href="/assets/styles/registerStyles.css">
    
    <?php include('./headers/cdn.php') ?>
    
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

    <?php include('./headers/cdn.php'); ?>
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.js"></script>
    <script defer type="text/javascript" src="./utils/jquery.mask.min.js"></script>
    <script defer type="text/javascript" src="./utils/utils.js"></script>
    <script defer type="text/javascript" src="./utils/req.js"></script>
    <script defer type="text/javascript" src="./utils/validation.js"></script>

    <title>C.R.U.D - Home</title>
</head>
<body>
    
    <?php include('./headers/nav.php') ?>

    <div class="valign-wrapper">
        <div class="row container s12 m6 offset-m3">
            <div class="register-header">
                <div class="logo-div">
                    <img class='responsive-img circle logo-circle' src="./assets/imgs/kabumCircle.jpeg" alt="Logo KaBuM! Circle">
                </div>
                <p>Crie sua conta</p>
            </div>
            <form id="register-form" class=" col s11 offset-s1">
                <div class="row s12">
                    <div class="col s12">
                        <i class="fas fa-user-circle register-icons"></i>
                        <div class="input-field inline s12">
                            <input 
                                id="name" 
                                name="name" 
                                type="text" 
                                class="validate" 
                                required
                            >
                            <label for="name">Nome</label>
                        </div>
                    </div>
                </div>
                <div class="row s12">
                    <div class="col s12">
                        <i class="fas fa-user-circle login-icons"></i>
                        <div class="input-field inline s12">
                            <input 
                                id="email" 
                                name="email" 
                                type="email" 
                                class="validate" 
                                required
                            >
                            <label for="email">E-mail</label>
                        </div>
                    </div>
                </div>
                <div class="row s12">
                    <div class="col s12">
                        <i class="fas fa-user-circle login-icons"></i>
                        <div class="input-field inline s12">
                            <input 
                                id="login" 
                                name="login" 
                                type="text" 
                                class="validate" 
                                required
                            >
                            <label for="login">Login</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12">
                        <i class="fas fa-lock login-icons"></i>
                        <div class="input-field inline s12">
                            <input 
                                id="password" 
                                name="password" 
                                type="password" 
                                class="validate" 
                                required
                            >
                            <label for="password">Senha</label>
                        </div>
                    </div>
                </div>
                <div class="row register-btn">
                    <button class="btn waves-effect waves-light" type="submit">Registrar</button>
                    <a class="btn waves-effect waves-light" href="/login.php">Voltar</a>
                </div>
            </form>
        </div>
    </div>


</body>
</html>