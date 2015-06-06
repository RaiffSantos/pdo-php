<?php

abstract class Abstrata extends Conexao {

    protected static $tabela;
    protected static $campoTabela;
    protected static $campoEscolhido;
    private $id;
    private $erro;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getCampoEscolhido() {
        return $this->campoEscolhido;
    }

    public function setCampoEscolhido($campoEscolhido) {
        $this->campoEscolhido = $campoEscolhido;
    }
    
    public function getErro(){
        return $this->erro;
    }
    public function setErro($erro){
        $this->erro = $erro;
    }

    protected function listar() {

        $pdo = parent::getDB();
        try {
            $listar = $pdo->prepare("SELECT * FROM " . self::$tabela);
            $listar->execute();

            if ($listar->rowCount() > 0):
                return $listar->fetchAll(PDO::FETCH_ASSOC);
            else:
                return false;
            endif;
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
        }
    }

    protected function deletar() {

        $pdo = parent::getDB();
        try {
            $deletar = $pdo->prepare("DELETE FROM " . self::$tabela . " WHERE " . self::$campoTabela . " = :id");
            $deletar->bindValue(":id", $this->getId());
            $deletar->execute();

            if ($deletar->rowCount() == 1):
                return true;
            else:
                return false;
            endif;
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
        }
    }

    protected function existeCadastro() {

        $pdo = parent::getDB();
        try {
            $verifica = $pdo->prepare("SELECT * FROM " . self::$tabela . " WHERE " . self::$campoTabela . " = :campoEscolhido");
            $verifica->bindValue(":campoEscolhido", self::$campoEscolhido);
            $verifica->execute();

            if ($verifica->rowCount() > 0):
                return true;
            else:
                return false;
            endif;
            
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
        }
    }
    
    public function testeCampo($nome, $valor){
        
        if(empty($valor)):
            return $this->erro = "o campo ".$nome." e obrigatorio!";
        endif;
    }
    
    public function validaEmail($email){
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)):
            return $this->erro = "O email nao e valido";
        endif;
    }

}
