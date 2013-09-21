<?php session_start(); 
      header("Content-Type: text/html; charset=utf-8",true);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Autenticação</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    </head>
    <body>
<?php
    include './conf.inc.php';
    include './autenticacao.class.php';
    $conf = new Conf();
    $conf->conectar();
?>
        <form method="POST" action="index.php">
            <label>USUARIO: <input type="text" name="usuario"/></label>
            <label>SENHA: <input type="password" name="senha"/></label>
            <input type="submit" value="OK" />
        </form>   
<?php    
    $aut = new Autenticacao();
    
    if($aut->logar() && !isset($_SESSION["dados"])){
        echo "<br/>ENTROU<br/>";
    }else{
        echo "Usuário ou senha não conferem!";
    }
    $dados = $_SESSION["dados"];
    echo "<br/>Usuário: ";
    echo $dados["usuario"];
?>
        <br/>
        <a href="permissaoTeste.php?acao=vis">Pagina teste</a>
        <br/>
        <a href="sairTeste.php">SAIR</a>
    </body>
</html>
