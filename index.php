<?php
require_once('app/Models/Usuario.php');
require_once('app/Controllers/ControllerUsuario.php');

$usuarioDao = new ControllerUsuario();

if (!empty($_POST['nome']) && !empty($_POST['cpf']) && !empty($_POST['idade']) && !empty($_POST['voto'])) {
    $usuario = new Usuario($_POST['nome'], $_POST['cpf'], $_POST['idade'], $_POST['voto']);

    //Obter informações da variável
    $usuario->validarDados();
    
    if (empty($usuario->erro)) {
        $class = "alert-success";
        $usuarioDao->createUsuario($usuario);
    } else {
        $class = "alert-danger";
    }
}




?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votação</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-primary p-5">
    <!--<div class="container border border-2 bg-primary p-5"> -->
    <div class="container border border-2 rounded-4 p-4 bg-white mb-5" style="max-width: 500px;">
        <!--formulário-->
        <form method="POST">
            <h1 class="mb-4 text-center">Votação</h1>
            <div class="row">
                <div class="mb-3">
                    <label for="nome" class="form-label fw-bold">Nome do eleitor</label>
                    <input type="text" name="nome" class="form-control form-control-lg bg-light" value="" required>
                </div>

                <div class="mb-3">
                    <label for="cpf" class="form-label fw-bold">CPF</label>
                    <input type="text" name="cpf" class="form-control form-control-lg bg-light" value="" required>
                </div>

                <div class="mb-3">
                    <label for="idade" class="form-label fw-bold">Idade</label>
                    <input type="text" name="idade" class="form-control form-control-lg bg-light" value="" required>
                </div>

                <div class="mb-3">
                    <label for="bill" class="fs-3 fw-semibold">
                        <img src="img/bill.jpg" width="80px">
                        <input type="radio" class="form-check-input mt-4" name="voto" id="bill" value="13" required> Bill Gates </label>
                </div>

                <div class="mb-3">
                    <label for="mark" class="fs-3 fw-semibold">
                        <img src="img/mark.jpg" width="80px">
                        <input type="radio" class="form-check-input mt-4" id="mark" name="voto" value="22" required> Mark Zuckenberg </label>
                </div>
            </div>
            <div class="d-grid mb-4">
                <input type="submit" value="VOTAR" class="btn btn-primary btn-lg">
            </div>

            <?php if (isset($usuario)) { ?>
                <div class="alert text-center fs-4 <?php echo $class ?>" role="alert">
                    <span><?php echo $usuario->getMsg(); ?></span>
                </div>
            <?php } ?>
        </form>
    </div>

    <div class="d-grid mb-1">
        <a href="relatorio.php" class="btn btn-primary">Registros</a>
    </div>

</body>

</html>