<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script defer src='https://kit.fontawesome.com/a076d05399.js'></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"el="stylesheet">
    <script defer src="../../js/insertjs.js"></script>
    <link rel="stylesheet" href="/assets/global.css">
    <link rel="stylesheet" href="/assets/insertStyles.css">
    <title>C.R.U.D - Insert</title>
</head>
<body>
    <nav>
        <div class="nav-wrapper">
            <img src="../../assets/kabumLogo.png" class="brand-logo right logo-kabum" alt="Logo do KaBuM!" >
        </div>
    </nav>

    <div class="row container">
        <span>Insira os dados</span>
        <form class=" col s12 offset-s1" method="POST" action="insertClient.php">
            <div class="row">
                <div class="input-field col s10">
                    <input id="name" name="name" type="text" class="validate" onkeypress="return !(/[0-9!@#$%¨&*)(-+*/><_-]/i.test(event.key))" required>
                    <label for="name">Nome</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s10">
                    <input id="email" name="email" type="email" class="validate" required>
                    <label for="email">E-mail</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s10 input-number">
                    <input id="birth" name="birth" type="text" class="datepicker" required>
                    <label for="birth">Data de nascimento (aaaa-mm-dd)</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s5 input-documents">
                    <input id="cpf" name="cpf" type="text" minlength="11" maxlength="11" class="validate" onkeypress="return (/[0-9]/i.test(event.key))" required>
                    <label for="cpf">CPF</label>
                </div>
                <div class="input-field col s5 input-documents">
                    <input id="rg" name="rg" type="text" minlength="11" maxlength="11"  class="validate" onkeypress="return (/[0-9]/i.test(event.key))">
                    <label for="rg">RG</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s5 input-documents">
                    <input id="telephone1" name="telephone1" minlength="9" maxlength="9" type="tel" class="validate" onkeypress="return (/[0-9]/i.test(event.key))" required>
                    <label for="telephone1">Telefone 1</label>
                </div>
                <div class="input-field col s5 input-number">
                    <input id="telephone2" name="telephone2" minlength="9" maxlength="9" type="tel" class="validate" onkeypress="return (/[0-9]/i.test(event.key))" required>
                    <label for="telephone2">Telefone 2</label>
                </div>
            </div>
            <div class="row form-flex">
                <button class="btn waves-effect waves-light" type="submit">Enviar</button>
                <a class="btn waves-effect waves-light" href="../../index.php" >Voltar</a> 
            </div>
        </form>
    </div>
</body>
</html>