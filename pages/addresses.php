<?php

    include('../token/auth.php');
    include('../api/user/authenticate.php');
    
    if(!isset($_GET['id'])) die(header('location: /'));
    
    include('../database/connection.php');
    
    $clientId = $_GET['id'];
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    $sql = "SELECT name FROM clients WHERE id = '$clientId'";
    $result = mysqli_query($conn, $sql);
    $client = mysqli_fetch_array($result, MYSQLI_ASSOC);
    
    $sql = "SELECT 
                adr.id, 
                adr.street, 
                adr.number, 
                adr.neighbourhood, 
                adr.city, 
                adr.uf, 
                adr.zipcode, 
                adr.complement,
                adr.main_address
            FROM addresses adr
            JOIN clients clt
                ON adr.client_id = clt.id
            WHERE clt.id = '$clientId'
            ORDER BY adr.main_address DESC
            ";

    $result = mysqli_query($conn, $sql);
    $addresses = mysqli_fetch_all($result, MYSQLI_ASSOC);
    
    $conn->close();
?>


<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
        
        <?php include('../headers/cdn.php'); ?>
        

        <script defer src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.js"></script>
        <script defer type="text/javascript" src="../utils/jquery.mask.min.js"></script>
        <script defer type="text/javascript" src="../utils/utils.js"></script>
        <script defer type="text/javascript" src="../utils/validation.js"></script>
        <script defer type="text/javascript" src="../utils/req.js"></script>
        <script defer type="text/javascript" src="../utils/cep.js"></script>

        <link rel="stylesheet" href="../assets/styles/global.css">
        <link rel="stylesheet" href="../assets/styles/addressStyles.css">
        <title>C.R.U.D - Addresses</title>
    </head>
    <body>
    
    <?php include('../headers/nav.php') ?>

    <div class="content">

        <h1 class="table-title">Endereços do cliente <?php echo $client['name'] ?></h1>
        <a class="waves-effect waves-light btn modal-trigger" href="#modal1">Adicionar</a>
        <a class="waves-effect waves-light btn" href="/">Voltar</a>

        <div class="input-field row ">
            <?php foreach($addresses as $address){ ?>
                <div class="col s3">
                    <div class="card horizontal">
                        <label style="position: absolute; z-index: 2;">
                            <input data-id="<?php echo $address['id']?>" name="group1" type="radio" class="main-address" <?php echo $address['main_address'] ? 'checked="true" disabled="true"' : '' ?> />
                            <span>Principal</span>
                        </label>
                        <div class="icons">
                            <i data-id="<?php echo $address['id']?>"  class="fas fa-pencil-alt pencil-icon address-edit modal-trigger" href="#modal1"></i>
                            <i data-id="<?php echo $address['id']?>" class="fas fa-trash-alt trash-icon"></i>
                        </div>
                        <div class="card-stacked">
                            <div class="card-content">
                                <p><?php echo $address['street']?>, <?php echo $address['number']?></p>
                                <p><?php echo $address['neighbourhood']?> - <?php echo $address['zipcode']?></p>
                                <p><?php echo $address['complement']?></p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

    <div id="modal1" class="modal">
        <div id="address-modal">
            <form id="address-form">
                <div id="address-title">
                    <span style="margin-left: 10px;">Inserir endereço</span>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input
                            name="cep" 
                            type="text" 
                            id="cep" 
                            value="" 
                            size="10" 
                            maxlength="9"
                        >
                        <label>CEP</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s9">
                        <input 
                            name="street" 
                            type="text" 
                            id="street" 
                            size="60"
                        >
                        <label>Rua</label>
                    </div>
                    <div class="input-field col s3">
                        <input 
                            name="number" 
                            type="text" 
                            id="number" 
                            size="60"
                        >
                        <label>Número</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input 
                            name="neighbourhood" 
                            type="text" 
                            id="neighbourhood" 
                            size="40" 
                        >
                        <label>Bairro</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s9">
                        <input 
                            name="city" 
                            type="text" 
                            id="city" 
                        >
                        <label>Cidade</label>
                    </div>
                    <div class="input-field col s3">
                        <input 
                            name="uf" 
                            type="text" 
                            id="uf" 
                            size="2"
                        >
                        <label>Estado</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <textarea id="complement" name="complement" class="materialize-textarea"></textarea>
                        <label for="complement">Complemento</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn waves-effect waves-light address-submit-btn" >Enviar</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        let clientId = <?php echo $clientId ?>;
    </script>
</body>
</html>