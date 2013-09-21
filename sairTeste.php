<?php
include './autenticacao.class.php';
$aut = new Autenticacao();
$aut->sair();
echo "SESSÃO ENCERRADA!";
 
?>
          <meta HTTP-EQUIV = 'Refresh' CONTENT = '0; URL = index.php'>