<?php
require_once("classes/Conexao.php");
require_once("classes/Abstrata.php");
require_once("classes/Cliente.php");

if (isset($_POST['enviar'])):

    $cliente = new Cliente();

    if ($cliente->testeCampo("nome", $_POST['nome'])):
        echo $cliente->getErro();
    else:
        $cliente->setNomeCliente($_POST['nome']);
    endif;
    

    if ($cliente->testeCampo("email", $_POST['email'])):
        echo $cliente->getErro();
    else:
        if ($cliente->validaEmail($_POST['email'])):

            echo $cliente->getErro();
        else:
            $cliente->setEmailCliente($_POST['email']);
        endif;

    endif;


    if ($cliente->cadastrar()):
        echo "cliente cadastrado com sucesso!";
    else:
        echo "falha ao cadastrar cliente!";
    endif;

endif;
?>
<html>
    <head>
        <title>Formulario de Cadastro</title>
    </head>
    <body>
        <form action="" method="post">
            <label for="nome">Nome</label>
            <input type="text" name="nome" id="nome"><br />

            <label for="email">E-mail</label>
            <input type="text" name="email" id="email"><br />

            <input type="submit" name="enviar" id="enviar" value="Enviar">
        </form>
    </body>
</html>