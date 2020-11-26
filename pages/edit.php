<?php

    include('../database/connection.php');
    
    include('../token/auth.php');
    include('../api/user/authenticate.php');

    if(!isset($_GET['id'])) die(header('location: /'));

    $userId = mysqli_real_escape_string($conn, $userData['id']);
    $userAccess = mysqli_real_escape_string($conn, $userData['access']);

    $clientId = mysqli_real_escape_string($conn, $_GET['id']);

    $where = ($userAccess < 2) ? "AND user_id = '$userId'" : "";

    $sql = "SELECT * FROM clients where id = '$clientId' $where";


    $result = mysqli_query($conn, $sql) or die();

    $client = mysqli_fetch_array($result, MYSQLI_ASSOC);
    
    if(!$client) header('location: /') && die();
    
    $conn->close();
?>


<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
        
        <?php include('../headers/cdn.php'); ?>

        <script defer type="text/javascript" src="../utils/utils.js"></script>
        <script defer src="../utils/req.js"></script>

        <link rel="stylesheet" href="/assets/styles/global.css">
        <link rel="stylesheet" href="/assets/styles/insertEditStyles.css">
        <title>C.R.U.D - Edit</title>
    </head>
    <body>
    <?php include('../headers/nav.php'); ?>

    <div class="row container">
        <span>Modifique os dados</span>
        <form class=" col s12 offset-s1" id="form">
            <div class="row">
                <div class="input-field col s10">
                    <input 
                        id="name" 
                        name="name" 
                        type="text" 
                        value="<?php echo $client['name']; ?>" 
                        class="validate" 
                        onkeypress="return !(/[0-9!@#$%¨&*)(-+*/><_-]/i.test(event.key))" 
                        required
                    >
                    <label for="name">Nome</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s10">
                    <input 
                        id="email" 
                        name="email" 
                        type="email" 
                        value="<?php echo $client['email']; ?>" 
                        class="validate" 
                        required
                    >
                    <label for="email">E-mail</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s10 input-number">
                    <input 
                        id="birth" 
                        name="birth" 
                        type="text" 
                        value="<?php echo $client['birth']; ?>" 
                        class="datepicker" 
                        required
                    >
                    <label for="birth">Data de nascimento (aaaa-mm-dd)</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s5 input-documents">
                    <input 
                        id="cpf" 
                        name="cpf" 
                        type="text" 
                        value="<?php echo $client['cpf']; ?>" 
                        minlength="11" 
                        maxlength="11" 
                        class="validate" 
                        onkeypress="return (/[0-9]/i.test(event.key))" 
                        required
                    >
                    <label for="cpf">CPF</label>
                </div>
                <div class="input-field col s5 input-documents">
                    <input 
                        id="rg" 
                        name="rg" 
                        type="text" 
                        value="<?php echo $client['rg']; ?>" 
                        minlength="9" 
                        maxlength="9"  
                        class="validate" 
                        onkeypress="return (/[0-9]/i.test(event.key))"
                    >
                    <label for="rg">RG</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s5 input-documents">
                    <input 
                        id="telephone1" 
                        name="telephone1" 
                        value="<?php echo $client['telephone1']; ?>" 
                        minlength="9" 
                        maxlength="9" 
                        type="tel" 
                        class="validate" 
                        onkeypress="return (/[0-9]/i.test(event.key))" 
                        required
                    >
                    <label for="telephone1">Telefone 1</label>
                </div>
                <div class="input-field col s5 input-number">
                    <input 
                        id="telephone2" 
                        name="telephone2" 
                        value="<?php echo $client['telephone2']; ?>"
                        minlength="9" 
                        maxlength="9" 
                        type="tel" 
                        class="validate" 
                        onkeypress="return (/[0-9]/i.test(event.key))" 
                        required
                    >
                    <label for="telephone2">Telefone 2</label>
                </div>
            </div>
            <div class="row form-flex">
                <a class="btn waves-effect waves-light" href="/index.php" >Voltar</a> 
                <button class="btn waves-effect waves-light edit-submit" data-id="<?php echo $clientId ?>" name="submit">Enviar</button>
            </div>
        </form>
    </div>
    <script>
        let clientId = <?php echo $clientId ?>;
    </script>
</body>
</html>