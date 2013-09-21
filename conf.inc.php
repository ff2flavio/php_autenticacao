<?php
class Conf {
    private $conexao;
    private $servidor = "localhost";
    private $usuario = "root";
    private $senha = "";
    private $banco = "geral";

    public function conectar(){
        $this->conexao = mysql_connect($this->servidor,$this->usuario,$this->senha);
        if ($this->conexao){ 
            mysql_select_db($this->banco); 
        }else{
            echo "Erro ao conectar no servidor";
        }
    }
    public function desconectar(){
        mysql_close($this->conexao);
    }
}
?>