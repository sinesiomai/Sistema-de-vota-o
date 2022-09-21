<?php
require_once('app/Models/Usuario.php');
require_once('app/Controllers/ControllerUsuario.php');

$usuarioDao = new ControllerUsuario();

if (!empty($_POST['nome']) && !empty($_POST['cpf']) && !empty($_POST['idade']) && !empty($_POST['voto'])) {
    $usuario = new Usuario($_POST['nome'], $_POST['cpf'], $_POST['idade'], $_POST['voto']);

    //var_dump($usuario); //Obter informações da variável
    $usuario->validarDados();
    $usuarioDao->createUsuario($usuario);

    
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

<body>
    <?php if ($usuarioDao->readUsuario()) { ?>
        <div class="container">
            <h1>Registros</h1>
            <table class="table table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Nome</th>
                        <th>Cpf</th>
                        <th>Idade</th>
                        <th>Voto</th>
                        <th>Data de Registro</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($usuarioDao->readUsuario() as $usuarios) { ?>
                        <tr>
                            <td><?php echo $usuarios["nome"]; ?></td>
                            <td><?php echo $usuarios["cpf"]; ?></td>
                            <td><?php echo $usuarios["idade"]; ?></td>
                            <td><?php echo $usuarios["voto"]; ?></td>
                            <td><?php echo date('d/m/Y', strtotime($usuarios["data_registro"])); ?></td>
                        <?php } ?>
                        </tr>
                </tbody>
            </table>
        </div>
    <?php } ?>


</body>

</html>