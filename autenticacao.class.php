<?php
/*
 * Classe de autenticação de usuários
 * Criar tabela em um banco de dados com os seguintes campos:
 * id, usuario, senha, permissao
 * Dados serão armazenados na sessão
 */
class Autenticacao{
    //Função para limpar a string antes de inserir na query
    public function limpar($string){
        $var = trim($string);
        $var = addslashes($var);        
        return $var;
    }
    //Função que irá ver se o usuário e senha confere com o do banco. Retorna true ou false.
    public function logar(){
        //Pegando usuario e senha por method POST
        $usuario  = isset($_POST["usuario"]) ? $this->limpar($_POST["usuario"]) : "";
        $senha = isset($_POST["senha"]) ? $this->limpar($_POST["senha"]) : "";
        //Verificar se existe o usuario e senha no banco, caso exista setar a sessao!
        $sql = mysql_query("SELECT * FROM usuario WHERE usuario = '$usuario' AND senha = '$senha' AND ativo != 0") or die("<b>ERROR:</b> ".mysql_error());
        if(mysql_num_rows($sql) == 1){
            echo "Logar<br/>";
            $resultado = mysql_fetch_array($sql);
            $dados = array('usuario' => $usuario, 
                           'senha' => $senha, 
                           'id_grupo' => $resultado["id_grupo"], 
                           'id_usuario' => $resultado["id_usuario"]
                          );
            //setando a sessão dados com o array das informações do usuário
            $_SESSION["dados"] = $dados;
            $retorno = true;
        }else{
            $retorno = false;
        }
        return $retorno;
    }
    //Função para destruir a sessão
    public function sair(){
        session_start();
        $_SESSION["dados"] = null;
        session_destroy();
    }
    /*
     * Função para verificar permissão. Retorna true ou false.
     * Deverá ser passado os seguintes parâmetro: açao e o id do modulo/página
     * As ações passadas via GET deverão ser:
     * vis = Visualizar a página, insert = Inserir algo no módulo
     * edit = Editar informações do módulo e del = exluir
     */
    public function verPermissao($acao, $id_modulo){
        $dados = $_SESSION["dados"];
        $sql = mysql_query("SELECT * FROM permissao WHERE id_grupo = '".$dados['id_grupo']."' AND id_modulo = '$id_modulo' ") 
                           or die("<b>ERROR:</b> ".mysql_error());
        $resultado = mysql_fetch_array($sql);
        
        if($acao == "vis" || $acao == ""){
            $retorno = $resultado['visualizar'];
        }else if($acao == "insert"){
            $retorno = $resultado['inserir'];
        }else if($acao == "edit"){
            $retorno = $resultado['editar'];
        }else if($acao == "del"){
            $retorno = $resultado['excluir'];
        }
        
        return $retorno;
    }
}
?>
