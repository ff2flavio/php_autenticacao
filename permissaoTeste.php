<?php 
session_start();
include './autenticacao.class.php';
include './conf.inc.php';
$conf = new Conf();
$conf->conectar();
$aut = new Autenticacao();
if(!isset($_SESSION["dados"])){
    echo "Você precisa efetuar o login";
    //header("Location: index.php");
    exit();
}
//Pegar via GET a acao da página
isset($_GET['acao']) ? $acao = $_GET['acao'] : $acao = "";
//Verificar se tem permissão
if (!$aut->verPermissao($acao, 1)){
    echo" <script> window.alert('Você não tem permissão para acessar a página!');
                    javascript:history.go(-1)
          </script>
        ";
    exit();
} 
echo "Você acessou a página seja bem vindo: ";
$dados = $_SESSION['dados'];
echo $dados['usuario'];
?>
