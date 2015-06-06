<?php

include_once"interfaces/iCRUD.php";

class Cliente extends Abstrata implements iCRUD {

    private $nomeCliente;
    private $emailCliente;
    private $idCliente;

    public function getNomeCliente() {
        return $this->nomeCliente;
    }

    public function setNomeCliente($nomeCliente) {
        $this->nomeCliente = $nomeCliente;
    }

    public function getEmailCliente() {
        return $this->emailCliente;
    }

    public function setEmailCliente($emailCliente) {
        $this->emailCliente = $emailCliente;
    }

    public function getIdCliente() {
        return $this->idCliente;
    }

    public function setIdCliente($idCliente) {
        $this->idCliente = $idCliente;
    }

    public function listar() {
        parent::$tabela = "cliente";
        return parent::listar();
    }

    public function alterar() {

        $pdo = parent::getDB();
        try {
            $alterar = $pdo->prepare("UPDATE cliente SET cliente_nome = :nome, cliente_email = :email WHERE cliente_id = :id");
            $alterar->bindValue(":nome", $this->getNomeCliente());
            $alterar->bindValue(":email", $this->getEmailCliente());
            $alterar->bindValue(":id", $this->getIdCliente());
            $alterar->execute();

            if ($alterar->rowCount() == 1):
                return true;
            else:
                return false;
            endif;
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
        }
    }

    public function deletar() {
        parent::$campoTabela = "cliente_id";
        parent::$tabela = "cliente";
        return parent::deletar();
    }

    public function cadastrar() {

        $pdo = parent::getDB();

        try {
            parent::$tabela = "cliente";
            parent::$campoTabela = "cliente_nome";
            parent::$campoEscolhido = $this->getNomeCliente();

            if ($this->existeCadastro()):
                return false;
            else:

                $cadastrar = $pdo ->prepare("INSERT INTO cliente(cliente_id, cliente_nome, cliente_email) 
                                                    VALUES(null, :nome, :email)");
                $cadastrar->bindValue(":nome", $this->getNomeCliente());
                $cadastrar->bindValue(":email", $this->getEmailCliente());
                $cadastrar->execute();

                if ($cadastrar->rowCount() == 1):
                    return true;
                else:
                    return false;
                endif;

            endif;
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
        }
    }
    

}
