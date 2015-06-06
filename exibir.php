<?php
require_once("classes/Conexao.php");
require_once("classes/Abstrata.php");
require_once("classes/Cliente.php");
//require_once("interfaces/iCRUD.php");


$cliente = new Cliente();

if (isset($_GET['ac'])):
    
    // EDITA CLIENTE
    if ($_GET['ac'] == 'alterar'):
        $cliente->setNomeCliente("Jose");
        $cliente->setEmailCliente("jose@email.com");
        $cliente->setIdCliente($_GET['id']);

        if ($cliente->alterar()):
            echo "cliente alterado com sucesso";
        else:
            echo "falha ao alterar cliente";
        endif;

    // DELETA CLIENTE
    elseif ($_GET['ac'] == 'deletar'):
        $cliente->setId($_GET['id']);
        if($cliente->deletar()):
            echo "cliente deletado com sucesso";
        else:
            echo "falha ao deletar cliente";
        endif;
        
    // CADASTRA CLIENTE
    elseif($_GET['ac'] == 'cadastrar'):
        
        $cliente->setNomeCliente("joao");
        $cliente->setEmailCliente("email.joao@gmail.com");
        if($cliente->cadastrar()):
            echo "o cliente foi cadastrado";
        else:
            echo "falha ao cadastrar cliente";
        endif;
        
    endif;

endif;

$dados = $cliente->listar();
?>

<table border='1'>

    <tr>
        <td>Nome</td>
        <td>E-mail</td>
        <td>Alterar</td>
        <td>deletar</td>
        <td><a href="exibir.php?ac=cadastrar">cadastrar</a></td>
    </tr>
    <?php 
    if(!empty($dados)):
    foreach ($dados as $cli): ?>
        <tr>
            <td><?php echo $cli['cliente_nome'] ?></td>
            <td><?php echo $cli['cliente_email'] ?></td>
            <td><a href="exibir.php?ac=alterar&id=<?php echo $cli['cliente_id']; ?>">alterar</a></td>
            <td><a href="exibir.php?ac=deletar&id=<?php echo $cli['cliente_id']; ?>">deletar</a></td>
        </tr>
    <?php endforeach;
    else: ?>
        <tr>
            <td colspan="5"><?php echo "nenhum cliente cadastrado!"; ?></td>
        </tr>
    
    <?php
    endif;
    
    ?>
</table>

